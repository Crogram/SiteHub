<?php
error_reporting(0);
@header('Content-Type: text/html; charset=UTF-8');

define('ROOT', dirname(dirname(__FILE__)));

$step = isset($_GET['step']) ? $_GET['step'] : '0';

if (file_exists(ROOT . '/install/install.lock')) {
    $installed = true;
    $step = '0';
}

date_default_timezone_set("PRC");
$date = date("Y-m-d H:i:s");

if ($step == 5 && !$installed) {
    // 安装成功
    @file_put_contents(ROOT . '/install/install.lock', $date);
}

function random($length, $numeric = 0) {
    $seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
    $seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
    $hash = '';
    $max = strlen($seed) - 1;
    for($i = 0; $i < $length; $i++) {
        $hash .= $seed[mt_rand(0, $max)];
    }
    return $hash;
}

function checkfunc($f, $m = false)
{
    if (function_exists($f)) {
        return '<font color="green">可用</font>';
    } else {
        if ($m == false) {
            return '<font color="black">不支持</font>';
        } else {
            return '<font color="red">不支持</font>';
        }
    }
}

function checkclass($f, $m = false)
{
    if (class_exists($f)) {
        return '<font color="green">可用</font>';
    } else {
        if ($m == false) {
            return '<font color="black">不支持</font>';
        } else {
            return '<font color="red">不支持</font>';
        }
    }
}
$str_installed = '<div class="list-group">
    <div class="list-group-item list-group-item-info">系统检测到您已安装过了！</div>
    <div class="list-group-item">
        <a href="?step=5" class="btn btn-block btn-info">跳过安装</a>
    </div>
    <div class="list-group-item">
        <a href="?step=4" onclick="if(!confirm(\'全新安装将会清空所有数据，是否继续？\')){return false;}" class="btn btn-block btn-warning">强制全新安装</a>
    </div>
</div>';
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">
    <title>程江网址导航系统 - 安装向导</title>
    <link rel="stylesheet" href="../assets/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-fixed-top navbar-default">
        <div class="container">
            <div class="navbar-header">
                <span class="navbar-brand">程江网址导航系统 - 安装向导</span>
            </div>
        </div>
    </nav>
    <div class="container" style="padding-top:75px;">
        <div class="col-xs-12 col-sm-8 col-lg-6 center-block" style="float: none;">
            <?php if ($step == '0') { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">安装说明</h3>
                    </div>
                    <div class="panel-body">
                        <iframe src="./readme.txt" style="width:100%;height:450px;background-color:#f0f8ff;"></iframe>
                        <?php if ($installed) { ?>
                            <div class="alert alert-danger">您已经安装过，如需重新安装请删除<span style="color: #ff0000;"> install/install.lock </span>文件后再安装！</div>
                        <?php } else { ?>
                            <a class="btn btn-primary btn-block" href="?step=1">开始安装</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } elseif ($step == '1') { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">环境检查</h3>
                    </div>
                    <div class="panel-body">
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                                <span class="sr-only">10%</span>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width:20%">函数检测</th>
                                    <th style="width:15%">需求</th>
                                    <th style="width:15%">当前</th>
                                    <th style="width:50%">用途</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PHP 5.2+</td>
                                    <td>必须</td>
                                    <td><?php echo phpversion(); ?></td>
                                    <td>PHP版本支持</td>
                                </tr>
                                <tr>
                                    <td>curl_exec()</td>
                                    <td>必须</td>
                                    <td><?php echo checkfunc('curl_exec', true); ?></td>
                                    <td>抓取网页</td>
                                </tr>
                                <tr>
                                    <td>file_get_contents()</td>
                                    <td>必须</td>
                                    <td><?php echo checkfunc('file_get_contents', true); ?></td>
                                    <td>读取文件</td>
                                </tr>
                            </tbody>
                        </table>
                        <p>
                            <span><a class="btn btn-warning" href="?step=0">上一步</a></span>
                            <span class="pull-right"><a class="btn btn-success" href="?step=2">下一步</a></span>
                        </p>
                    </div>
                </div>
            <?php } elseif ($step == '2') { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">数据库配置</h3>
                    </div>
                    <div class="panel-body">
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                <span class="sr-only">30%</span>
                            </div>
                        </div>
                        <?php if (defined("SAE_ACCESSKEY")) { ?>
                            <p>检测到您使用的是SAE空间，支持一键安装，请点击 <a href="?step=3">下一步</a></p>
                        <?php } else { ?>
                            <form action="?step=3" class="form-sign" method="post">
                                <label for="db_host">数据库地址</label>
                                <input type="text" class="form-control" id="db_host" name="db_host" value="127.0.0.1">
                                <label for="db_port">数据库端口</label>
                                <input type="text" class="form-control" id="db_port" name="db_port" value="3306">
                                <label for="db_user">数据库用户名</label>
                                <input type="text" class="form-control" id="db_user" name="db_user" value="root">
                                <label for="db_pwd">数据库密码</label>
                                <input type="text" class="form-control" id="db_pwd" name="db_pwd" value="root">
                                <label for="db_name">数据库名</label>
                                <input type="text" class="form-control" id="db_name" name="db_name" value="site">
                                <label for="prefix">表前缀</label>
                                <input type="text" class="form-control" id="prefix" name="prefix" value="pre">
                                <br />
                                <p>（如果已事先填写好 config.php 相关数据库配置，可 <a href="?step=3&jump=1">点击此处</a> 跳到下一步！）</p>
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="保存配置">
                            </form>
                        <?php } ?>
                    </div>
                </div>
            <?php } elseif ($step == '3') { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">保存数据库</h3>
                    </div>
                    <div class="panel-body">
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                <span class="sr-only">50%</span>
                            </div>
                        </div>
                        <?php
                        require ROOT . '/install/db.class.php';
                        if (defined("SAE_ACCESSKEY") || $_GET['jump'] == 1) {
                            if (defined("SAE_ACCESSKEY")) {
                                include_once ROOT . '/includes/sae.php';
                            } else {
                                include_once ROOT . '/config.php';
                            }
                            if (!$dbconfig['user'] || !$dbconfig['pwd'] || !$dbconfig['dbname']) {
                                echo '<div class="alert alert-danger">请先填写好数据库并保存后再安装！<hr /><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
                            } else {
                                if (!$con = DB::connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname'], $dbconfig['port'])) {
                                    if (DB::connect_errno() == 2002)
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库地址填写错误！<hr /><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
                                    elseif (DB::connect_errno() == 1045)
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库用户名或密码填写错误！<hr /><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
                                    elseif (DB::connect_errno() == 1049)
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库名不存在！<hr /><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
                                    else
                                        echo '<div class="alert alert-warning">连接数据库失败，[' . DB::connect_errno() . ']' . DB::connect_error() . '</div>';
                                } else {
                                    echo '<div class="alert alert-success">数据库配置文件保存成功！</div>';
                                    if (DB::query("select * from {$prefix}_config where 1") == FALSE) {
                                        echo '<a class="btn btn-primary btn-block" href="?step=4">创建数据表>></a>';
                                    } else {
                                        echo $str_installed;
                                    }
                                }
                            }
                        } else {
                            $db_host = isset($_POST['db_host']) ? $_POST['db_host'] : NULL;
                            $db_port = isset($_POST['db_port']) ? $_POST['db_port'] : NULL;
                            $db_user = isset($_POST['db_user']) ? $_POST['db_user'] : NULL;
                            $db_pwd  = isset($_POST['db_pwd'])  ? $_POST['db_pwd']  : NULL;
                            $db_name = isset($_POST['db_name']) ? $_POST['db_name'] : NULL;
                            $prefix  = isset($_POST['prefix'])  ? $_POST['prefix']  : NULL;

                            if ($db_host == null || $db_port == null || $db_user == null || $db_pwd == null || $db_name == null) {
                                echo '<div class="alert alert-danger">保存错误，请确保每项都不为空<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
                            } else {
                                $config = "<?php
/* 数据库配置 */
\$dbconfig = array(
    'host'   => '{$db_host}', // 数据库服务器
    'port'   => {$db_port}, // 数据库端口
    'user'   => '{$db_user}', // 数据库用户名
    'pwd'    => '{$db_pwd}', // 数据库密码
    'dbname' => '{$db_name}', // 数据库名
    'prefix' => '{$prefix}' // 数据库表前缀
);";
                                if (!$con = DB::connect($db_host, $db_user, $db_pwd, $db_name, $db_port)) {
                                    if (DB::connect_errno() == 2002) {
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库地址填写错误！</div>';
                                    } elseif (DB::connect_errno() == 1045) {
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库用户名或密码填写错误！</div>';
                                    } elseif (DB::connect_errno() == 1049) {
                                        echo '<div class="alert alert-warning">连接数据库失败，数据库名不存在！</div>';
                                    } else {
                                        echo '<div class="alert alert-warning">连接数据库失败，[' . DB::connect_errno() . ']' . DB::connect_error() . '</div>';
                                    }
                                } elseif (file_put_contents(ROOT . '/config.php', $config)) {
                                    echo '<div class="alert alert-success">数据库配置文件保存成功！</div>';
                                    if (DB::query("select * from {$prefix}_config where 1") == FALSE) {
                                        echo '<a class="btn btn-primary btn-block" href="?step=4">创建数据表>></a>';
                                    } else {
                                        echo $str_installed;
                                    }
                                } else {
                                    echo '<div class="alert alert-danger">保存失败，请确保网站根目录有写入权限<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php } elseif ($step == '4') { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">创建数据表</h3>
                    </div>
                    <div class="panel-body">
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                <span class="sr-only">70%</span>
                            </div>
                        </div>
                        <?php
                        if (defined("SAE_ACCESSKEY")) {
                            include_once ROOT . '/includes/sae.php';
                        } else {
                            include_once ROOT . '/config.php';
                        }
                        if (!$dbconfig['user'] || !$dbconfig['pwd'] || !$dbconfig['dbname']) {
                            echo '<div class="alert alert-danger">请先填写好数据库并保存后再安装！<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
                        } else {
                            require ROOT . '/install/db.class.php';
                            $sqls = file_get_contents("install.sql");
                            $sqls = explode(';</explode>', $sqls);
                            $cn = DB::connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname'], $dbconfig['port']);
                            if (!$cn) die('err:' . DB::connect_error());
                            DB::query("set sql_mode = ''");
                            DB::query("set names utf8");
                            $sqls[] = "INSERT INTO `" . $dbconfig['prefix'] . "_config` VALUES ('sys_key', '" . random(32) . "')";
                            $sqls[] = "INSERT INTO `" . $dbconfig['prefix'] . "_config` VALUES ('build_time', '" . $date("Y-m-d") . "')";
                            $t = 0;
                            $e = 0;
                            $error = '';
                            for ($i = 0; $i < count($sqls); $i++) {
                                $sql = trim($sqls[$i]);
                                if ($sql == '') continue;
                                // 设置表前缀
                                $sql = str_replace('`pre_', '`' . $dbconfig['prefix'] . '_', $sql);
                                if (DB::query($sql)) {
                                    ++$t;
                                } else {
                                    ++$e;
                                    $error .= DB::error() . '<br/>';
                                }
                            }
                        }
                        if ($e == 0) {
                            echo '<div class="alert alert-success">安装成功！<br/>SQL成功' . $t . '句/失败' . $e . '句</div><p><a class="btn btn-block btn-primary" href="?step=5">下一步>></a></p>';
                        } else {
                            echo '<div class="alert alert-danger">安装失败<br/>SQL成功' . $t . '句/失败' . $e . '句<br/>错误信息：' . $error . '</div><p><a class="btn btn-block btn-primary" href="?step=4">点此进行重试</a></p>';
                        }
                        ?>
                    </div>
                </div>

            <?php } elseif ($step == '5') { ?>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">安装完成</h3>
                    </div>
                    <div class="panel-body">
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">100%</span>
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <p style="color: green;">安装完成！默认管理账号和密码是：admin/admin</p>
                            <br /><br />
                            <a href="../" target="_blank">>>网站首页</a>｜<a href="../admin/" target="_blank">>>后台管理</a>
                            <hr />更多设置选项请登录后台管理进行修改。
                            <br /><br />
                            <p style="color: #FF0033;">如果您的空间不支持本地文件读写，请自行在 install/ 文件夹里建立 install.lock 文件！</p>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</body>

</html>