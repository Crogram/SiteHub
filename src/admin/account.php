<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '账号信息';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');
?>

<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
            <li class="active"><?php echo $lang->admin->user; ?></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><b><?php echo $lang->admin->user; ?></b></div>
                    <div class="panel-body">
                        <form name="account-form" onsubmit="return appSaveAccount()" method="post">
                            <div class="input-group">
                                <span class="input-group-addon">管理员账号</span>
                                <input value="<?php echo $conf['admin_user']; ?>" type="text" class="form-control" placeholder="请输入管理员账号" name="admin_user" required>
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon">管理员密码</span>
                                <input type="password" name="admin_pwd" value="" class="form-control" placeholder="请输入当前的管理员密码"/>
                            </div><br/>
                            <div class="input-group">
                                <span class="input-group-addon">新的密码</span>
                                <input type="password" name="newpwd" value="" class="form-control" placeholder="如果不修改密码，请在密码输入框中留空"/>
                            </div><br/>
                            <div class="input-group">
                                <span class="input-group-addon">重输密码</span>
                                <input type="password" name="newpwd2" value="" class="form-control" placeholder="如果不修改密码，请在密码输入框中留空"/>
                            </div><br/>
                            <input type="submit" class="btn btn-info btn-block" name="submit" value="修改">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require('./footer.php'); ?>
<script>
    function appSaveAccount(id, name) {
        var ii = layer.load(2);
        $.ajax({
            type: 'POST',
            url: 'ajax.php?act=account',
            data: $('[name="account-form"]').serialize(),
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.msg('保存成功！', {
                        icon: 1,
                        time: 500,
                        end: function () {
                            window.location.assign(window.location.href);
                        }
                    });
                } else {
                    layer.alert(data.msg || '保存失败！', {
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