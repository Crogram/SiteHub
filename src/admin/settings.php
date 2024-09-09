<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title='网站信息';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');
?>
<div class="content-wrapper">
    <section class="content-header"><ol class="breadcrumb">
            <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
            <li class="active"><?php echo $lang->admin->settings; ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="alert alert-info" role="alert">
            <center>温馨提示：建站时间必须按格式填写，缩略图接口用于前台站点详情页获取站点的缩略图</center>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><b><?php echo $lang->admin->settings; ?></b></div>
            <div class="panel-body">
                <form name="settings-form" onsubmit="return appSaveSettings()" method="post">
                    <div class="input-group">
                        <span class="input-group-addon">网站名称</span>
                        <input value="<?php echo $conf['name'];?>" type="text" class="form-control" placeholder="请输入网站名称" name="name">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">SEO标题</span>
                        <input value="<?php echo $conf['title'];?>" type="text" class="form-control" placeholder="请输入网站标题" name="title">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">SEO关键字</span>
                        <textarea rows="2" class="form-control" placeholder="请输入网站关键词" name="keywords"><?php echo $conf['keywords'];?></textarea>
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">网站描述</span>
                        <textarea rows="2" class="form-control" placeholder="请输入网站描述" name="description"><?php echo $conf['description'];?></textarea>
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">备案号码</span>
                        <input value="<?php echo $conf['icp'];?>" type="text" class="form-control" placeholder="请输入ICP备案号" name="icp">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">联系Q Q</span>
                        <input value="<?php echo $conf['qq']; ?>" type="number" class="form-control" placeholder="请输入QQ" name="qq">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">联系邮箱</span>
                        <input value="<?php echo $conf['email']; ?>" type="email" class="form-control" placeholder="请输入邮箱" name="email">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">建站时间</span>
                        <input value="<?php echo $conf['build_time'];?>" type="date" class="form-control" name="build_time">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">缩图接口</span>
                        <input value="<?php echo $conf['shots_api'];?>" type="text" class="form-control" placeholder="请输入缩略图接口" name="shots_api">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">TDK接口</span>
                        <input value="<?php echo $conf['tdk_api'];?>" type="text" class="form-control" placeholder="请输入TDK接口" name="tdk_api">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">ICO接口</span>
                        <input value="<?php echo $conf['ico_api'];?>" type="text" class="form-control" placeholder="请输入ICO接口" name="ico_api">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">底部信息</span>
                        <textarea rows="3" class="form-control" placeholder="请输入底部信息[支持HTMl代码]" name="info" style="min-width:100%;max-width:100%;"><?php echo $conf['info'];?></textarea>
                    </div><br />
                    <div class="input-group">
                        <span class="input-group-addon">头部脚本代码</span>
                        <textarea rows="3" class="form-control" placeholder="请输入底部脚本代码" name="script_header" style="min-width:100%;max-width:100%;"><?php echo $conf['script_header'];?></textarea>
                    </div><br />
                    <div class="input-group">
                        <span class="input-group-addon">底部脚本代码</span>
                        <textarea rows="3" class="form-control" placeholder="请输入底部脚本代码" name="script_footer" style="min-width:100%;max-width:100%;"><?php echo $conf['script_footer'];?></textarea>
                    </div>
                    <br />
                    <input type="submit" class="btn btn-info btn-block" value="修改">
                </form>
            </div>
        </div>
    </section>
</div>

<?php require('./footer.php'); ?>
<script>
    function appSaveSettings(id, name) {
        var ii = layer.load(2);
        $.ajax({
            type: 'POST',
            url: 'ajax.php?act=settings',
            data: $('[name="settings-form"]').serialize(),
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