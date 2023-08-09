<?php

use Packages\Book\App\Models\Pivots\BookUser;

beforeEach(function() {
    $this->user = new_user();
});

it('only allows authendticated users to get', function () {

    // $this->get('sistema/books/create')->assertStatus(302)->assertRedirect('/login');
    expectGuest()->toBeRedirectFor('sistema/books/create', 'get', 'login');
});

it('only allows authendticated users to post', function () {

    // $this->post('sistema/books/create')->assertStatus(302)->assertRedirect('/login');
    expectGuest()->toBeRedirectFor('sistema/books/create', 'post', 'login');
});

it('show the avalaible statuses on the form', function() {
    $this->seed(RoleAndPermissionsSeeder::class);
    $this->actingAs($this->user)
        ->get('/sistema/books/create')
        ->assertSeeTextInOrder(BookUser::$statuses);
});

it('can create a book', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $this->actingAs($this->user)
        ->post('/sistema/books/create', [
            'title' => 'A Title',
            'author' => 'An Author',
            'status' => 'WANT_TO_READ'
        ])
        ->assertStatus(302)
        ->assertRedirect('/sistema/books')
        ->assertSessionHas('success');

    $this->assertDatabaseHas('books', [
        'title' => 'A Title',
        'author' => 'An Author',
    ])
    ->assertDatabaseHas('book_user', [
        'user_id' => $this->user->id,
        'status' => 'WANT_TO_READ',
    ]);

});

it('get errors when validation fail', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $this->actingAs($this->user)
        ->post('/sistema/books/create')
        ->assertSessionHasErrors(['title', 'author', 'status']);
});

it('reuires a valid status')
    ->defer(fn() => $this->actingAs($this->user))
    ->post('/sistema/books/create', [
        'status' => 'OTHER',
    ])
    ->assertSessionHasErrors(['status']);
