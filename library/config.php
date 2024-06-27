<?php

if (!defined('BB_ROOT')) die(basename(__FILE__));

$bb_cfg = $tr_cfg = $page_cfg = array();

// Increase number after changing js or css
$bb_cfg['js_ver'] = $bb_cfg['css_ver'] = 1;

// Primary domain name
$domain_name = 'torrentpier.com'; // укажите здесь домен на котором запущен сайт (IDN домены поддерживаются)
$domain_name = (!empty($_SERVER['SERVER_NAME'])) ? idn_to_utf8($_SERVER['SERVER_NAME']) : $domain_name;

// Domain secure (HTTPS)
$domain_ssl = false; // используется ли SSL сертификат (HTTPS) на сайте

// Version info
$bb_cfg['tp_version'] = '2.1.5-2024.07 [Final v5]';
$bb_cfg['tp_release_date'] = '27-06-2024';
$bb_cfg['tp_release_state'] = 'LTS';
$bb_cfg['tp_zf_version'] = '2.4.13 (Latest)';

// Database
$charset  = 'utf8'; // кодировка базы данных
$pconnect = false;  // постоянное соединение с сервером MySQL | https://www.php.net/manual/ru/function.mysql-pconnect.php

// Настройка баз данных ['db']['srv_name'] => (array) srv_cfg;
// порядок параметров srv_cfg (хост:порт, название базы, пользователь, пароль, кодировка, постоянное соединение);
$bb_cfg['db'] = array(
	'db1' => array('localhost:3306', 'tp_215_lts', 'user', 'pass', $charset, $pconnect),
	//'db2' => array('localhost2:3306', 'dbase2', 'user2', 'pass2', $charset, $pconnect),
	//'db3' => array('localhost3:3306', 'dbase3', 'user2', 'pass3', $charset, $pconnect),
);

$bb_cfg['db_alias'] = array(
//	'alias'  => 'srv_name'
#	db1
	'log'    => 'db1', // BB_LOG
	'search' => 'db1', // BB_TOPIC_SEARCH
	'sres'   => 'db1', // BB_BT_USER_SETTINGS, BB_SEARCH_RESULTS
	'u_ses'  => 'db1', // BB_USER_SES, BB_USER_LASTVISIT
#	db2
	'dls'    => 'db1', // BB_BT_DLS_*
	'ip'     => 'db1', // BB_POSTS_IP
	'ut'     => 'db1', // BB_TOPICS_USER_POSTED
#	db3
	'pm'     => 'db1', // BB_PRIVMSGS, BB_PRIVMSGS_TEXT
	'pt'     => 'db1', // BB_POSTS_TEXT
);

// Cache
$bb_cfg['cache']['pconnect'] = true;
$bb_cfg['cache']['db_dir']   = realpath(BB_ROOT) .'/internal_data/cache/filecache/';
$bb_cfg['cache']['prefix']   = 'tp_';  // Префикс кеша ('tp_')
$bb_cfg['cache']['memcache'] = array(
	'host'         => '127.0.0.1',
	'port'         => 11211,
	'pconnect'     => true,
	'con_required' => true,
);
$bb_cfg['cache']['redis']  = array(
	'host'         => '127.0.0.1',
	'port'         => 6379,
	'pconnect'     => PHP_ZTS ? false : true,
	'con_required' => true,
);

// Available cache types: filecache, memcache, sqlite, redis, apc, xcache (default filecache)
# name => array( (string) type, (array) cfg )
$bb_cfg['cache']['engines'] = array(
	'bb_cache'      => array('filecache', array()),
	'bb_config'     => array('filecache', array()),
	'tr_cache'      => array('filecache', array()),
	'session_cache' => array('filecache', array()),
	'bb_cap_sid'    => array('filecache', array()),
	'bb_login_err'  => array('filecache', array()),
	'bb_poll_data'  => array('filecache', array()),
);
// Datastore
// Available datastore types: filecache, memcache, sqlite, redis, apc, xcache (default filecache)
$bb_cfg['datastore_type'] = 'filecache';

// Server
$bb_cfg['server_name'] = $domain_name;                                                     // The domain name from which this board runs
$bb_cfg['server_port'] = (!empty($_SERVER['SERVER_PORT'])) ? $_SERVER['SERVER_PORT'] : 80; // The port your server is running on
$bb_cfg['script_path'] = '/';                                                              // The path where FORUM is located relative to the domain name

// GZip
$bb_cfg['gzip_compress']      = true;              // использовать ли GZip сжатие на страницах

// Tracker
$bb_cfg['announce_interval']  = 2400;              // Announce interval (default: 2400)
$bb_cfg['passkey_key']        = 'uk';              // Passkey key name in GET request
$bb_cfg['ignore_reported_ip'] = false;             // Ignore IP reported by client
$bb_cfg['verify_reported_ip'] = true;              // Verify IP reported by client against $_SERVER['HTTP_X_FORWARDED_FOR']
$bb_cfg['allow_internal_ip']  = false;             // Allow internal IP (10.xx.. etc.)
$bb_cfg['client_ban'] = array(
	'enabled' => false,
	// Clients to be blocked, for example, peer id '-UT' will block all uTorrent clients, '-UT2' will block builds starting with 2 (default: false)
	// The second argument is being shown in the torrent client as a failure message
	// Handy client list: https://github.com/transmission/transmission/blob/f85c3b6f8db95d5363f6ec38eee603f146c6adb6/libtransmission/clients.cc#L504
	'clients' => array(
		'-UT' => 'uTorrent — NOT ad-free and open-source',
		'-MG' => 'Mostly leeching client',
	)
);

// Ocelot
$bb_cfg['ocelot']['port'] = 34000;
$bb_cfg['ocelot'] = array(
	'enabled' => false,
	'host'    => $domain_name,
	'url'     => "http://$domain_name:{$bb_cfg['ocelot']['port']}/", // with '/'
	'secret'  => 'some_10_chars',              // 10 chars
	'stats'   => 'some_10_chars',              // 10 chars
);

// FAQ url help link (Полезные ссылки / ЧаВо)
$bb_cfg['how_to_download_url_help']  = 'viewtopic.php?t=1'; // Как скачивать?
$bb_cfg['what_is_torrent_url_help']  = 'viewtopic.php?t=2'; // Что такое торрент?
$bb_cfg['ratio_url_help']            = 'viewtopic.php?t=3'; // Рейтинг и ограничения
$bb_cfg['search_help_url']           = 'viewtopic.php?t=4'; // Помощь по поиску

// Torrents
$bb_cfg['bt_min_ratio_allow_dl_tor'] = 0.3;        // 0 - disable
$bb_cfg['bt_min_ratio_warning']      = 0.6;        // 0 - disable

$tr_cfg = array(
	'autoclean'             => true,
	'off'                   => false,
	'off_reason'            => 'Temporarily disabled',
	'numwant'               => 50,
	'update_dlstat'         => true,
	'expire_factor'         => 2.5,
	'compact_mode'          => true,
	'upd_user_up_down_stat' => true,
	'browser_redirect_url'  => '', // TODO: переадресация на этот URL при попытке зайти на трекер Web browser'ом
	'scrape'                => true,
	'limit_active_tor'      => true,
	'limit_seed_count'      => 0,
	'limit_leech_count'     => 8,
	'leech_expire_factor'   => 60,
	'limit_concurrent_ips'  => false,
	'limit_seed_ips'        => 0,
	'limit_leech_ips'       => 0,
	'tor_topic_up'          => true,
	'gold_silver_enabled'   => true, // при включенном gold_silver_enabled нужно отключить freeleech!
	'retracker'             => true,
	'retracker_host'        => 'http://retracker.local/announce',
	'freeleech'             => false, // при включенном freeleech нужно отключить gold_silver_enabled!
);

$bb_cfg['show_dl_status_in_search'] = true; // показывать DL-статус раздач в результатах поиска
$bb_cfg['show_dl_status_in_forum']  = true; // показывать DL-статус раздач при просмотре форума
$bb_cfg['show_tor_info_in_dl_list'] = true;
$bb_cfg['allow_dl_list_names_mode'] = true;

$bb_cfg['torrent_name_style'] = true; // использовать имя файла в названии торрент-файла (Пример: [yoursite.com].txxx.torrent)
$bb_cfg['tor_help_links']     = '<div class="mrg_2"><a target="_blank" class="genmed" href="https://torrentpier.com/forums/osnovnye-voprosy-po-torrentpier.10/">Полезная информация</a></div>'; // дополнительная информация (полезные ссылки например) в топике снизу раздачи

// Сколько дней сохранять торрент зарегистрированным / Days to keep torrent registered, if:
$bb_cfg['seeder_last_seen_days_keep']  = 0; // сколько дней назад был сид последний раз
$bb_cfg['seeder_never_seen_days_keep'] = 0; // сколько дней имеется статус "Сида не было никогда"

// Ratio limits
define('TR_RATING_LIMITS', true);        // ON/OFF
define('MIN_DL_FOR_RATIO', 10737418240); // 10 GB in bytes, 0 - disable

// Don't change the order of ratios (from 0 to 1)
// rating < 0.4 -- allow only 1 torrent for leeching
// rating < 0.5 -- only 2
// rating < 0.6 -- only 3
// rating > 0.6 -- depend on your tracker config limits (in "ACP - Tracker Config - Limits")
$rating_limits = array(
	'0.4' => 1,
	'0.5' => 2,
	'0.6' => 3,
);

// DL-Status (days to keep user's dlstatus records)
$bb_cfg['dl_will_days_keep']     = 360;
$bb_cfg['dl_down_days_keep']     = 180;
$bb_cfg['dl_complete_days_keep'] = 180;
$bb_cfg['dl_cancel_days_keep']   = 30;

// Tor-Stats
$bb_cfg['torstat_days_keep']     = 60;    // days to keep user's per-torrent stats

// Tor-Help
$bb_cfg['torhelp_enabled']       = false; // find dead torrents (without seeder) that user might help seeding

$page_cfg['show_torhelp'] = array(
	// Формат: 'Значение константы BB_SCRIPT в php файле нужной страницы' => true
	'index'   => true,
	'tracker' => true,
);

// Path (trailing slash '/' at the end: XX_PATH - without, XX_DIR - with)
define('BB_PATH',       realpath(BB_ROOT)                    );
define('ADMIN_DIR',     BB_PATH .'/admin/'                   );
define('DATA_DIR',      BB_PATH .'/data/'                    );
define('INT_DATA_DIR',  BB_PATH .'/internal_data/'           );
define('AJAX_HTML_DIR', BB_ROOT .'/internal_data/ajax_html/' );
define('CACHE_DIR',     BB_PATH .'/internal_data/cache/'     );
define('LOG_DIR',       BB_PATH .'/internal_data/log/'       );
define('SITEMAP_DIR',   BB_PATH .'/internal_data/sitemap/'   );
define('TRIGGERS_DIR',  BB_PATH .'/internal_data/triggers/'  );
define('AJAX_DIR',      BB_ROOT .'/library/ajax/'            );
define('ATTACH_DIR',    BB_PATH .'/library/attach_mod/'      );
define('CFG_DIR',       BB_PATH .'/library/config/'          );
define('INC_DIR',       BB_PATH .'/library/includes/'        );
define('CLASS_DIR',     BB_PATH .'/library/includes/classes/');
define('CORE_DIR',      BB_PATH .'/library/includes/core/'   );
define('UCP_DIR',       BB_PATH .'/library/includes/ucp/'    );
define('LANG_ROOT_DIR', BB_PATH .'/library/language/'        );
define('IMAGES_DIR',    BB_PATH .'/styles/images/'           );
define('TEMPLATES_DIR', BB_PATH .'/styles/templates/'        );

// URL's
$bb_cfg['ajax_url']    = 'ajax.php';     #  "http://{$_SERVER['SERVER_NAME']}/ajax.php"
$bb_cfg['dl_url']      = 'dl.php?id=';   #  "http://{$domain_name}/dl.php?id="
$bb_cfg['login_url']   = 'login.php';    #  "http://{$domain_name}/login.php"
$bb_cfg['posting_url'] = 'posting.php';  #  "http://{$domain_name}/posting.php"
$bb_cfg['pm_url']      = 'privmsg.php';  #  "http://{$domain_name}/privmsg.php"

// Language
$bb_cfg['charset']     = 'utf-8';

if (isset($bb_cfg['default_lang']) && file_exists(LANG_ROOT_DIR . $bb_cfg['default_lang'] .'/'))
{
	$bb_cfg['default_lang_dir'] = LANG_ROOT_DIR . $bb_cfg['default_lang'] .'/';
}
else
{
	$bb_cfg['default_lang_dir'] = LANG_ROOT_DIR .'en/';
}

$bb_cfg['lang'] = array(
	// Список доступных языков
	'ru' => array(
		'name'     => 'Русский',
		'locale'   => 'ru_RU.UTF-8',
		'encoding' => 'UTF-8',
	),
	'uk' => array(
		'name'     => 'Український',
		'locale'   => 'uk_UA.UTF-8',
		'encoding' => 'UTF-8',
	),
	'en' => array(
		'name'     => 'English',
		'locale'   => 'en_US.UTF-8',
		'encoding' => 'UTF-8',
	),
);

// Templates
define('ADMIN_TPL_DIR', TEMPLATES_DIR .'/admin/'); // путь к директории с шаблонами к админ-панели

$bb_cfg['templates'] = array( // Список доступных шаблонов
	// Формат: 'папка_шаблона' => 'Название шаблона'
	'default' => 'Стандартный',
);

$bb_cfg['tpl_name']   = 'default';  // шаблон по умолчанию
$bb_cfg['stylesheet'] = 'main.css'; // указать основной файл стилей используемый в шаблоне

$bb_cfg['show_sidebar1_on_every_page'] = false; // показывать левый сайд-бар на каждой странице
$bb_cfg['show_sidebar2_on_every_page'] = false; // показывать правый сайд-бар на каждой странице

$page_cfg['show_sidebar1'] = array( // укажите на каких страницах отображать левый сайд-бар
	// Формат: 'Значение константы BB_SCRIPT в php файле нужной страницы' => true
	'index'   => true,
);
$page_cfg['show_sidebar2'] = array( // укажите на каких страницах отображать правый сайд-бар
	// Формат: 'Значение константы BB_SCRIPT в php файле нужной страницы' => true
	'index'   => true,
);

// Cookie
$bb_cfg['cookie_domain'] = in_array($domain_name, array($_SERVER['SERVER_ADDR'], 'localhost')) ? '' : ".$domain_name"; // НЕ НУЖНО менять "localhost"
$bb_cfg['cookie_secure'] = ($domain_ssl ? 1 : (int)is_secure());
$bb_cfg['cookie_prefix'] = 'bb_'; // Префикс для cookie файлов ('bb_')

// Sessions
$bb_cfg['session_update_intrv']    = 180;          // sec
$bb_cfg['user_session_duration']   = 1800;         // sec
$bb_cfg['admin_session_duration']  = 6*3600;       // sec
$bb_cfg['user_session_gc_ttl']     = 1800;         // number of seconds that a staled session entry may remain in sessions table
$bb_cfg['session_cache_gc_ttl']    = 1200;         // sec
$bb_cfg['max_last_visit_days']     = 14;           // days
$bb_cfg['last_visit_update_intrv'] = 3600;         // sec
$bb_cfg['last_visit_date_format']  = 'Y-m-d H:i';  // формат даты последнего визита на сайте
$bb_cfg['last_activity_date_format'] = 'Y-m-d H:i'; // формат даты последней активности на сайте

// Registration
$bb_cfg['invalid_logins']          = 5;            // Количество неверных попыток ввода пароля, перед выводом проверки капчей
$bb_cfg['new_user_reg_disabled']   = false;        // Запретить регистрацию новых учетных записей
$bb_cfg['unique_ip']               = false;        // Запретить регистрацию нескольких учетных записей с одного ip
$bb_cfg['new_user_reg_restricted'] = array(
	// Ограничить регистрацию новых пользователей по времени
	'enabled'    => false,
	'time_start' => '12:00', // Время начала регистрации
	'time_end'   => '21:00'  // Время окончания регистрации (Включительно)
);
$bb_cfg['reg_email_activation']    = true;         // Требовать активацию учетной записи по email
$bb_cfg['reg_date_format']         = 'Y-m-d H:i';  // формат даты регистрации / даты вступления пользователя

// Email
$bb_cfg['emailer_disabled']        = false; // отключить ли отправку почты с сайта

$bb_cfg['smtp_delivery']           = false; // использовать ли SMTP (если false, то будет использоваться нативная функция mail())
$bb_cfg['smtp_type']               = '';    // Тип подключения (Доступные значения: ssl, tls, пустое значение)
$bb_cfg['smtp_cert_verify']        = true;  // Проверять ли SSL сертификат (Рекомендуется отключить при локальной разработке)
$bb_cfg['smtp_host']               = '';    // SMTP название хоста
$bb_cfg['smtp_port']               = 25;    // SMTP порт сервера (Для SSL - 465, Для TLS - 587, по умолчанию - 25)
$bb_cfg['smtp_username']           = '';    // указать имя пользователя SMTP (если требуется)
$bb_cfg['smtp_password']           = '';    // указать пароль для SMTP (если требуется)

$bb_cfg['board_email']             = "noreply@$domain_name"; // почта с которой будет происходить отправка писем, она же будет указываться как почта сайта
$bb_cfg['board_email_form']        = false;        // могут ли пользователи отправлять друг другу электронные письма через сайт
$bb_cfg['board_email_sig']         = '';           // подпись под сообщениями
$bb_cfg['board_email_sitename']    = $domain_name; // название сайта (хост) который будет указываться в сообщениях

$bb_cfg['topic_notify_enabled']    = true; // отправлять ли уведомление на почту, если в теме которую отслеживает пользователь есть новые ответы
$bb_cfg['pm_notify_enabled']       = true; // включить отображение пункта "Уведомлять о новых личных сообщениях" в настройках профиля
$bb_cfg['group_send_email']        = true; // отправлять ли уведомление на почту, если пользователя приняли в группу, пригласили в группу
$bb_cfg['email_change_disabled']   = false; // отключить возможность изменять почту самим пользователям
$bb_cfg['show_email_visibility_settings'] = true; // включить отображение пункта "Показывать мой адрес e-mail в профиле" в настройках профиля

$bb_cfg['tech_admin_email']        = "admin@$domain_name"; // почта технической поддержки (тех. админа / создателя)
$bb_cfg['abuse_email']             = "abuse@$domain_name"; // почта для жалоб (абуз, правообладатели)
$bb_cfg['adv_email']               = "adv@$domain_name";   // почта для рекламных предложений

// Debug
define('SPHINX_LOG_ERRORS',    true);             // логировать ошибки Sphinx
define('SPHINX_LOG_NAME',      'sphinx_errors');  // имя файла с логами Sphinx

define('DBG_LOG',              true);             // включить логирование событий движка (отключите на боевом сервере)
define('DBG_LOG_TRACKER',      false);            // включить логирование событий анонсера (отключите на боевом сервере)

define('SQL_DEBUG',            true);             // включить SQL отладку (в дебаг панели) для SQL запросов и Cache & Datastore
define('SQL_LOG_ERRORS',       true);             // логировать ошибки MySQL
define('SQL_BB_LOG_NAME',      'sql_error_bb');   // имя лог файла с SQL ошибками (Форум)
define('SQL_TR_LOG_NAME',      'sql_error_tr');   // имя лог файла с SQL ошибками (Трекер aka анонсер)
define('SQL_CALC_QUERY_TIME',  true);             // отображать время выполнения запросов (для SQL запросов и Cache & Datastore)
define('SQL_LOG_SLOW_QUERIES', true);             // логировать медленные запросы
define('SQL_SLOW_QUERY_TIME',  10);               // время после которого запрос считается медленным (в секундах)
define('SQL_PREPEND_SRC_COMM', true);             // отображать файл:строку в которой происходит выполнение текущего запроса (для SQL запросов и Cache & Datastore, так же в логах и сообщениях об ошибке)

// Special users
$bb_cfg['dbg_users'] = array( // Пользователи которым доступна дебаг панель / отладка (тех. админы например)
	// Формат: 'id пользователя' => 'ник'
	2 => 'admin',
);

$bb_cfg['unlimited_users'] = array( // Пользователи на которых не действует ограничение на количество одновременных закачек / раздач
	// Формат: 'id пользователя' => 'ник'
	2 => 'admin',
);

$bb_cfg['super_admins'] = array( // Супер-админы (разработчики сайта)
	// Формат: 'id пользователя' => 'ник'
	2 => 'admin',
);

// Log options
define('LOG_EXT',      'log'); // расширение лог файла
define('LOG_SEPR',     ' | '); // разделить в лог файле
define('LOG_LF',       "\n");  // символ переноса строки
define('LOG_MAX_SIZE', 1048576); // максимальный размер лог файла (в байтах)

// Error reporting
ini_set('error_reporting', E_ALL); // уровень отладки | https://www.php.net/manual/ru/errorfunc.constants.php
ini_set('display_errors',  0); // показывать ли ошибки
ini_set('display_startup_errors', 0); // показывать ли ошибки запуска | https://www.php.net/manual/en/errorfunc.configuration.php#ini.display-startup-errors
ini_set('log_errors',      1); // логировать ли ошибки
ini_set('error_log',       LOG_DIR .'php_err.log'); // имя лог файла (нативный лог)

// Triggers
define('BB_ENABLED',   TRIGGERS_DIR .'$on');
define('BB_DISABLED',  TRIGGERS_DIR .'$off');
define('CRON_ALLOWED', TRIGGERS_DIR .'cron_allowed');
define('CRON_RUNNING', TRIGGERS_DIR .'cron_running');

// Date format
$bb_cfg['date_format']             = 'Y-m-d'; // общий формат даты (оставлено для обратной совместимости!)

// Subforums
$bb_cfg['sf_on_first_page_only']   = true; // показывать подфорумы только на первой странице форума

// Forums
$bb_cfg['allowed_topics_per_page'] = array(50, 100, 150, 200, 250, 300); // разрешенное количество топиков на страницу
$bb_cfg['last_post_date_format']   = 'd-M-y H:i'; // формат даты последнего поста (на странице просмотра форума и на главной)

// Topics
$bb_cfg['show_quick_reply']       = true;          // показывать форму быстрого ответа
$bb_cfg['show_rank_text']         = false;         // показывать название лычки в топиках
$bb_cfg['show_rank_image']        = true;          // показывать картинку лычки в топиках
$bb_cfg['show_poster_joined']     = true;          // показывать дату регистрации пользователя в топиках
$bb_cfg['show_poster_posts']      = true;          // показывать количество постов пользователя в топиках
$bb_cfg['show_poster_from']       = true;          // показывать страну пользователя
$bb_cfg['show_bot_nick']          = true;          // показывать ник бота
$bb_cfg['text_buttons']           = false;         // использоваться текстовые кнопки вместо иконок
$bb_cfg['parse_ed2k_links']       = true;          // TODO: make ed2k links clickable
$bb_cfg['post_date_format']       = 'd-M-Y H:i';   // формат даты публикации в топиках
$bb_cfg['ext_link_new_win']       = true;          // открывать внешние (сторонние) ссылки в отдельном окне
$bb_cfg['fix_quote_button']       = false;         // использовать фикс 'Hide quote button'

$bb_cfg['topic_moved_days_keep']  = 7;             // remove topic moved links after xx days (or FALSE to disable)

$bb_cfg['allowed_posts_per_page'] = array(15, 30, 50, 100); // разрешенное количество постов на страницу

$bb_cfg['user_signature_start']   = '<div class="signature"><br />_________________<br />';
$bb_cfg['user_signature_end']     = '</div>';

// Posts
$bb_cfg['use_posts_cache']        = true;          // использовать кэширование постов (Перед использованием рекомендуется очистить таблицу `bb_posts_html`)
$bb_cfg['posts_cache_days_keep']  = 14;            // через сколько дней очищать кэш постов
$bb_cfg['use_ajax_posts']         = true;          // использовать AJAX при редактировании постов (Рекомендуется)

// Search
$bb_cfg['search_engine_type']         = 'mysql';   // драйвер для поиска (варианты: none, mysql, sphinx)

$bb_cfg['sphinx_topic_titles_host']   = '127.0.0.1';
$bb_cfg['sphinx_topic_titles_port']   = 3312;
$bb_cfg['sphinx_config_path']         = realpath("../install/sphinx/sphinx.conf");

$bb_cfg['disable_ft_search_in_posts'] = false;     // отключить поиск слов в теле сообщения
$bb_cfg['disable_search_for_guest']   = true;      // отключить поиск для гостей
$bb_cfg['allow_search_in_bool_mode']  = true;
$bb_cfg['max_search_words_per_post']  = 200;       // максимальное число слов в рамках одного поста
$bb_cfg['search_min_word_len']        = 3;         // минимальное число слов для поиска
$bb_cfg['search_max_word_len']        = 35;        // максимальное число слов для поиска
$bb_cfg['limit_max_search_results']   = false;     // ограничить число результатов поиска (указать максимальное число результатов) (false - выключено)
$bb_cfg['autocorrect_wkl']            = true;      // (ЭКСПЕРИМЕНТАЛЬНАЯ ФУНКЦИЯ) автоматическое исправление языка для слов в тексте из-за неправильной раскладки клавиатуры

// Spam filter
// Путь к файлу (например): INT_DATA_DIR . 'spam_filter_words.txt';
$bb_cfg['spam_filter_file_path']      = false;     // спам фильтр (нужно указать путь к файлу со спам-словами) (false - выключено)
$bb_cfg['spam_filter_replacement']    = '*СПАМ*';  // слово на которое будет заменен спам

// Posting
$bb_cfg['prevent_multiposting']       = true;      // TODO: заменить кнопку "ответить" на "отредактировать последнее сообщение" если автор последнего сообщения не является модератором или админом
$bb_cfg['prevent_multiposting_time']  = 600;       // TODO: время в течении которого будет отображаться кнопка "отредактировать последнее сообщение" (в секундах, по умолчанию: 10 минут)

$bb_cfg['max_smilies']          = 25;              // Максимальное число смайлов в посте (false - выключено)
$bb_cfg['max_symbols_post']     = 5000;            // TODO: Максимальное число символов в посте (false - выключено)

// PM
$bb_cfg['privmsg_disable']      = false;           // отключить систему личных сообщений на форуме
$bb_cfg['max_outgoing_pm_cnt']  = 10;              // TODO: ограничение на кол. одновременных исходящих лс (для замедления рассылки спама)
$bb_cfg['max_inbox_privmsgs']   = 500;             // максимальное число сообщений в папке входящие
$bb_cfg['max_savebox_privmsgs'] = 500;             // максимальное число сообщений в папке сохраненные
$bb_cfg['max_sentbox_privmsgs'] = 500;             // максимальное число сообщений в папке отправленные
$bb_cfg['max_smilies_pm']       = 15;              // максимальное число смайлов в сообщении (false - выключено)
$bb_cfg['max_symbols_pm']       = 1500;            // TODO: максимальное число символов в сообщении (false - выключено)
$bb_cfg['pm_days_keep']         = 0;               // время хранения ЛС (0 - без ограничения)

// Actions log
$bb_cfg['log_days_keep'] = 365;                    // время хранения истории действий (0 - без ограничения)

// Poll
$bb_cfg['poll_max_days'] = 180;                    // сколько дней с момента создания темы опрос будет активным

// Users
$bb_cfg['color_nick']                   = true;    // Окраска ников пользователей по user_rank
$bb_cfg['user_not_activated_days_keep'] = 7;       // Спустя сколько дней удалять пользователей которые не завершили регистрацию (то-есть аккаунт не активирован)
$bb_cfg['user_not_active_days_keep']    = 180;     // Спустя сколько дней удалять пользователей которые были неактивны и при этом не имеют ни одного сообщения

// Groups
$bb_cfg['group_members_per_page']       = 50;      // количество групп отображаемых на одной странице

// Tidy
$bb_cfg['tidy_post'] = (!in_array('tidy', get_loaded_extensions())) ? false : true;

// Ads
$bb_cfg['show_ads'] = false;
$bb_cfg['show_ads_users'] = array(
	// Формат: 'id пользователя' => 'ник'
	2      => 'admin',
);

// block_type => [block_id => block_desc]
$bb_cfg['ad_blocks'] = array(
	'trans' => array(
		100 => 'сквозная сверху',
	),
	'index' => array(
		200 => 'главная, под новостями',
	),
);

// Misc
define('MEM_USAGE', function_exists('memory_get_usage'));

$bb_cfg['mem_on_start'] = (MEM_USAGE) ? memory_get_usage() : 0;

$bb_cfg['translate_dates'] = true; // in displaying time
$bb_cfg['use_word_censor'] = true; // использовать цензор слов
$bb_cfg['show_jumpbox']    = true; // показывать ли jumpbox (на viewtopic.php и viewforum.php)
$bb_cfg['current_time_date_format'] = 'd-M H:i'; // формат блока "текущее время" на сайте
$bb_cfg['show_completed_count'] = false; // показывать для торрентов количество завершенных скачиваний (НЕ РЕКОМЕНДУЕТСЯ МЕНЯТЬ ЗНАЧЕНИЕ)

$bb_cfg['allow_change'] = array(
	'language'   => true, // разрешить смену языка пользователем
	'dateformat' => true, // TODO: разрешить смену формата даты и времени
);

define('GZIP_OUTPUT_ALLOWED', (extension_loaded('zlib') && !ini_get('zlib.output_compression')));

$banned_user_agents = array(
// Download Master
#	'download',
#	'master',
// Others
#	'wget',
);

$bb_cfg['trash_forum_id'] = 0; // (int) 7

$bb_cfg['first_logon_redirect_url'] = 'index.php'; // на какую страницу перекидывать пользователя после завершения регистрации
$bb_cfg['terms_and_conditions_url'] = 'terms.php'; // ссылка на страницу с правилами форума

$bb_cfg['user_agreement_url']       = 'info.php?show=user_agreement';
$bb_cfg['copyright_holders_url']    = 'info.php?show=copyright_holders';
$bb_cfg['advert_url']               = 'info.php?show=advert';

$bb_cfg['sitemap_sending'] = array( // Список URL адресов на которые производить отправку карты сайта для индексации поисковым роботом.
	// Формат: 'Название ресурса' => 'ссылка на endpoint'
	'Google' => 'https://google.com/webmasters/sitemaps/ping?sitemap=',
);

// Extensions [расширения разрешенные для загрузки через upload_common() класс только!]
$bb_cfg['file_id_ext'] = array(
	1 => 'gif',
	2 => 'gz',
	3 => 'jpg',
	4 => 'png',
	5 => 'rar',
	6 => 'tar',
	8 => 'torrent',
	9 => 'zip',
	999 => '7z'
);

// Attachments
$bb_cfg['attach'] = array(
	'upload_path' => DATA_DIR . 'torrent_files',      // путь к директории с torrent файлами
	'max_size'    => 5*1024*1024,                     // TODO: максимальный размер файла
);

$bb_cfg['tor_forums_allowed_ext'] = array('torrent', 'zip', 'rar'); // TODO: для разделов с раздачами
$bb_cfg['gen_forums_allowed_ext'] = array('zip', 'rar');            // TODO: для обычных разделов

// Avatars
$bb_cfg['avatars'] = array(
	'allowed_ext' => array('gif','jpg','png','bmp'),  // разрешенные форматы файлов (При добавлении нового расширения, продублируйте в $bb_cfg['file_id_ext'])
	'bot_avatar'  => 'gallery/bot.gif',               // аватара бота
	'max_size'    => 100*1024,                        // размер аватары в байтах
	'max_height'  => 100,                             // высота аватара в px
	'max_width'   => 100,                             // ширина аватара в px
	'no_avatar'   => 'gallery/noavatar.png',          // дефолтная аватара
	'upload_path' => BB_ROOT . 'data/avatars/',       // путь к директории с аватарами
	'up_allowed'  => true,                            // разрешить загрузку аватар
);

// Group avatars
$bb_cfg['group_avatars'] = array(
	'allowed_ext' => array('gif','jpg','png','bmp'),  // разрешенные форматы файлов (При добавлении нового расширения, продублируйте в $bb_cfg['file_id_ext'])
	'max_size'    => 300*1024,                        // размер аватары в байтах
	'max_height'  => 300,                             // высота аватара в px
	'max_width'   => 300,                             // ширина аватара в px
	'no_avatar'   => 'gallery/noavatar.png',          // дефолтная аватара
	'upload_path' => BB_ROOT . 'data/avatars/',       // путь к директории с аватарами
	'up_allowed'  => true,                            // разрешить загрузку аватар
);

// Captcha (reCAPTCHA v2)
// Получить ключи можно в админ-панели reCAPTCHA: https://www.google.com/recaptcha/admin
$bb_cfg['captcha'] = array(
	'disabled'   => true, // отключить капчу
	'public_key' => '',   // ключ сайта
	'secret_key' => '',   // секретный ключ
	'theme'      => 'light', // выбор темы (доступны: light, dark)
);

// Atom feed
$bb_cfg['atom'] = array(
	// Примечание: Без слэша в конце
	'path' => INT_DATA_DIR .'atom',
	'url'  => './internal_data/atom',
	'direct_down' => true, // Разрешить прямую загрузку торрентов из atom ленты
);

// Nofollow
$bb_cfg['nofollow'] = array(
	'disabled'    => false, // отключить добавление атрибута rel="nofollow" к ссылкам | https://ru.wikipedia.org/wiki/Nofollow
	'allowed_url' => array($domain_name), // список разрешённых сайтов (на которые не действует добавление rel="nofollow")
);

define('BB_CFG_LOADED', true);
