<?php

if (!defined('BB_ROOT')) die(basename(__FILE__));

require(CLASS_DIR .'sitemap.php');

$map = new sitemap();
$map->create();

if (@file_exists(SITEMAP_DIR. 'sitemap.xml'))
{
	$map_link = make_url(hide_bb_path(SITEMAP_DIR. 'sitemap.xml'));

	foreach ($bb_cfg['sitemap_sending'] as $source_name => $source_link)
	{
        $map->send_url($source_link, $map_link);
    }
}