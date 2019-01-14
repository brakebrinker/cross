<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'supercross');

/** Имя пользователя MySQL */
define('DB_USER', 'supercross');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'supercross');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'qDDvUm}vg2aXs]P}8{UC @PpOC98AM>PYq`qPatB-RbPEUoe3sAM>[.pT?>y!3cq');
define('SECURE_AUTH_KEY',  ']mQ(/gk/l6t.%]j]2*~m7[:0?TGrsSwyY=ET_;^%<):%0/,sn<wW2D[C7lqe}FYi');
define('LOGGED_IN_KEY',    'p*7F+J [toZv*z0Dl=un4Z(H!F+hu ^s(%Gf@i.W#e^v~4$(}kbAZ_MBH]|}Y>Zd');
define('NONCE_KEY',        'rGLUtwh3BUTob2HYTkKM{5UUN daW27[t9pReyA/ JtUu(aqeSt2~6ccw|he*1gE');
define('AUTH_SALT',        ']rr&!,;O0WO~K-8U%,;l4n@k[AFWCsLazQu&se+4b]R)VtpiYI;kzS>c,pig4DOj');
define('SECURE_AUTH_SALT', 'M)o)*hrRFmXuT>xd)Bm,I8S] P!]qL9;sm4=[{e(xBioB3VO6wtR5+|W-$?;XEU5');
define('LOGGED_IN_SALT',   '/AlM_Opb#7w5C@_&*6Ls92Z)lr]Q#v=-zoJZP}U+.jQ8TS4|vsT?|B,>nBVVqiU`');
define('NONCE_SALT',       'Bmi43dfv4S@XhTG,1(=-ZK)Wg9]:W`6SR<Sq19s2X[=t]Dat$Zx2,I W 4#R=0sx');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
