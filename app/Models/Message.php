<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = ['message'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->user_id = current_user()->id;
        });
    }

    public function messageable()
    {
        return $this->morphTo();
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}