<?php

define('IN_TRACKER', true);
define('BB_ROOT', './../');
require(BB_ROOT .'common.php');

if (!$tr_cfg['scrape']) msg_die('Please disable SCRAPE!');

// Recover info_hash
if (isset($_GET['?info_hash']) && !isset($_GET['info_hash']))
{
	$_GET['info_hash'] = $_GET['?info_hash'];
}

if (!isset($_GET['info_hash']) || strlen($_GET['info_hash']) != 20)
{
	msg_die('Invalid info_hash');
}

$is_bt_v2 = null;
$info_hash = isset($_GET['info_hash']) ? (string)$_GET['info_hash'] : null;

// Verify info_hash
if (!isset($info_hash))
{
	msg_die('info_hash does not exist');
}

// Check info_hash version
if (strlen($info_hash) == 32)
{
	$is_bt_v2 = true;
}
elseif (strlen($info_hash) == 20)
{
	$is_bt_v2 = false;
}
else
{
	msg_die('Invalid info_hash');
}

function msg_die ($msg)
{
	if (DBG_LOG) dbg_log(' ', '!die-'. clean_filename($msg));

	$output = bencode(array(
		'min interval'    => (int) 1800,
		'failure reason'  => (string) $msg,
		'warning message' => (string) $msg,
	));

	die($output);
}

define('TR_ROOT', './');
require(TR_ROOT . 'includes/init_tr.php');

$info_hash_sql = rtrim(DB()->escape($info_hash), ' ');
$info_hash_where = $is_bt_v2 ? "WHERE tor.info_hash_v2 = '$info_hash_sql'" : "WHERE tor.info_hash = '$info_hash_sql'";

$row = DB()->fetch_row("
		SELECT tor.complete_count, snap.seeders, snap.leechers
		FROM ". BB_BT_TORRENTS ." tor
		LEFT JOIN ". BB_BT_TRACKER_SNAP ." snap ON (snap.topic_id = tor.topic_id)
		$info_hash_where
		LIMIT 1
");

if (!$row) {
	msg_die('Torrent not registered, info_hash = ' . bin2hex($info_hash_sql));
}

$output['files'][$info_hash] = array(
		'complete'    => (int) $row['seeders'],
		'downloaded'  => (int) $row['complete_count'],
		'incomplete'  => (int) $row['leechers'],
);

echo bencode($output);

tracker_exit();
exit;
