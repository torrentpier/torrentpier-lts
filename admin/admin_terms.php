<?php

if (!empty($setmodules))
{
	$module['GENERAL']['TERMS'] = basename(__FILE__);
	return;
}
require('./pagestart.php');

require(INC_DIR .'bbcode.php');

if (isset($_POST['post']) && $bb_cfg['terms'] != $_POST['message'])
{
	bb_update_config(array('terms' => $_POST['message']));
	bb_die($lang['SAVED'] . '<br /><br /><a href="admin_terms.php">' . $lang['GO_BACK'] . '</a><br /><br />' . sprintf($lang['CLICK_RETURN_ADMIN_INDEX'], '<a href="index.php?pane=right">', '</a>'));
}

$template->assign_vars(array(
	'S_ACTION'     => 'admin_terms.php',
	'EXT_LINK_NW'  => $bb_cfg['ext_link_new_win'],
	'MESSAGE'      => (isset($_REQUEST['preview'])) ? $_POST['message'] : (($bb_cfg['terms']) ? $bb_cfg['terms'] : ''),
	'PREVIEW_HTML' => (isset($_REQUEST['preview'])) ? bbcode2html($_POST['message']) : '',
));

print_page('admin_terms.tpl', 'admin');
