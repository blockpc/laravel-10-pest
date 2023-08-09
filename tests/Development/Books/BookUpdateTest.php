<?php

use Packages\Book\App\Models\Book;

it('redirect unathenticated user at route books edit')
    ->expectGuest()->toBeRedirectFor('sistema/books/edit/1', 'put', 'login');

it('fails if the book does not exists', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    actingAs($user)->put('sistema/books/edit/1')->assertStatus(404);
});

it('validate the request update', function() {
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

    actingAs($user)->put('sistema/books/edit/' . $book->id)
        ->assertSessionHasErrors(['title', 'author', 'status']);
});

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

    actingAs($another_user)->put('sistema/books/edit/' . $book->id, [
        'title' => 'new title',
        'author' => 'new author',
        'status' => 'READ'
    ])->assertStatus(403);
});


it('update the book', function() {
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

    actingAs($user)->put('sistema/books/edit/' . $book->id, [
        'title' => 'new title',
        'author' => 'new author',
        'status' => 'READ'
    ])
    ->assertStatus(302)
    ->assertRedirect('sistema/books');

    $this->assertDatabaseHas('books', [
        'id' => $book->id,
        'title' => 'new title',
        'author' => 'new author',
    ])
    ->assertDatabaseHas('book_user', [
        'user_id' => $user->id,
        'status' => 'READ',
    ]);
});
