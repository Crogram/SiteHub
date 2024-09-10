<?php

// ini_set('display_errors', 'On');
// error_reporting(E_ALL);
// error_reporting(-1);
error_reporting(0);
define('IN_CRONLITE', true);
define('VERSION', '1002');
define('APP_VERSION', '1.0.4');
define('SYSTEM_ROOT', dirname(__FILE__));
define('ROOT', dirname(SYSTEM_ROOT));
// define('CC_Defender', 1);
@header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set("PRC");
$date = date("Y-m-d H:i:s");
session_start();

// if (CC_Defender != 0) {
//     include_once SYSTEM_ROOT . '/security.php';
// }

include_once(SYSTEM_ROOT . '/functions.php');
$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$site_http = (is_https() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
$site_path = substr($scriptpath, 0, strrpos($scriptpath, '/'));

if (file_exists(ROOT . '/install/index.php') && !file_exists(ROOT . '/install/install.lock')) {
    // 有安装脚本却没有锁定文件
    sysmsg('<h2>为了您站点安全，在您完成如下操作之前系统不会工作。</h2><ul><li><font size="4">如果您尚未安装本程序，请 <a href="' . $site_http . '/install/">前往安装</a></font></li><li><font size="4">如果您确认已经安装本程序，请删除 install 文件夹；或者在 /install 文件夹下放置一个 install.lock 文件。</font></li></ul><br/><h4>为什么必须建立 install.lock 文件？</h4>它是安装保护文件，如果检测不到它，就会认为站点还没安装，此时任何人都可以安装/重装此网站。<br/><br/>');
    exit;
}

if (!file_exists(ROOT . '/config.php')) {
    // 没有配置文件
    sysmsg('<h2>系统配置文件 config.php 丢失！</h2><a href="' . $site_http . '/install/">点击此处</a> 运行安装程序。', '站点提示信息', 1);
}

// 配置文件
require ROOT . '/config.php';
if (isset($app_config['subpath']) && !empty($app_config['subpath'])) {
    // 程序安装在子路径，移除URL中的子路径
    $site_path = str_replace($app_config['subpath'], '', $site_path);
}

$site_url = $site_http . $site_path;

if (!isset($dbconfig) || !$dbconfig['user'] || !$dbconfig['pwd'] || !$dbconfig['dbname']) // 检测安装1
{
    sysmsg('<h2>系统配置文件 config.php 异常！</h2><a href="' . $site_http . '/install/">点击此处</a> 运行安装程序。', '站点提示信息', 1);
}

include_once(SYSTEM_ROOT . '/autoloader.php');
Autoloader::register();
$DB = new \lib\PdoHelper($dbconfig);
if ($DB->query("select * from pre_config where 1") == FALSE) // 检测安装2
{
    echo '你还没安装！<a href="' . $site_http . '/install/">点此安装</a>';
    exit();
}

$conf = getAllSetting();
define('SYS_KEY', $conf['sys_key']);

$site_cdnpublic = $site_http . '/assets/';
$password_hash = '!@#%!s!0';
$admin_islogin = 0;

if (isset($_COOKIE["admin_token"])) {
    $token = authcode(daddslashes($_COOKIE['admin_token']), 'DECODE', SYS_KEY);
    list($user, $sid) = explode("\t", $token);
    $session = md5($conf['admin_user'] . $conf['admin_pwd'] . $password_hash);
    if ($session == $sid) {
        $admin_islogin = 1;
    }
}

if (defined('IN_ADMIN')) return;

if (isset($conf['blackip'])) {
    $denyip = explode('|', $conf['blackip']);
    $clientip = $_SERVER['REMOTE_ADDR'];
    if (in_array($clientip, $denyip) && !$admin_islogin) {
        header("HTTP/1.1 403 Forbidden");
        exit;
    }
}

$user_islogin = 0;
if (isset($_COOKIE["user_token"])) {
    $token = authcode(daddslashes($_COOKIE['user_token']), 'DECODE', SYS_KEY);
    if ($token) {
        list($uid, $sid, $expiretime) = explode("\t", $token);
        if ($userrow = $DB->getRow("SELECT * FROM pre_user WHERE uid='" . intval($uid) . "' LIMIT 1")) {
            $session = md5($userrow['type'] . $userrow['openid'] . $password_hash);
            if ($session === $sid && $expiretime > time()) {
                if ($userrow['enable'] == 1) {
                    $user_islogin = 1;
                } else {
                    $_SESSION['user_block'] = true;
                }
            }
        }
    }
}
