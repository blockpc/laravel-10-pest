<?php

namespace App\Http\Livewire\System;

use App\Models\User;
use Blockpc\App\Traits\AlertBrowserEvent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;

class ProfileUser extends Component
{
    use WithFileUploads;
    use AlertBrowserEvent;
    
    public User $user;
    public $profile;

    public $password;
    public $password_confirmation;
    public $photo;
    public $type = 'password';

    public function mount()
    {
        $this->user = current_user();
        $this->profile = $this->user->profile;
    }
    
    public function render()
    {
        return view('livewire.system.profile-user');
    }

    public function save_profile()
    {
        $this->validate();

        $this->user->save();

        if ( $this->photo ) {
            $name = Str::slug(mb_strtolower($this->user->name));
            $extension = $this->photo->extension();
            if ( $this->user->profile->image && file_exists(public_path($this->user->profile->image)) ) {
                unlink(public_path($this->user->profile->image));
            }

            $img = Image::make($this->photo->getRealPath())
                    ->encode('jpg', 65)
                    ->fit(400, null, function ($constrain) {
                        $constrain->aspectRatio();
                        $constrain->upsize();
                    });
            $img->stream(); // <-- Key point

            $path = "photo_profiles/{$name}.{$extension}";
            Storage::disk('public')->put($path, $img);
            
            $this->profile->image = "/storage/{$path}";
            $this->alert(__('users.forms.messages.success-photo'));
        }

        $this->profile->save();

        $this->alert(__('users.forms.messages.success-profile'));
    }

    public function change_password()
    {
        $this->validate([
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);
        $this->user->password = Hash::make($this->password);
        $this->user->save();

        $this->alert(__('users.forms.messages.success-password'));
    }

    /**
     * @param \Livewire\TemporaryUploadedFile $value
     */
    public function updatedPhoto($value)
    {
        $validator = Validator::make(
            ['photo' => $this->photo],
            ['photo' => ['nullable', 'image', 'mimes:jpg,png', 'max:1024']],
            [],
            ['photo' => __('users.forms.attributes.user.photo')]
        );
    
        if ($validator->fails()) {
            $this->reset('photo');
            $this->setErrorBag($validator->getMessageBag());
        }
    }

    public function see()
    {
        if ( !$this->password ) {
            return;
        }
        $this->type = ($this->type == 'password') ? 'text' : 'password';
    }

    public function generate()
    {
        $this->password = $this->password_confirmation = Str::random(12);
    }

    protected function rules()
    {
        $unique_name = Rule::unique('users', 'name')->ignore($this->user);
        $unique_email = Rule::unique('users', 'email')->ignore($this->user);
        return [
            'user.name' => ['required', 'alpha_num', 'max:64', $unique_name],
            'user.email' => ['required', 'email', 'max:64', $unique_email],
            'profile.firstname' => ['nullable', 'max:64'],
            'profile.lastname' => ['nullable', 'max:64'],
            'profile.phone' => ['nullable', 'regex:/^(\+[\d]{1,2}+(\s)?)?+[\d]{8,10}$/', 'min:8', 'max:15'],
        ];
    }

    protected function validationAttributes()
    {
        return [
            'user.name' => __('users.forms.attributes.user.name'),
            'user.email' => __('users.forms.attributes.user.email'),
            'photo' => __('users.forms.attributes.photo'),
            'profile.firstname' => __('users.forms.attributes.profile.firstname'),
            'profile.lastname' => __('users.forms.attributes.profile.lastname'),
            'profile.phone' => __('users.forms.attributes.profile.phone'),
        ];
    }
}
