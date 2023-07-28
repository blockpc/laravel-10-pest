<?php

it('can create a book', function() {

    $user = new_user();

    $this->actingAs($user)
        ->post('/sistema/libros/nuevo', [
            'title' => 'A Title',
            'author' => 'An Author',
            'status' => 'WANT_TO_READ'
        ])
        ->assertStatus(302)
        ->assertRedirect('/sistema/libros')
        ->assertSessionHas('success');

    $this->assertDatabaseHas('books', [
        'title' => 'A Title',
        'author' => 'An Author',
    ])
    ->assertDatabaseHas('book_user', [
        'user_id' => $user->id,
        'status' => 'WANT_TO_READ',
    ]);
});
