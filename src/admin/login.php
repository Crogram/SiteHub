<?php
require('../includes/common.php');
require('../includes/lang.class.php');

$act = _get('act');
if ($act == 'login') {
    $user     = _post('user');
    $password = _post('password') ? hash('sha256', _post('password')) : '';
    @header('Content-Type: application/json; charset=UTF-8');
    if (empty($user)) {
        exit('{"code":-1,"msg":"用户名不能为空！"}');
    }
    if (empty($password)) {
        exit('{"code":-1,"msg":"密码不能为空！"}');
    }
    if (_post('remember')) {
        // 有效期30天
        $expire = time() + 3600 * 24 * 30;
    } else {
        // 有效期24小时
        $expire = time() + 3600 * 24;
    }
    if ($user == $conf['admin_user'] && $password == $conf['admin_pwd']) {
        $session = md5($user . $password . $password_hash);
        $token = authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
        setcookie("admin_token", $token, $expire);
        exit('{"code":0,"msg":"登录成功！"}');
    } elseif ($user != $conf['admin_user'] || $password != $conf['admin_pwd']) {
        exit('{"code":-1,"msg":"用户名或密码不正确！"}');
    }
    exit('{"code":-4,"msg":"No Act"}');
}
?>
<html>
<head>
    <title><?php echo $lang->admin->login; ?> - <?php echo $lang->admin->title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" href="../favicon.ico" />
    <link rel="stylesheet" href="<?php echo $site_cdnpublic; ?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/admin.css" />
    <style>
        /* body {
            background: linear-gradient(160deg, #b100ff 20%, #ddd 80%);
            color: #fff;
        } */
        .login-page {
            margin-top: 10%;
        }
        .login-footer {
            margin-top: 20px;
            text-align: center;
        }
        body {
            background-image: url(../assets/images/pexels-aaron-burden-2449543.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>
    <div class="container login-page">
        <div class="row">
            <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
                <form id="form-login" onsubmit="return loginSubmit()" method="post">
                    <h3 class="text-center"><?php echo $lang->app->name; ?> <?php echo $lang->admin->title; ?></h3>
                    <hr />
                    <div class="form-group">
                        <label class="form-label required">用户名</label>
                        <input type="text" name="user" class="form-control" placeholder="请输入用户名">
                    </div>
                    <div class="form-group">
                        <label class="form-label required">密码</label>
                        <input type="password" name="password" class="form-control" placeholder="请输入密码">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember" value="1" id="remember-my-information">
                        <label for="remember-my-information">记住账号30天</label>
                    </div>
                    <button class="btn btn-primary btn-block" name="login">登录</button>
                </form>
                <div class="nav-links">
                    <a href="resetpwd.php">忘记密码</a>
                </div>
            </div>
        </div>
    </div>
    <div class="login-footer">
        <p>Copyright &copy; <?php echo date('Y');?> <?php echo $lang->app->name; ?>. All Rights Reserved.</p>
        <p>Powered by <a href="https://crogram.org" target="_blank">Crogram</a></p>
    </div>

    <script src="<?php echo $site_cdnpublic; ?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $site_cdnpublic; ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo $site_cdnpublic; ?>layer/3.1.1/layer.js"></script>

    <script>
        function loginSubmit() {
            if (!$('input[name="user"]').val()) {
                layer.alert('请输入用户名！', { icon: 2 });
                return false;
            }
            if (!$('input[name="password"]').val()) {
                layer.alert('请输入密码！', { icon: 2 });
                return false;
            }
            var ii = layer.load(2);
            $.ajax({
                type: 'POST',
                url: 'login.php?act=login',
                data: $("#form-login").serialize(),
                dataType: 'json',
                success: function(data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        $('[name="login"]').addClass('btn-success');
                        $('[name="login"]').text('登录成功，跳转中...');
                        $('[name="login"]').attr('disabled', true);
                        layer.msg(data.msg || '登录成功', {
                            time: 500,
                            end: function () {
                                window.location.assign('index.php');
                            }
                        });
                    } else {
                        layer.alert(data.msg, {
                            icon: 2
                        });
                    }
                },
                error: function(data) {
                    layer.close(ii);
                    layer.msg(data.msg || '服务器错误');
                }
            });
            return false;
        }
    </script>
</body>

</html>