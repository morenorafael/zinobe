<?php

use App\Tools\TwigFunctions;

if (!function_exists('redirect')) {

    /**
     * @param string $path
     */
    function redirect(string $path)
    {
        header("Location: {$path}");
    }
}