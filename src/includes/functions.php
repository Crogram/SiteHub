<?php

if (!function_exists("is_https")) {
    function is_https()
    {
        if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) {
            return true;
        } elseif (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) {
            return true;
        } elseif (isset($_SERVER['HTTP_X_CLIENT_SCHEME']) && $_SERVER['HTTP_X_CLIENT_SCHEME'] == 'https') {
            return true;
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            return true;
        } elseif (isset($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https') {
            return true;
        } elseif (isset($_SERVER['HTTP_EWS_CUSTOME_SCHEME']) && $_SERVER['HTTP_EWS_CUSTOME_SCHEME'] == 'https') {
            return true;
        }
        return false;
    }
}

function get_curl($url, $post = 0, $referer = 0, $cookie = 0, $header = 0, $ua = 0, $nobaody = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $httpheader[] = "Accept: */*";
    $httpheader[] = "Accept-Encoding: gzip,deflate,sdch";
    $httpheader[] = "Accept-Language: zh-CN,zh;q=0.8";
    $httpheader[] = "Connection: close";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    if ($header) {
        curl_setopt($ch, CURLOPT_HEADER, true);
    }
    if ($cookie) {
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    }
    if ($referer) {
        curl_setopt($ch, CURLOPT_REFERER, $referer);
    }
    if ($ua) {
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    } else {
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.0.4; es-mx; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0");
    }
    if ($nobaody) {
        curl_setopt($ch, CURLOPT_NOBODY, 1);
    }
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec($ch);
    curl_close($ch);
    return $ret;
}

function get_real_ip($type = 0)
{
    $ip = $_SERVER['REMOTE_ADDR'];
    // if ($type <= 0 && isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
    //     foreach ($matches[0] as $xip) {
    //         if (filter_var($xip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
    //             $ip = $xip;
    //             break;
    //         }
    //     }
    // } elseif ($type <= 0 && isset($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
    //     $ip = $_SERVER['HTTP_CLIENT_IP'];
    // } elseif ($type <= 1 && isset($_SERVER['HTTP_CF_CONNECTING_IP']) && filter_var($_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
    //     $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    // } elseif ($type <= 1 && isset($_SERVER['HTTP_X_REAL_IP']) && filter_var($_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
    //     $ip = $_SERVER['HTTP_X_REAL_IP'];
    // }

    if (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
        foreach ($matches[0] as $xip) {
            if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                $ip = $xip;
                break;
            }
        }
    }
    return $ip;
}

function get_ip_city($ip)
{
    // $url = 'http://whois.pconline.com.cn/ipJson.jsp?json=true&ip=';
    // $city = get_curl($url . $ip);
    // $city = mb_convert_encoding($city, "UTF-8", "GB2312");
    // $city = json_decode($city, true);
    // if ($city['city']) {
    //     $location = $city['pro'] . $city['city'];
    // } else {
    //     $location = $city['pro'];
    // }

    $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=';
    @$city = curl_get($url . $ip);
    $city = json_decode($city, true);
    if ($city['city']) {
        $location = $city['province'] . $city['city'];
    } else {
        $location = $city['province'];
    }
    if ($location) {
        return $location;
    } else {
        return false;
    }
}
function send_mail($to, $sub, $msg)
{
    global $conf;
    include_once ROOT . '/includes/smtp.class.php';
    $From = $conf['mail_name'];
    $Host = $conf['mail_stmp'];
    $Port = $conf['mail_port'];
    $SMTPAuth = 1;
    $Username = $conf['mail_name'];
    $Password = $conf['mail_pwd'];
    $Nickname = $conf['sitename'];
    $SSL = false;
    $mail = new SMTP($Host, $Port, $SMTPAuth, $Username, $Password, $SSL);
    $mail->att = array();
    if ($mail->send($to, $From, $sub, $msg, $Nickname)) {
        return true;
    } else {
        return $mail->log;
    }
}

// function daddslashes($string)
// {
//     if (is_array($string)) {
//         foreach ($string as $key => $val) {
//             $string[$key] = daddslashes($val);
//         }
//     } else {
//         $string = addslashes($string);
//     }
//     return $string;
// }

function daddslashes($string, $force = 0, $strip = FALSE)
{
    !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
    if (!MAGIC_QUOTES_GPC || $force) {
        if (is_array($string)) {
            foreach ($string as $key => $val) {
                $string[$key] = daddslashes($val, $force, $strip);
            }
        } else {
            $string = addslashes($strip ? stripslashes($string) : $string);
        }
    }
    return $string;
}

function strexists($string, $find)
{
    return !(strpos($string, $find) === FALSE);
}

function getSubstr($str, $leftStr, $rightStr)
{
    $left = strpos($str, $leftStr);
    //echo '左边:'.$left;
    $right = strpos($str, $rightStr, $left);
    //echo '<br>右边:'.$right;
    if ($left < 0 or $right < $left) return '';
    return substr($str, $left + strlen($leftStr), $right - $left - strlen($leftStr));
}

function dstrpos($string, $arr)
{
    if (empty($string)) return false;
    foreach ((array)$arr as $v) {
        if (strpos($string, $v) !== false) {
            return true;
        }
    }
    return false;
}

function checkDomain($domain)
{
    if (empty($domain) || !preg_match('/^[-$a-z0-9_*.]{2,512}$/i', $domain) || (stripos($domain, '.') === false) || substr($domain, -1) == '.' || substr($domain, 0, 1) == '.' || substr($domain, 0, 1) == '*' && substr($domain, 1, 1) != '.' || substr_count($domain, '*') > 1 || strpos($domain, '*') > 0 || strlen($domain) < 4) return false;
    return true;
}

function checkmobile()
{
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $ualist = array('android', 'midp', 'nokia', 'mobile', 'iphone', 'ipod', 'blackberry', 'windows phone');
    if ((dstrpos($useragent, $ualist) || strexists($_SERVER['HTTP_ACCEPT'], "VND.WAP") || strexists($_SERVER['HTTP_VIA'], "wap")))
        return true;
    else
        return false;
}

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
{
    $ckey_length = 4;
    $key = md5($key);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if ($operation == 'DECODE') {
        if (((int)substr($result, 0, 10) == 0 || (int)substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc . str_replace('=', '', base64_encode($result));
    }
}

function random($length, $numeric = 0)
{
    $seed = base_convert(md5(microtime() . $_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
    $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
    $hash = '';
    $max = strlen($seed) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $seed[mt_rand(0, $max)];
    }
    return $hash;
}

function showmsg($content = '未知的异常', $type = 4, $back = false)
{
    switch ($type) {
        case 1:
            $panel = "success";
            break;
        case 2:
            $panel = "info";
            break;
        case 3:
            $panel = "warning";
            break;
        case 4:
            $panel = "danger";
            break;
    }

    echo '<div class="panel panel-' . $panel . '">
      <div class="panel-heading">
        <h3 class="panel-title">提示信息</h3>
        </div>
        <div class="panel-body">';
    echo $content;

    if ($back) {
        echo '<hr/><a href="' . $back . '"><< 返回上一页</a>';
    } else
        echo '<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a>';

    echo '</div>
    </div>';
    exit;
}

function sysmsg($msg = '未知的异常',$title = '站点提示信息', $die = true) {
    $page=<<<HTML
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title}</title>
    <style type="text/css">
        html{background:#eee}body{background:#fff;color:#333;font-family:"微软雅黑","Microsoft YaHei",sans-serif;margin:2em auto;padding:1em 2em;max-width:700px;-webkit-box-shadow:10px 10px 10px rgba(0,0,0,.13);box-shadow:10px 10px 10px rgba(0,0,0,.13);opacity:.8}h1{border-bottom:1px solid #dadada;clear:both;text-align:center;color:#666;font:24px "微软雅黑","Microsoft YaHei",sans-serif;padding-bottom:30px}#error-page{margin-top:50px}#error-page p{font-size:9px;line-height:1.5;margin:25px 0 20px}#error-page code{font-family:Consolas,Monaco,monospace}ul li{margin-bottom:10px;font-size:9px}a{color:#21759B;text-decoration:none;margin-top:-10px}a:hover{color:#D54E21}.button{background:#f7f7f7;border:1px solid #ccc;color:#555;display:inline-block;text-decoration:none;font-size:9px;line-height:26px;height:28px;margin:0;padding:0 10px 1px;cursor:pointer;-webkit-border-radius:3px;-webkit-appearance:none;border-radius:3px;white-space:nowrap;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);vertical-align:top}.button.button-large{height:29px;line-height:28px;padding:0 12px}.button:focus,.button:hover{background:#fafafa;border-color:#999;color:#222}.button:focus{-webkit-box-shadow:1px 1px 1px rgba(0,0,0,.2);box-shadow:1px 1px 1px rgba(0,0,0,.2)}.button:active{background:#eee;border-color:#999;color:#333;-webkit-box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5)}table{table-layout:auto;border:1px solid #333;empty-cells:show;border-collapse:collapse}th{padding:4px;border:1px solid #333;overflow:hidden;color:#333;background:#eee}td{padding:4px;border:1px solid #333;overflow:hidden;color:#333}
    </style>
</head>
<body id="error-page">
    <h1>{$title}</h1>
    {$msg}
</body>
</html>
HTML;
    echo $page;
    if ($die == true) {
        exit;
    }
}

/**
 * 微信报错界面
 */
function show_error($errmsg) {
    $page=<<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>抱歉，出错了</title>
    <link href="//res.wx.qq.com/open/libs/weui/0.4.3/weui.css" rel="stylesheet">
    <style>.page{position:absolute;top:0;right:0;bottom:0;left:0;overflow-y:auto;-webkit-overflow-scrolling:touch;box-sizing:border-box}</style>
</head>
<body>
    <div class="weui_msg">
        <div class="weui_icon_area"><i class="weui_icon_info weui_icon_msg"></i></div>
        <div class="weui_text_area">
            <h4 class="weui_msg_title">{$errmsg}</h4>
        </div>
    </div>
    <script>document.body.addEventListener("touchmove", function (event) {event.preventDefault();},{ passive: false });</script>
</body>
</html>
HTML;
    echo $page;
    exit;
}

/**
 * 更新最新点入友链
 */
function updateRefererIn()
{
    if (isset($_SERVER['HTTP_REFERER'])) {
        preg_match("/^(http:\/\/|https:\/\/)?([^\/]+)/i", $_SERVER['HTTP_REFERER'], $matches);
        if ($matches[2] != '' && $matches[2] != $_SERVER['HTTP_HOST']) {
            $sql = "UPDATE pre_site SET drtime = '" . date('Y-m-d H:i:s') . "' WHERE url LIKE '%//" . $matches[2] . "%'";
            global $DB;
            $DB->exec($sql);
        }
    }
}

function checkRefererHost()
{
    if (!$_SERVER['HTTP_REFERER']) return false;
    $url_arr = parse_url($_SERVER['HTTP_REFERER']);
    $http_host = $_SERVER['HTTP_HOST'];
    if (strpos($http_host, ':')) $http_host = substr($http_host, 0, strpos($http_host, ':'));
    return $url_arr['host'] === $http_host;
}

function checkIfActiveNew($string)
{
    $array = explode(',', $string);
    $php_self = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, strrpos($_SERVER['REQUEST_URI'], '.') - strrpos($_SERVER['REQUEST_URI'], '/') - 1);
    if (in_array($php_self, $array)) {
        return 'active';
    } elseif (isset($_GET['m']) && in_array($_GET['m'], $array)) {
        return 'active';
    }
    return null;
}

function checkIfActive($string) {
    $array=explode(',',$string);
    $php_self=substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],'/')+1);
    $php_self=str_replace('.html','',$php_self);
    if (in_array($php_self,$array)){
        return 'current';
    }
    return null;
}

function getAllSetting()
{
    global $DB;
    $conf = array();
    $result = $DB->getAll("SELECT * FROM pre_config");
    foreach ($result as $row) {
        if ($row['k'] == 'cache') continue;
        $conf[$row['k']] = $row['v'];
    }
    return $conf;
}

function getSetting($k)
{
    global $DB;
    return $DB->getColumn("SELECT v FROM pre_config WHERE k=:k LIMIT 1", [':k' => $k]);
}

function saveSetting($k, $v)
{
    global $DB;
    return $DB->exec("REPLACE INTO pre_config SET v=:v,k=:k", [':v' => $v, ':k' => $k]);
}

function size_format($size)
{
    if ($size < 1024) {
        $size .= ' B';
    } else {
        $size /= 1024;
        if ($size < 1024) {
            $size = round($size, 2) . ' KB';
        } else {
            $size /= 1024;
            if ($size < 1024) {
                $size = round($size, 2) . ' MB';
            } else {
                $size /= 1024;
                if ($size < 1024) {
                    $size = round($size, 2) . ' GB';
                }
            }
        }
    }
    return $size;
}

function get_host($url)
{
    $arr = parse_url($url);
    return $arr['host'];
}

function get_main_host($url)
{
    $arr = parse_url($url);
    $host = $arr['host'];
    if (substr_count($host, '.') > 1) {
        $host = substr($host, strpos($host, '.') + 1);
    }
    return $host;
}

function _get($field = '', $default = '')
{
    if (!$field) {
        // return $_GET;
        $kv = array();
        foreach ($_POST as $k => $v) {
            $kv[$k] = trim(htmlspecialchars($v));
        }
        return $kv;
    }
    if (!isset($_GET[$field])) {
        return $default ? $default : false;
    }
    if (is_string($_GET[$field])) {
        return trim(htmlspecialchars($_GET[$field]));
    }
    return $_GET[$field];
}

function _post($field = '', $default = '')
{
    if (!$field) {
        // return $_POST;
        $kv = array();
        foreach ($_POST as $k => $v) {
            $kv[$k] = trim(htmlspecialchars($v));
        }
        return $kv;
    }

    if (!isset($_POST[$field])) {
        return $default ? $default : false;
    }
    if (is_string($_POST[$field])) {
        return trim(htmlspecialchars($_POST[$field]));
    }
    return $_POST[$field];
}

function refresh_wx_access_token($id, $force = false)
{
    global $DB;
    // $DB::startTrans();
    $access_token = null;
    try {
        $row = $DB->find('token', '*', ['id' => $id]);
        // $row = $DB::name('token')->where('id', $id)->lock(true)->find();
        if (!$row) throw new Exception('记录不存在');
        if ($row['access_token'] && strtotime($row['expiretime']) - 200 >= time() && !$force) {
            // Db::rollback();
            return [$row['access_token'], strtotime($row['expiretime']) - time()];
        }
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $row['appid'] . "&secret=" . $row['appsecret'];
        $output = get_curl($url);
        $res = json_decode($output, true);
        if (isset($res['access_token'])) {
            $access_token = $res['access_token'];
            $expire_time = time() + $res['expires_in'];
            if (!$DB->update(
                'token',
                [
                    'access_token' => $res['access_token'],
                    'updatetime' => date("Y-m-d H:i:s"),
                    'expiretime' => date("Y-m-d H:i:s", $expire_time)
                ],
                ['id' => $id]
            )) throw new Exception('AccessToken 更新失败：<br />' . $DB->error());
        } elseif (isset($res['errmsg'])) {
            throw new Exception('AccessToken 获取失败：<br />' . $res['errmsg']);
        } else {
            throw new Exception('AccessToken 获取失败');
        }
        // Db::commit();
        return [$access_token, $res['expires_in']];
    } catch (\Exception $e) {
        // Db::rollback();
        throw new Exception($e->getMessage());
    }
}

function pagination($url, $page = 1, $total, $page_size = 10) {
    if (!$url) return '';
    if (!$page) return '';
    if (!$total) return '';
    $s = ceil($total / $page_size);
    $first = 1;
    $prev = $page - 1;
    $next = $page + 1;
    $last = $s;
    $html_string = '';
    $html_string .= '<li><span>共计' . $total . '条</span></li>';
    // 起始
    if ($page > 1) {
        $html_string .= '<li><a href="' . $url . '?page=' . $first . '">首页</a></li>';
        $html_string .= '<li><a href="' . $url . '?page=' . $prev . '">&laquo;</a></li>';
    } else {
        $html_string .= '<li class="disabled"><a>首页</a></li>';
        $html_string .= '<li class="disabled"><a>&laquo;</a></li>';
    }
    // 小于当前页的
    for ($i = 1; $i < $page; $i++) {
        $html_string .= '<li><a href="' . $url . '?page=' . $i . '">' . $i . '</a></li>';
    }
    // 当前页
    $html_string .= '<li class="active"><a>' . $page . '</a></li>';
    // 大于当前页的
    for ($i = $page + 1; $i <= $s; $i++) {
        $html_string .= '<li><a href="' . $url . '?page=' . $i . '">' . $i . '</a></li>';
    }
    // 结尾
    if ($page < $s) {
        $html_string .= '<li><a href="' . $url . '?page=' . $next . '">&raquo;</a></li>';
        $html_string .= '<li><a href="' . $url . '?page=' . $last . '">尾页</a></li>';
    } else {
        $html_string .= '<li class="disabled"><a>&raquo;</a></li>';
        $html_string .= '<li class="disabled"><a>尾页</a></li>';
    }
    return $html_string ? '<ul class="pagination">' . $html_string . '</ul>' : '';
}
