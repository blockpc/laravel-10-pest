<?php

namespace App\Models;

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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['fullname'];

    public function getFullnameAttribute()
    {
        return ($this->attributes['firstname'] || $this->attributes['firstname']) ? trim("{$this->attributes['firstname']} {$this->attributes['lastname']}") : null;
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
