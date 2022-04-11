<?php

declare(strict_types=1);

namespace Tests\Feature\Users;

use App\Http\Livewire\System\ProfileUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\Support\AuthenticationUser;
use Tests\TestBase;
use Illuminate\Support\Str;

final class UpdateProfileUserTest extends TestBase
{
    use RefreshDatabase;
    use AuthenticationUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function user_can_access_profile_page()
    {
        $this->authenticated()
            ->get( route('profile') )
            ->assertOk();
    }

    /** @test */
    public function admin_can_to_see_form_to_create_users_central()
    {
        Livewire::actingAs($this->user)
            ->test(ProfileUser::class)
            ->assertPropertyWired('user.name')
            ->assertPropertyWired('user.email')
            ->assertPropertyWired('profile.firstname')
            ->assertPropertyWired('profile.lastname')
            ->assertPropertyWired('profile.phone')
            ->assertPropertyWired('photo')
            ->assertPropertyWired('password')
            ->assertPropertyWired('password_confirmation')
            ->assertMethodWiredToForm('save_profile')
            ->assertMethodWired('change_password');
    }

    /** @test */
    public function photo_is_not_valid()
    {
        Storage::fake('public');
        $image = UploadedFile::fake()->image('avatar.gif', 200, 400)->size(1050);

        $livewire = Livewire::actingAs($this->user)
            ->test(ProfileUser::class)
            ->set('photo', $image)
            ->assertHasErrors(['photo']);
        
        $photo = $livewire->get('photo');
        $this->assertNull($photo);
    }

    /** @test */
    public function can_upload_photo()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('perfil.jpg');

        $name = mb_strtolower($this->user->name);
    
        Livewire::actingAs($this->user)
            ->test(ProfileUser::class)
            ->set('photo', $file)
            ->call('save_profile')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('profiles', [
            'firstname' => $this->user->profile->firstname,
            'lastname' => $this->user->profile->lastname,
            'phone' => $this->user->profile->phone,
            'image' => "/storage/photo_profiles/{$name}.jpg",
            'user_id' => $this->user->id
        ]);
    
        Storage::disk('public')->assertExists("photo_profiles/{$this->user->name}.jpg");
    }

    /** @test */
    public function check_change_password()
    {
        $newPassword = 'newOne123';

        Livewire::actingAs($this->user)
            ->test(ProfileUser::class)
            ->set('password', $newPassword)
            ->set('password_confirmation', $newPassword)
            ->call('change_password')
            ->assertHasNoErrors();

        $this->assertTrue(Hash::check($newPassword, Hash::make($newPassword)));
    }
}