<?php

declare(strict_types=1);

namespace Packages\Book\App\Models;

use App\Models\User;
use Blockpc\App\Traits\HasPackageFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Packages\Book\App\Models\Pivots\BookUser;

final class Book extends Model
{
    use SoftDeletes;
    use HasPackageFactory;

    protected $fillable = [
        'title',
        'author'
    ];

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(BookUser::class)
            ->withPivot(['status']);
    }
}
