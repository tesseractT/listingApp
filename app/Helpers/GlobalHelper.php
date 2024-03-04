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
