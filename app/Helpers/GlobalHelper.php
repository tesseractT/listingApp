<?php

/** Set Sidebar Active */

if (!function_exists('setSidebarActive')) {
    function setSidebarActive(array $routes): ?string
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
        return null;
    }
}

/** Get Youtube Thumbnail */

if (!function_exists('getYouTubeThumbnail')) {
    function getYouTubeThumbnail(string $url): ?string
    {
        $pattern = '/[?&]v=([a-zA-Z0-9_-]{11})/';

        if (preg_match($pattern, $url, $matches)) {
            $id =  $matches[1];

            return "https://img.youtube.com/vi/{$id}/mqdefault.jpg";
        }

        return null;
    }
}

/** Truncate longer texts */

if (!function_exists('truncateText')) {
    function truncateText(string $text, int $length = 25): ?string
    {
        return \Str::of($text)->limit($length);
    }
}


/** Currency Position */

if (!function_exists('currencyPosition')) {
    function currencyPosition(int $amount): ?string
    {
        if (config('settings.site_currency_position') === 'left') {
            return config('settings.site_currency_icon') . $amount;
        } else
            return $amount . config('settings.site_currency_icon');
    }
}
