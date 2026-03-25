<?php

use CodeIgniter\Database\Config;

/**
 * Ambil nilai setting dari database (dengan cache)
 */
if (!function_exists('get_setting')) {
    function get_setting(string $key): ?string
    {
        static $cache = [];

        if (isset($cache[$key])) {
            return $cache[$key];
        }

        $db = Config::connect();
        $row = $db->table('conf_sistem')
            ->select($key)
            ->get()
            ->getRow();

        if ($row) {
            $cache[$key] = $row->$key;
            return $row->$key;
        }

        return null;
    }
}

if (!function_exists('get_site_key')) {
    function get_site_key(): ?string
    {
        static $cache = [];

        if (isset($cache['site_key'])) {
            return $cache['site_key'];
        }

        $db = Config::connect();
        $row = $db->table('conf_sistem')
            ->select('content')
            ->where('id', 19)
            ->get()
            ->getRow();

        if ($row) {
            $cache['site_key'] = $row->content;
            return $row->content;
        }

        return null;
    }
}

if (!function_exists('get_secret_key')) {
    function get_secret_key(): ?string
    {
        static $cache = [];

        if (isset($cache['secret_key'])) {
            return $cache['secret_key'];
        }

        $db = Config::connect();
        $row = $db->table('conf_sistem')
            ->select('content')
            ->where('id', 20)
            ->get()
            ->getRow();

        if ($row) {
            $cache['secret_key'] = $row->content;
            return $row->content;
        }

        return null;
    }
}
