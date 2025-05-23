<?php

define('IN_FORUM', true);
define('BB_SCRIPT', 'callseed');
define('BB_ROOT', './');
require(BB_ROOT . 'common.php');

// Init userdata
$user->session_start(array('req_login' => true));

$topic_id = (int) request_var('t', 0);
$t_data   = topic_info($topic_id);
$forum_id = $t_data['forum_id'];

set_die_append_msg($forum_id, $topic_id);

if (!$bb_cfg['callseed'])
{
	bb_die($lang['MODULE_OFF']);
}
elseif ($t_data['seeders'] > 2)
{
	bb_die(sprintf($lang['CALLSEED_HAVE_SEED'], $t_data['seeders']));
}
elseif ($t_data['call_seed_time'] > (TIMENOW - 86400))
{
	$time_left = delta_time($t_data['call_seed_time'] + 86400, TIMENOW, 'days');
	bb_die(sprintf($lang['CALLSEED_MSG_SPAM'], $time_left));
}
elseif (isset($bb_cfg['tor_no_tor_act'][$t_data['tor_status']]))
{
	bb_die($lang['NOT_AVAILABLE']);
}

$ban_user_id = array();

$sql = DB()->fetch_rowset("SELECT ban_userid FROM ". BB_BANLIST ." WHERE ban_userid != 0");

foreach ($sql as $row)
{
	$ban_user_id[] = ','. $row['ban_userid'];
}
$ban_user_id = join('', $ban_user_id);

$user_list = DB()->fetch_rowset("
	SELECT DISTINCT dl.user_id, u.user_opt, tr.user_id as active_dl
	FROM ". BB_BT_DLSTATUS     ." dl
	LEFT JOIN ". BB_USERS      ." u  ON(u.user_id = dl.user_id)
	LEFT JOIN ". BB_BT_TRACKER ." tr ON(tr.user_id = dl.user_id)
	WHERE dl.topic_id = $topic_id
		AND dl.user_status IN (". DL_STATUS_COMPLETE.", ". DL_STATUS_DOWN.")
		AND dl.user_id NOT IN ({$userdata['user_id']}, ". EXCLUDED_USERS_CSV . $ban_user_id .")
		AND u.user_active = 1
	GROUP BY dl.user_id
");

$subject = sprintf($lang['CALLSEED_SUBJECT'], $t_data['topic_title']);
$message = sprintf($lang['CALLSEED_TEXT'], make_url(TOPIC_URL . $topic_id), $t_data['topic_title'], make_url(DOWNLOAD_URL . $t_data['attach_id']));

if ($user_list)
{
	foreach ($user_list as $row)
	{
		if (!empty($row['active_dl'])) continue;

		if (bf($row['user_opt'], 'user_opt', 'user_callseed'))
		{
			send_pm($row['user_id'], $subject, $message, BOT_UID);
		}
	}
}
else
{
	send_pm($t_data['poster_id'], $subject, $message, BOT_UID);
}

DB()->query("UPDATE ". BB_BT_TORRENTS ." SET call_seed_time = ". TIMENOW ." WHERE topic_id = $topic_id LIMIT 1");

meta_refresh(TOPIC_URL . $topic_id);
bb_die($lang['CALLSEED_MSG_OK']);

function topic_info ($topic_id)
{
	global $lang;

	$sql = "
		SELECT
			tor.poster_id, tor.forum_id, tor.attach_id, tor.call_seed_time, tor.tor_status,
			t.topic_title, sn.seeders
		FROM      ". BB_BT_TORRENTS     ." tor
		LEFT JOIN ". BB_TOPICS          ." t  USING(topic_id)
		LEFT JOIN ". BB_BT_TRACKER_SNAP ." sn USING(topic_id)
		WHERE tor.topic_id = $topic_id
	";

	if (!$torrent = DB()->fetch_row($sql))
	{
		bb_die($lang['TOPIC_POST_NOT_EXIST']);
	}

	return $torrent;
}
