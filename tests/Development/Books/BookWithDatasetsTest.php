<?php

use Packages\Book\App\Models\Book;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function() {
    $this->user = new_user();
});

it('show all user books with th correct status', function($status, $heading) {
    $this->seed(RoleAndPermissionsSeeder::class);

    $book = Book::factory()->create();

    $this->user->books()->attach($book, [
        'status' => $status
    ]);

    $this->assertDatabaseHas('books', [
        'title' => $book->title,
        'author' => $book->author,
    ])
    ->assertDatabaseHas('book_user', [
        'user_id' => $this->user->id,
        'status' => $status,
    ]);

    $this->actingAs($this->user)
        ->get('sistema/books')
        ->assertSeeText($heading)
        ->assertSeeText($book->title);

})->with(
    ['for Want to read' => ['WANT_TO_READ', 'Want to read'] ],
    ['for Reading' => ['READING', 'Reading'] ],
    ['for Read' => ['READ', 'Read'] ]
);
