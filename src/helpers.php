<?php

if (!function_exists('doc_path')) {
    function doc_path($path = ''): string
    {
        return base_path('docs/'.$path);
    }
}
