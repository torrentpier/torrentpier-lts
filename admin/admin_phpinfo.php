<?php

if (!empty($setmodules))
{
	if (IS_SUPER_ADMIN) $module['GENERAL']['PHP_INFO'] = basename(__FILE__);
	return;
}
require('./pagestart.php');

if (!IS_SUPER_ADMIN) bb_die($lang['ONLY_FOR_SUPER_ADMIN']);

phpinfo();
