<?php

if (!defined('IN_AJAX')) die(basename(__FILE__));

global $bb_cfg, $lang;

if (!$mode = (string) $this->request['mode'])
{
	$this->ajax_die('invalid mode (empty)');
}
$map  = new sitemap();
$html = '';

switch ($mode)
{
	case 'create':
		$map->create();
		if (@file_exists(SITEMAP_DIR. 'sitemap.xml'))
		{
			$html .= $lang['SITEMAP_CREATED'].': <b>'.bb_date(TIMENOW, $bb_cfg['post_date_format']).'</b> '.$lang['SITEMAP_AVAILABLE'].': <a href="'.make_url('sitemap.xml').'" target="_blank">'.make_url('sitemap.xml').'</a>';
		} else {
			$html .= $lang['SITEMAP_NOT_CREATED'];
		}
	break;

	case 'search_update':
		if (!@file_exists(SITEMAP_DIR. 'sitemap.xml')) $map->create();

		$map_link = make_url(hide_bb_path(SITEMAP_DIR. 'sitemap.xml'));

		foreach ($bb_cfg['sitemap_sending'] as $source_name => $source_link)
		{
			if ($map->send_url($source_link, $map_link))
			{
				$html .= '<br />' . $lang['SITEMAP_NOTIFY_SEARCH'] . '&nbsp;' . $source_name . ' : <span style="color: green;">' . $lang['SITEMAP_SENT'] . '</span>';
			}
			else
			{
				$html .= '<br />' . $lang['SITEMAP_NOTIFY_SEARCH'] . '&nbsp;' . $source_name . ' : <span style="color: red;">' . $lang['SITEMAP_ERROR'] . '</span> URL: <a href="' . $source_link . urlencode($map_link) . '" target="_blank">' . $source_link . $map_link . '</a>';
			}
		}
	break;

	default:
		$this->ajax_die('Invalid mode: ' . $mode);
	break;
}

$this->response['html'] = $html;
$this->response['mode'] = $mode;
