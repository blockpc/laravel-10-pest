<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'firstname', 'lastname', 'user_id', 'phone', 'image'
    ];

    /**
     * Get the user's full name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function fullname(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => ($attributes['firstname'] || $attributes['firstname']) ? trim("{$attributes['firstname']} {$attributes['lastname']}") : null,
        );
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
