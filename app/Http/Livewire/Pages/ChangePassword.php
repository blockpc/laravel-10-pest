<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class ChangePassword extends Component
{
    public $token;

    public $email = "";
    public $password = "";
    public $password_confirmation = "";
    
    public function save()
    {
        $this->validate();

        $updatePassword = DB::table('password_resets')
                                ->where([
                                    'email' => $this->email, 
                                    'token' => $this->token
                                ])
                                ->first();
        if(!$updatePassword){
            return session()->flash('error', 'El token es invalido! Comunicate con un administrador');
        }

        $user = User::where('email', $this->email)
                    ->whereNull('email_verified_at')
                    ->first();

        $user->password = Hash::make($this->password);
        $user->email_verified_at = Carbon::now();
        $user->save();

        DB::table('password_resets')->where(['email'=> $this->email])->delete();

        session()->flash('status', 'Felicidades. Ahora puedes ingresar al sistema con tu correo y la clave que has creado!');
        return redirect()->route('login');
    }

    protected function rules()
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
