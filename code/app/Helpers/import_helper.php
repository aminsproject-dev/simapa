<?php

if (!function_exists('normalize')) {
    function normalize($text)
    {
        $text = strtolower($text);
        $text = trim($text);
        $text = preg_replace('/\s+/', ' ', $text);
        return $text;
    }
}

if (!function_exists('map_by_name')) {
    function map_by_name($data, $key)
    {
        $map = [];
        foreach ($data as $item) {
            $normalized = normalize($item[$key]);
            $map[$normalized] = $item;
        }
        return $map;
    }
}
