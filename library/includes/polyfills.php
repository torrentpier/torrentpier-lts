<?php

if (!defined('BB_ROOT')) die(basename(__FILE__));

function sqlite3_escape_string($str)
{
    return SQLite3::escapeString($str);
}

if (!function_exists('boolval')) {
    function boolval($val)
    {
        return (bool)$val;
    }
}

if (!function_exists('trait_exists')) {
    function trait_exists($class, $autoload = true)
    {
        return $autoload && \class_exists($class, $autoload) && false;
    }
}

if (!function_exists('class_uses')) {
    function class_uses($class, $autoload = true)
    {
        if (\is_object($class) || \class_exists($class, $autoload) || \interface_exists($class, false)) {
            return array();
        }

        return false;
    }
}

if (50509 === PHP_VERSION_ID && 4 === PHP_INT_SIZE) {
    // Missing functions in PHP 5.5.9 - affects 32 bit builds of Ubuntu 14.04LTS
    // See https://bugs.launchpad.net/ubuntu/+source/php5/+bug/1315888
    if (!function_exists('gzopen') && function_exists('gzopen64')) {
        function gzopen($filename, $mode, $use_include_path = 0)
        {
            return gzopen64($filename, $mode, $use_include_path);
        }
    }
    if (!function_exists('gzseek') && function_exists('gzseek64')) {
        function gzseek($fp, $offset, $whence = SEEK_SET)
        {
            return gzseek64($fp, $offset, $whence);
        }
    }
    if (!function_exists('gztell') && function_exists('gztell64')) {
        function gztell($fp)
        {
            return gztell64($fp);
        }
    }
}
