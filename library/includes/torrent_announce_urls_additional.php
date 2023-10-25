<?php

if (!defined('BB_ROOT')) die(basename(__FILE__));

$additional_announce_urls = array();

// Здесь вы можете указать дополнительные URL-адреса анонсеров, которые будут добавляться к вашим раздачам
//
// Примечание:
// - Анонсеры с GET параметрами (например passkey или иной аутентификатор доступа) лучше не добавлять
// - Для работы этого файла нужно в админ-панели в "Настройки форумов" отключить опцию "Удалять все дополнительные announce urls"
//
// Примеры:
// $additional_announce_urls[] = 'http://tracker.openbittorrent.com:80/announce';
// $additional_announce_urls[] = 'udp://tracker.openbittorrent.com:6969/announce';
