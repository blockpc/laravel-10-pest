<?php

declare(strict_types=1);

namespace Packages\Perfil\App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

final class Perfil extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id'];
}