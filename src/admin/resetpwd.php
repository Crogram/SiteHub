<?php
require('../includes/common.php');
require('../includes/lang.class.php');

$act = _get('act');
if ($act == 'sendcode') {
    exit('{"code":0,"msg":"验证码已发送"}');
    // $user     = _post('user');
    // $password = _post('password');
    // @header('Content-Type: application/json; charset=UTF-8');
    // if (empty($user)) {
    //     exit('{"code":-1,"msg":"用户名不能为空！"}');
    // }
    // if (empty($password)) {
    //     exit('{"code":-1,"msg":"密码不能为空！"}');
    // }
    // if (_post('remember')) {
    //     // 有效期30天
    //     $expire = time() + 3600 * 24 * 30;
    // } else {
    //     // 有效期24小时
    //     $expire = time() + 3600 * 24;
    // }
    // if ($user == $conf['admin_user'] && $password == $conf['admin_pwd']) {
    //     $session = md5($user . $password . $password_hash);
    //     $token = authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
    //     setcookie("admin_token", $token, $expire);
    //     exit('{"code":0,"msg":"登录成功！"}');
    // } elseif ($user != $conf['admin_user'] || $password != $conf['admin_pwd']) {
    //     exit('{"code":-1,"msg":"用户名或密码不正确！"}');
    // }
    // exit('{"code":-4,"msg":"No Act"}');
} else if ($act == 'sendpassword') {
    exit('{"code":0,"msg":"密码已修改"}');
}
?>
<html>
<head>
    <title><?php echo $lang->admin->login; ?> - <?php echo $lang->admin->title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <link rel="shortcut icon" href="../favicon.ico" />
    <link rel="stylesheet" href="../assets/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/admin.css" />
    <style>
        /* body {
            background: linear-gradient(160deg, #b100ff 20%, #ddd 80%);
            color: #fff;
        } */
        .login-page {
            /* color: #fff; */
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
        .send-password {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container login-page" id="login">
        <div class="row">
        <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
                <form id="form-login" onsubmit="return false;" method="post">
                    <h3 class="text-center"><?php echo $lang->app->name; ?> <?php echo $lang->admin->title; ?></h3>
                    <hr />
                    <div class="form-group">
                        <label class="form-label required">用户名</label>
                        <input type="text" name="user" class="form-control" placeholder="请输入用户名">
                    </div>
                    <div class="form-group send-password">
                        <label class="form-label required">验证码</label>
                        <input type="text" name="authcode" class="form-control" placeholder="请输入验证码">
                    </div>
                    <div class="form-group send-password">
                        <label class="form-label required">设置新密码</label>
                        <input type="text" name="password" class="form-control" placeholder="请输入新密码">
                    </div>
                    <div>
                        <button class="btn btn-primary btn-block send-code" onclick="appSendCode();">发送验证码</button>
                        <button class="btn btn-primary btn-block send-password" onclick="appSendPassword();">确定修改密码</button>
                    </div>
                </form>
                <div class="nav-links">
                    <a href="login.php">返回登录</a>
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
        function appSendCode() {
            if (!$('input[name="user"]').val()) {
                layer.alert('请输入用户名！', { icon: 2 });
                return false;
            }
            var ii = layer.load(2);
            $.ajax({
                type: 'POST',
                url: 'resetpwd.php?act=sendcode',
                data: $("#form-login").serialize(),
                dataType: 'json',
                success: function(data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        $('.send-code').addClass('btn-success');
                        $('.send-code').text('验证码已发送');
                        $('.send-code').attr('disabled', true);
                        layer.msg(data.msg || '验证码已发送', {
                            time: 500,
                            end: function () {
                                $('.send-code').hide();
                                $('.send-code').text('发送验证码');
                                $('.send-code').removeClass('btn-success');
                                $('.send-password').show();
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
        function appSendPassword() {
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
                url: 'resetpwd.php?act=sendpassword',
                data: $("#form-login").serialize(),
                dataType: 'json',
                success: function(data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        $('button.send-password').addClass('btn-success');
                        $('button.send-password').text('密码已修改');
                        $('button.send-password').attr('disabled', true);
                        layer.msg(data.msg || '修改成功', {
                            time: 1000,
                            end: function () {
                                window.location.assign('login.php');
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