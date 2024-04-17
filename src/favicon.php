<?php

/**
 * 网站图标 favicon.ico
 */

if (!isset($_GET['url'])) {
    return http_response_code(404);
}

define('ROOT', dirname(__FILE__));

require ROOT . '/includes/favicon.class.php';

/* ------ 参数设置 ------ */

define('CACHE_ROOT', ROOT . '/cache/favicon'); // 图标缓存目录
$defaultIco = ROOT . '/cache/favicon.ico'; // 默认图标路径
$expire = 2592000; // 缓存有效期30天, 单位为:秒，为0时不缓存

/* ------ 参数设置 ------ */

$favicon = new Favicon;

/**
 * 设置默认图标
 */
$favicon->setDefaultIcon($defaultIco);

/**
 * 检测URL参数
 */
$url = $_GET['url'];
$url = trim(htmlspecialchars($url));

/*
 * 格式化 URL, 并尝试读取缓存
 */
$formatUrl = $favicon->formatUrl($url);

if ($expire == 0) {
    $favicon->getFavicon($formatUrl, false);
    @header("Cache-Control: public, max-age={$expire}");
    @header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    exit;
} else {
    $defaultMD5 = md5(file_get_contents($defaultIco));

    $data = Cache::get($formatUrl, $defaultMD5, $expire);
    if ($data !== NULL) {
        foreach ($favicon->getHeader() as $header) {
            @header($header);
        }
        @header("Cache-Control: public, max-age={$expire}");
        // 缓存文件的修改时间
        $file = CACHE_ROOT . '/' . parse_url($formatUrl)['host'] . '.txt';
        @header("Last-Modified: " . gmdate("D, d M Y H:i:s", filemtime($file)) . " GMT");
        echo $data;
        exit;
    }

    /**
     * 缓存中没有指定的内容时, 重新获取内容并缓存起来
     */
    $content = $favicon->getFavicon($formatUrl, TRUE);

    if (md5($content) == $defaultMD5) {
        $expire = 43200; // 如果返回默认图标，设置过期时间为12小时。Cache::get 方法中需同时修改
    }

    Cache::set($formatUrl, $content, $expire);

    foreach ($favicon->getHeader() as $header) {
        @header($header);
    }
    @header("Cache-Control: public, max-age={$expire}");
    @header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

    echo $content;
    exit;
}


/**
 * 缓存类
 */
class Cache
{
    /**
     * 获取缓存的值, 不存在时返回 null
     *
     * @param $key
     * @param $default  默认图片
     * @param $expire   过期时间
     * @return string
     */
    public static function get($key, $default, $expire)
    {
        //$f = md5( strtolower( $key ) );
        $f = parse_url($key)['host'];

        $file = CACHE_ROOT . '/' . $f . '.txt';

        if (is_file($file)) {
            $data = file_get_contents($file);
            if (md5($data) == $default) {
                $expire = 43200; //如果返回默认图标，过期时间为12小时。
            }
            if ((time() - filemtime($file)) > $expire) {
                return null;
            } else {
                return $data;
            }
        } else {
            return null;
        }
    }

    /**
     * 设置缓存
     *
     * @param $key
     * @param $value
     * @param $expire   过期时间
     */
    public static function set($key, $value, $expire)
    {
        //$f = md5( strtolower( $key ) );
        $f = parse_url($key)['host'];

        $file = CACHE_ROOT . '/' . $f . '.txt';

        //如果缓存目录不存在则创建
        if (!is_dir(CACHE_ROOT)) mkdir(CACHE_ROOT, 0777, true) or die('创建缓存目录失败！');

        if (!is_file($file) || (time() - filemtime($file)) > $expire) {
            $imgdata = fopen($file, "w") or die("Unable to open file!");  //w  重写  a追加
            fwrite($imgdata, $value);
            fclose($imgdata);
        }
    }
}
