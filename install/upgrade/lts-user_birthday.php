<?php

define('IN_FORUM', true);
define('BB_ROOT', './');
require(BB_ROOT . 'common.php');

$user->session_start();

set_die_append_msg();
if (!IS_SUPER_ADMIN) bb_die($lang['ONLY_FOR_SUPER_ADMIN']);

$confirm = request_var('confirm', '');

if ($confirm) {
	$sql = "SELECT user_id, user_birthday FROM ". BB_USERS ." WHERE user_birthday == '0000-00-00' AND user_id NOT IN ('". EXCLUDED_USERS_CSV ."')";

	foreach (DB()->fetch_rowset($sql) as $row)
	{
		$birthday = bb_date(($row['user_birthday'] * 86400 + 1), 'Y-m-d', false);
		DB()->query("UPDATE ". BB_USERS ." SET user_birthday = '". $birthday ."' WHERE user_id = ". $row['user_id'] ."");
	}

	bb_die('<h1 style="color: green">База данных обновлена</h1>');
} else {
	$msg = '<form method="POST">';
	$msg .= '<h1 style="color: red">!!! Перед тем как нажать на кнопку, сделайте бекап базы данных !!!</h1><br />';
	$msg .= '<input type="submit" name="confirm" value="Начать обновление Базы Данных (v2.1.5-LTS)" style="height: 30px; font:bold 14px Arial, Helvetica, sans-serif;" />';
	$msg .= '</form>';

	bb_die($msg);
}
