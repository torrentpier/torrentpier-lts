<?php

if (!defined('BB_ROOT')) die(basename(__FILE__));

$announce_urls = array();

// Здесь вы можете указать разрешенные URL-адреса анонсеров
//
// Примечание:
// - Добавляйте URL-адреса без GET параметров в конце
// - Для работы этого файла нужно в админ-панели в "Настройки форумов" включить опцию "Проверять announce url"

// Примеры:
// $announce_urls[] = 'http://demo.torrentpier.com/bt/announce.php';
// $announce_urls[] = 'http://tracker.openbittorrent.com:80/announce';
// $announce_urls[] = 'udp://tracker.openbittorrent.com:6969/announce';
