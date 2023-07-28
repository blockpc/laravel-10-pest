<?php

declare(strict_types=1);

namespace Packages\Book\App\Models;

use App\Models\User;
use Blockpc\App\Traits\HasPackageFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Book extends Model
{
    use SoftDeletes;
    use HasPackageFactory;

    protected $fillable = [
        'title',
        'author',
        'status'
    ];

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot(['status']);
    }
}
