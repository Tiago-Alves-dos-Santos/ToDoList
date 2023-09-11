<?php
if (!function_exists('prefixAuth')) {
    function prefixAuth(): string
    {
        $prefix = config(['fortify.prefix']);
        return empty($prefix) ? '/' : $prefix;
    }
}
