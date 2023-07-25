<?php

declare(strict_types=1);

namespace Packages\Book\App\Models;

use Blockpc\App\Traits\HasPackageFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

final class Book extends Model
{
    use SoftDeletes;
    use HasPackageFactory;
    
    protected $guarded = ['id'];
}