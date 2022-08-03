<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'extension', 'position', 'url'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($image) {
            $path = str_replace("storage", "public", $image->url);
            Storage::delete($path);
        });
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}