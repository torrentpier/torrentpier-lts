<?php

if (!defined('BB_ROOT')) die(basename(__FILE__));

$pm_days_keep = (int) $bb_cfg['pm_days_keep'];

if ($pm_days_keep != 0)
{
	DB()->query("
		DELETE FROM ". BB_PRIVMSGS ."
		WHERE privmsgs_date < ". (TIMENOW - 86400*$pm_days_keep) ."
	");
}
