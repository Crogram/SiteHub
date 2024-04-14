<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = $lang->admin->settings_material;
require('./header.php');
require('./navbar.php');
require('./sidebar.php');
?>

<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li class="active"><?php echo $lang->admin->settings_material; ?></li>
</ol>

<div class="alert alert-info" role="alert">
    <p>温馨提示：上传成功的图片直接替换现有图片，在这之前请将「/assets/images」目录权限设置为：777</p>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading"><b><?php echo $lang->admin->favicon;?></b></div>
            <div class="panel-body">
                <p><img src="../favicon.ico" style="height: 50px;"></p>
                <div class="input-group">
                    <span class="input-group-addon">修改</span>
                    <input type="file" name="favicon" class="form-control" placeholder="请选择 ico 图标文件">
                    <span class="input-group-btn">
                        <button onclick="uploadImage('favicon', '/favicon.ico');" class="btn btn-info">上传</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading"><b><?php echo $lang->admin->default_ico;?></b></div>
            <div class="panel-body">
                <p><img src="../assets/images/default_ico.png" style="height: 50px;"></p>
                <div class="input-group">
                    <span class="input-group-addon">修改</span>
                    <input type="file" name="default_ico" class="form-control" placeholder="请选择 ico 图标文件">
                    <span class="input-group-btn">
                        <button onclick="uploadImage('default_ico', '/assets/images/default_ico.png');" class="btn btn-info">上传</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading"><b><?php echo $lang->admin->logo;?></b></div>
            <div class="panel-body">
                <p><img src="../assets/images/logo.png" style="height: 50px;"></p>
                <form action="./settings_material.php" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <span class="input-group-addon">修改</span>
                        <input type="file" name="logo" class="form-control" placeholder="请选择图片文件">
                        <span class="input-group-btn">
                            <button onclick="uploadImage('logo', '/assets/images/logo.png');" class="btn btn-info">上传</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading"><b><?php echo $lang->admin->logo_fixed;?></b></div>
            <div class="panel-body">
                <p><img src="../assets/images/logo_fixed.png" style="height: 50px;"></p>
                <div class="input-group">
                    <span class="input-group-addon">修改</span>
                    <input type="file" name="logo_fixed" class="form-control" placeholder="请选择图片文件">
                    <span class="input-group-btn">
                        <button onclick="uploadImage('logo_fixed', '/assets/images/logo_fixed.png');" class="btn btn-info">上传</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading"><b><?php echo $lang->admin->weixin; ?></b></div>
            <div class="panel-body">
                <p><img src="../assets/images/weixin.png" style="height: 100px;"></p>
                <div class="input-group">
                    <span class="input-group-addon">修改</span>
                    <input type="file" name="weixin" class="form-control" placeholder="请选择图片文件">
                    <span class="input-group-btn">
                        <button onclick="uploadImage('weixin', '/assets/images/weixin.png');" class="btn btn-info">上传</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading"><b><?php echo $lang->admin->loading; ?></b></div>
            <div class="panel-body">
                <p><img src="../assets/images/loading.gif" style="height: 100px;"></p>
                <div class="input-group">
                    <span class="input-group-addon">修改</span>
                    <input type="file" name="loading" class="form-control" placeholder="请选择 gif 图片文件">
                    <span class="input-group-btn">
                        <button onclick="uploadImage('loading', '/assets/images/loading.gif');" class="btn btn-info">上传</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading"><b><?php echo $lang->admin->banner;?></b></div>
            <div class="panel-body">
                <p><img src="../assets/images/banner.jpg" class="img-responsive" style="max-height: 300px;"></p>
                <div class="input-group">
                    <span class="input-group-addon">修改</span>
                    <input type="file" name="banner" class="form-control" placeholder="请选择图片文件">
                    <span class="input-group-btn">
                        <button onclick="uploadImage('banner', '/assets/images/banner.jpg');" class="btn btn-info">上传</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require ('./footer.php'); ?>
<script>
function uploadImage (type, filename) {
    var el = $('input[name="' + type + '"]');
    if (!el ||!el.val()) {
        layer.alert('请选择图片', { icon: 2 });
        return;
    }
    var formData = new FormData();
    formData.append('type', filename); // 上传的类型
    formData.append('file', el[0].files[0]); // this.files[0]是文件对象
    var ii = layer.load(2);
    $.ajax({
        url: 'ajax.php?act=settings_material', // 服务器端点
        type: 'POST',
        data: formData,
        processData: false, // 不要对data进行处理，用于对data是DOM元素的情况
        contentType: false, // 设置为false才能让jQuery发送正确的Content-Type
        success: function(res) {
            layer.close(ii);
            if (res.code == 0) {
                layer.msg(res.msg || '上传成功', {
                    time: 500,
                    end: function () {
                        window.location.assign(location.href);
                    }
                });
            } else {
                layer.alert(res.msg, {
                    icon: 2
                });
            }
        },
        error: function(err) {
            layer.close(ii);
            layer.msg(err.msg || '服务器错误');
        }
    });
};
</script>

</body>
</html>