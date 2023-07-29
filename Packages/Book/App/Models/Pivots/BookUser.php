<?php

declare(strict_types=1);

namespace Packages\Book\App\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

final class BookUser extends Pivot
{
    public static $statuses = [
        'WANT_TO_READ' => 'Want to read',
        'READING' => 'Reading',
        'READ' => 'Read'
    ];
}
