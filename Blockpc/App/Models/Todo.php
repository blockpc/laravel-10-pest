<?php

declare(strict_types=1);

namespace Blockpc\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'tasks',
        'user_id'
    ];

    protected $casts = [
        'tasks' => 'json'
    ];

    protected $attributes = [
        'tasks' => '{}',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($model) {
            $model->messageable()->delete();
        });
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messageable() : MorphMany
    {
        return $this->morphMany(Message::class, 'messageable');
    }
}
