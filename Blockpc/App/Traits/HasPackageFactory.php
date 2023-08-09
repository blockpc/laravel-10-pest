<?php

namespace Blockpc\App\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

trait HasPackageFactory
{
    use HasFactory;

    protected static function newFactory()
    {
        $package = Str::before(get_called_class(), 'App\\Models\\');
        $modelName = Str::after(get_called_class(), 'App\\Models\\');
        $path = $package.'database\\factories\\'.$modelName.'Factory';

        return $path::new();
    }
}
