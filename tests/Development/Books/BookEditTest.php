<?php

use Packages\Book\App\Models\Book;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('redirect unathenticated user at route books edit')
    ->expectGuest()->toBeRedirectFor('sistema/books/edit/1', 'get', 'login');

it('fails if the user does not own the book', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();
    $another_user = new_user();

    $book = Book::factory()->create();
    $user->books()->attach($book, [
        'status' => 'WANT_TO_READ'
    ]);
    $this->assertDatabaseHas('books', [
        'title' => $book->title,
        'author' => $book->author,
    ])
    ->assertDatabaseHas('book_user', [
        'user_id' => $user->id,
        'status' => 'WANT_TO_READ',
    ]);

    actingAs($another_user)->get('sistema/books/edit/' . $book->id)->assertStatus(403);
});

it('show the book to edit', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    $book = Book::factory()->create();
    $user->books()->attach($book, [
        'status' => 'WANT_TO_READ'
    ]);
    $this->assertDatabaseHas('books', [
        'title' => $book->title,
        'author' => $book->author,
    ])
    ->assertDatabaseHas('book_user', [
        'user_id' => $user->id,
        'status' => 'WANT_TO_READ',
    ]);

    actingAs($user)->get('sistema/books/edit/' . $book->id)
        ->assertOk()
        ->assertSee(['Edit a Book', $book->title, $book->author, 'Edit Book'])
        ->assertSee('<option value="WANT_TO_READ" selected>Want to read</option>', false);

});

it('fails if the book does not exists', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    actingAs($user)->get('sistema/books/edit/1')->assertStatus(404);
});
