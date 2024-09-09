<?php

require('./includes/common.php');
require('./includes/lang.class.php');

$page_title = $lang->index->apply . '-' . $conf['title'];
$row_cate = $DB->findAll('category', '*', '', 'sid asc');
?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,minimum-scale=1,maximum-scale=1,user-scalable=no">
        <title><?php echo $page_title; ?></title>
        <meta name="keywords" content="<?php echo $conf['keywords'];?>">
        <meta name="description" content="<?php echo $conf['description'];?>">
        <link rel="shortcut icon" type="images/x-icon" href="./favicon.ico"/>
        <link rel="stylesheet" href="<?php echo $site_cdnpublic; ?>font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/ozui.min.css"/>
        <link rel="stylesheet" type="text/css" href="./templates/default/css/style.css"/>
        <?php echo $conf['script_header']; ?>

    </head>
<body>
<?php require('./home/header.php'); ?>
<?php require('./home/banner.php'); ?>

<div class="container">
    <ul class="category">
        <li><a href="./"><span>返回首页</span> <i class="fa fa-reply fa-fw"></i></a></li>
<?php foreach($row_cate as $row) { ?>
<li><a href="category-<?php echo $row['id'];?>.html"><span><?php echo $row['catename'];?></span> <i class="fa <?php echo $row['icon'];?> fa-fw"></i></a></li>
<?php } ?>
    </ul>
    <div class="card board">
        <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
        <span><a href="./">导航首页</a>&nbsp;»&nbsp;</span>
        <span>申请收录</span>
    </div>
    <div class="card">
        <div class="card-head"><i class="fa fa-plus-square fa-fw"></i>申请收录</div>
        <div class="card-body">
            <div class="content">
                <p style="color: #e03e2d;"><strong>收录条件：</strong></p>
                <p>1、正规网站，不违反法律的</p>
                <p>2、已将本站添加友链的</p>
                <p>3、不能是新网站，网站内容也不能不完善</p>
                <p>4、输入的站点域名，必须包含http或者https这种访问协议</p>
                <p>5. 私自下链、位置变更、域名失效、模板相同、站点主题不符、恶意弹窗、站群的、刷量的，取消收录！</p>
                <p>6、TDK获取的网站信息如有必要可以手工修改完善下</p>
                <p>7、当无法获取网站的TDK信息时请直接手工输入信息</p>
                <p>请诚信友链，不定时检查，网站打不开或位置变更的将会删除，届时只需按要求重新提交，等待审核。</p>
            </div>
            <br />
            <form name="apply-form" onsubmit="return apply_form()" method="post">
                <div class="oz-xs-12 oz-sm-6 oz-form-group">
                    <label class="oz-form-label">网站网址</label>
                    <label class="oz-form-field">
                        <input type="text" name="url" id="url" placeholder="请输入站点域名,包含http或者https[必填]">
                    </label>
                </div>
                <div class="oz-xs-12 oz-sm-6 oz-form-group">
                    <div class="oz-btn oz-bg-green"><span onclick="tdkhq()">请输入网址后点此获取该网站TDK信息</span></div></div>
                <div class="oz-xs-12 oz-sm-6 oz-form-group">
                    <label class="oz-form-label">网站名称</label>
                    <label class="oz-form-field">
                        <input type="text" name="name" id="name" placeholder="请输入站点名称[必填]" required>
                    </label>
                </div>
                <div class="oz-xs-12 oz-sm-6 oz-form-group">
                    <label class="oz-form-label">网站分类</label>
                    <label class="oz-form-field">
                        <select name="catename" id="catename" required>
                            <option value="">请选择站点分类[必选]</option>
                            <?php foreach($row_cate as $row) { ?>
                            <option value="<?php echo $row['catename'];?>"><?php echo $row['catename'];?></option>
                            <?php } ?>
                        </select>
                    </label>
                </div>
                <div class="oz-xs-12 oz-sm-6 oz-form-group">
                    <label class="oz-form-label">关键字词</label>
                    <textarea rows="5" class="oz-form-textarea" id="keywords" placeholder="关键字词请用逗号隔开，一般3-8个为佳[必填]" name="keywords" required></textarea>
                </div>
                <div class="oz-xs-12 oz-sm-6 oz-form-group">
                    <label class="oz-form-label">网站简介</label>
                    <textarea rows="5" class="oz-form-textarea" id="introduce" placeholder="请输入网站简介[必填]" name="introduce" required></textarea>
                </div>
                <div class="oz-center" style="margin-bottom: 8px">
                    <button class="oz-btn oz-bg-blue" type="submit" name="submit" style="margin-right: 10px">
                        <i class="fa fa-telegram fa-fw" aria-hidden="true"></i> 立即提交
                    </button>
                    <button class="oz-btn oz-bg-red" type="reset"><i class="fa fa-refresh fa-fw" aria-hidden="true"></i>
                        重置输入
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require('./home/footer.php'); ?>
<script>
    function tdkhq() {
        var ii = layer.load(2);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo $conf['tdk_api'];?>'+$("#url").val(),
            success: function (result) {
                layer.close(ii);
                if (result["code"] == 200) {
                    $("#name").val(result["title"]);
                    $("#keywords").val(result["keywords"]);
                    $("#introduce").val(result["description"])
                }
            },
            error: function () {
                layer.close(ii);
            }
        });
    }

    function apply_form() {
        if (!$('input[name="url"]').val()) {
            layer.alert('请输入网站网址！', { icon: 2 });
            return false;
        }
        if (!$('input[name="name"]').val()) {
            layer.alert('请输入网站名称！', { icon: 2 });
            return false;
        }
        var ii = layer.load(2);
        $.ajax({
            type: 'POST',
            url: 'api/apply.php?act=form',
            data: $('[name="apply-form"]').serialize(),
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.msg(data.msg || '提交成功', {
                        time: 500,
                        end: function () {
                            window.location.assign('apply.html');
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