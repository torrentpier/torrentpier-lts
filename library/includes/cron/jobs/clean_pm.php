<?php

if (!defined('BB_ROOT')) die(basename(__FILE__));

$pm_days_keep = (int) $bb_cfg['pm_days_keep'];

if ($pm_days_keep != 0)
{
	$per_cycle = 20000;
	$row = DB()->fetch_row("SELECT MIN(privmsgs_id) AS start_id, MAX(privmsgs_id) AS finish_id FROM " . BB_PRIVMSGS);
	$start_id = (int) $row['start_id'];
	$finish_id = (int) $row['finish_id'];

	while (true)
	{
		set_time_limit(600);
		$end_id = $start_id + $per_cycle - 1;

		DB()->query("
			DELETE FROM " . BB_PRIVMSGS . "
			WHERE privmsgs_id BETWEEN $start_id AND $end_id
				AND privmsgs_date < " . (TIMENOW - 86400 * $pm_days_keep) . "
		");
		if ($end_id > $finish_id)
		{
			break;
		}
		if (!($start_id % ($per_cycle * 10)))
		{
			sleep(1);
		}
		$start_id += $per_cycle;
	}
}
