<?php

declare(strict_types=1);

if (! function_exists('current_user')) {
    function current_user() {
        return Auth::user();
    }
}

if (! function_exists('title')) {
    function title($value)
    {
        return \Illuminate\Support\Str::title($value);
    }
}

if (! function_exists('image_profile')) {
    function image_profile($user = null) : string
    {
        $user = $user ?? current_user();
        if ( $image = $user->profile->image ) {
            return $image;
        } else {
            $name = str_replace(" ", "+", $user->profile->fullName);
            return "https://ui-avatars.com/api/?name={$name}";
        }
    }
}

if (! function_exists('format_date')) {
    function format_date($date, $format_out, $fomat_in = 'Y-m-d'){
        return \Carbon\Carbon::createFromFormat($fomat_in, $date)->format($format_out);    
    }
}