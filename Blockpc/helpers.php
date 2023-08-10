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
        if ( $image = $user->exists ? $user->profile->image : false ) {
            return $image;
        } else {
            $name = str_replace(" ", "+", $user->exists ? $user->profile->fullName : 'n n');
            return "https://ui-avatars.com/api/?name={$name}";
        }
    }
}
if (! function_exists('avatar')) {
    function avatar($name){
        $name = str_replace(" ", "+", $name ?: 'n n');
        return "https://ui-avatars.com/api/?name={$name}";
    }
}

if (! function_exists('format_date')) {
    function format_date($date, $format_out = 'Y-m-d', $fomat_in = 'Y-m-d H:i'){
        return \Carbon\Carbon::parse($date)->format($format_out);
        // return \Carbon\Carbon::createFromFormat($fomat_in, $date)->format($format_out);
    }
}

if (! function_exists('format_price')) {
    function format_price($price, $symbol = '$', $decimals = 0, ?string $decimal_separator = ',', ?string $thousands_separator = '.'){
        return $symbol . ' ' . number_format($price, $decimals, $decimal_separator, $thousands_separator);
    }
}

if (! function_exists('format_unit')) {
    function format_unit($price, $symbol = '$', $unit = ''){
        return $symbol . ' ' . number_format($price, 0, ',', '.') . $unit ? " $/{$unit}" : '';
    }
}
