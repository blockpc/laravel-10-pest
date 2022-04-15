<?php

namespace App\Models;

use Blockpc\App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function profile() : HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function isOnline()
    {
        return Cache::has('user-online-'.$this->id);
    }

    public function getRoleIdAttribute() : int
    {
        return $this->roles()->first()->id;
    }

    public function getCargoAttribute() : string
    {
        return $this->roles()->first()->display_name;
    }

    public function scopeAllowed($query)
    {
        $all_roles_except_sudo = Role::whereNotIn('name', ['sudo'])->get();
        if( current_user()->hasRole('sudo') ) {
            return $query;
        } else {
            return $query->role($all_roles_except_sudo);
        }
    }
}
