<?php

namespace App\Models;

use Blockpc\App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    // Relations

    public function profile() : HasOne
    {
        return $this->hasOne(Profile::class);
    }

    // Attributes

    public function getRoleIdAttribute() : int
    {
        return $this->roles()->first()->id;
    }

    public function getCargoAttribute() : string
    {
        return $this->roles()->first()->display_name;
    }

    // Scopes

    public function scopeAllowed($query)
    {
        $all_roles_except_sudo = Role::whereNotIn('name', ['sudo'])->get();
        if( current_user()->hasRole('sudo') ) {
            return $query;
        } else {
            return $query->role($all_roles_except_sudo);
        }
    }

    // Functions

    /**
     * Permite asignar al cache el id del usuario
     * @return bool
     */
    public function isOnline() : bool
    {
        return Cache::has('user-online-'.$this->id);
    }

    /**
     * permite detectar si un usuario tiene permisos de super usuario
     * @return bool
     */
    public function is_sudo() : bool
    {
        return current_user()->hasRole('sudo') || current_user()->hasPermissionTo('super admin');
    }
}
