<?php

use Packages\Book\App\Models\Book;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function() {
    $this->user = new_user();
});

it('show books the user want to read', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $book = Book::factory()->create();

    $this->user->books()->attach($book, [
        'status' => 'WANT_TO_READ'
    ]);

    $this->assertDatabaseHas('books', [
        'title' => $book->title,
        'author' => $book->author,
    ])
    ->assertDatabaseHas('book_user', [
        'user_id' => $this->user->id,
        'status' => 'WANT_TO_READ',
    ]);

    $this->actingAs($this->user)
        ->get('sistema/books')
        ->assertSeeText('Want to read')
        ->assertSeeText($book->title);
});

it('show books the user reading', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $book = Book::factory()->create();

    $this->user->books()->attach($book, [
        'status' => 'READING'
    ]);

    $this->assertDatabaseHas('books', [
        'title' => $book->title,
        'author' => $book->author,
    ])
    ->assertDatabaseHas('book_user', [
        'user_id' => $this->user->id,
        'status' => 'READING',
    ]);

    $this->actingAs($this->user)
        ->get('sistema/books')
        ->assertSeeText('Reading')
        ->assertSeeText($book->title);
});

it('show books the user read', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $book = Book::factory()->create();

    $this->user->books()->attach($book, [
        'status' => 'READ'
    ]);

    $this->assertDatabaseHas('books', [
        'title' => $book->title,
        'author' => $book->author,
    ])
    ->assertDatabaseHas('book_user', [
        'user_id' => $this->user->id,
        'status' => 'READ',
    ]);

    $this->actingAs($this->user)
        ->get('sistema/books')
        ->assertSeeText('Read')
        ->assertSeeText($book->title);
});

