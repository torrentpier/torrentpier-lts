<?php

if (!defined('BB_ROOT')) die(basename(__FILE__));

$log_days_keep = (int) $bb_cfg['log_days_keep'];

if ($log_days_keep != 0)
{
	DB()->query("
		DELETE FROM ". BB_LOG ."
		WHERE log_time < ". (TIMENOW - 86400*$log_days_keep) ."
	");
}
