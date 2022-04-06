<?php

declare(strict_types=1);

if (! function_exists('current_user')) {
    function current_user() {
        return Auth::user();
    }
}