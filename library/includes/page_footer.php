<?php

if (!defined('BB_ROOT')) die(basename(__FILE__));

global $bb_cfg, $userdata, $template, $DBS, $lang;

if (!empty($template))
{
	$birthday_tp = ((string)bb_date(TIMENOW, 'd.m', false) === '04.04') ? '&nbsp;|&nbsp;&#127881;&#127856;&#128154;' : null;

	$template->assign_vars(array(
		'SIMPLE_FOOTER'    => !empty($gen_simple_header),
		'POWERED'          => 'Powered by <a target="_blank" href="https://torrentpier.com">TorrentPier II</a> &copy; 2005-' . date('Y') . (isset($birthday_tp) ? $birthday_tp : ''),
		'SHOW_ADMIN_LINK'  => (IS_ADMIN && !defined('IN_ADMIN')),
		'ADMIN_LINK_HREF'  => "admin/index.php",
	));

	$template->set_filenames(array('page_footer' => 'page_footer.tpl'));
	$template->pparse('page_footer');
}

$show_dbg_info = (DBG_USER && !(isset($_GET['pane']) && $_GET['pane'] == 'left'));

if(!$bb_cfg['gzip_compress'])
{
	flush();
}

if ($show_dbg_info)
{
	$gen_time = utime() - TIMESTART;
	$gen_time_txt = sprintf('%.3f', $gen_time);
	$gzip_text = (UA_GZIP_SUPPORTED) ? "{$lang['GZIP_COMPRESSION']}: " : "<s>{$lang['GZIP_COMPRESSION']}:</s> ";
	$gzip_text .= ($bb_cfg['gzip_compress']) ? $lang['ON'] : $lang['OFF'];

	$stat = '[&nbsp; '. $lang['EXECUTION_TIME'] ." $gen_time_txt ". $lang['SEC'];

	if (!empty($DBS))
	{
		$sql_t = $DBS->sql_timetotal;
		$sql_time_txt = ($sql_t && SQL_CALC_QUERY_TIME) ? sprintf('%.3f '.$lang['SEC'].' (%d%%) &middot; ', $sql_t, round($sql_t*100/$gen_time)) : '';
		$num_q = $DBS->num_queries;
		$stat .= " &nbsp;|&nbsp; {$DBS->get_db_obj()->engine}: {$sql_time_txt}{$num_q} " . $lang['QUERIES'];
	}

	$stat .= " &nbsp;|&nbsp; $gzip_text";

	$stat .= ' &nbsp;|&nbsp; '.$lang['MEMORY'];
	$stat .= humn_size($bb_cfg['mem_on_start'], 2) .' / ';
	$stat .= humn_size(sys('mem_peak'), 2) .' / ';
	$stat .= humn_size(sys('mem'), 2);

	if ($l = sys('la'))
	{
		$l = explode(' ', $l);
		for ($i=0; $i < 3; $i++)
		{
			$l[$i] = round($l[$i], 1);
		}
		$stat .= " &nbsp;|&nbsp; ". $lang['LIMIT'] ." $l[0] $l[1] $l[2]";
	}

	$stat .= ' &nbsp;]';

	// Show sql debug buttons
	if (SQL_DEBUG)
	{
		$stat .= '&nbsp;|';
		$stat .= !empty($_COOKIE['sql_log']) ? '&nbsp;[ <a href="#" class="med" onclick="$p(\'sqlLog\').className=\'sqlLog sqlLogWrapped\'; return false;">wrap</a> &middot; <a href="#sqlLog" class="med" onclick="$(\'#sqlLog\').css({ height: $(window).height()-50 }); return false;">max</a> ]&nbsp;|' : '';
		$stat .= '&nbsp;<label title="'. $lang['SHOW_LOG'] .'"><input type="checkbox" onclick="setCookie(\'sql_log\', this.checked ? 1 : 0); window.location.reload();" '. (!empty($_COOKIE['sql_log']) ? HTML_CHECKED : '') .' />'. $lang['SHOW_LOG'] .'</label>&nbsp;|
						<label title="'. $lang['CUT_LONG_LOG'] .'"><input type="checkbox" onclick="setCookie(\'sql_log_full\', this.checked ? 1 : 0); window.location.reload();" '. (!empty($_COOKIE['sql_log_full']) ? HTML_CHECKED : '') .' />'. $lang['CUT_LONG_LOG'] .'</label>&nbsp;|
						<label title="'. $lang['EXPLAIN_LOG'] .'"><input type="checkbox" onclick="setCookie(\'explain\', this.checked ? 1 : 0); window.location.reload();" '. (!empty($_COOKIE['explain']) ? HTML_CHECKED : '') .' />'. $lang['EXPLAIN_LOG'] .'</label>';
	}

	echo '<div style="margin: 6px; font-size:10px; color: #444444; letter-spacing: -1px; text-align: center;">'. $stat .'</div>';
}

echo '
	</div><!--/body_container-->
';

if ($show_dbg_info && SQL_DEBUG)
{
	require(INC_DIR . 'page_footer_dev.php');
}

echo '
	</body>
	</html>
';

if (defined('REQUESTED_PAGE') && !defined('DISABLE_CACHING_OUTPUT'))
{
	if (IS_GUEST === true)
	{
		caching_output(true, 'store', REQUESTED_PAGE .'_guest_'. $bb_cfg['default_lang']);
	}
}

bb_exit();
