<?php

if (!defined('BB_ROOT')) die(basename(__FILE__));

function sqlite3_escape_string ($str)
{
    return SQLite3::escapeString($str);
}
