<?php
require_once('./includes/common.php');
require_once('./includes/lang.class.php');
$page_title = $lang->index->about . '-' . $conf['title'];
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title><?php echo $page_title; ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords']; ?>">
    <meta name="description" content="<?php echo $conf['description']; ?>">
    <link rel="shortcut icon" type="images/x-icon" href="./favicon.ico" />
    <link rel="stylesheet" href="<?php echo $site_cdnpublic; ?>font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/ozui.min.css" />
    <link rel="stylesheet" type="text/css" href="./templates/default/css/style.css" />
    <?php echo $conf['script_header']; ?>

</head>

<body>
<?php require('./home/header.php'); ?>
<?php require('./home/banner.php'); ?>
<?php require('./home/sidebar.php'); ?>

<div class="container">
    <div class="card board">
        <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
        <span><a href="<?php echo $site_http; ?>">导航首页</a>&nbsp;»&nbsp;</span>
        <span><a href="about.html">关于本站</a></span>
    </div>
    <div class="card">
        <div class="card-head"><i class="fa fa-info-circle fa-fw"></i>本站简介</div>
        <div class="card-body">
            <div class="content">
                <p>本站名称：<?php echo $conf['name']; ?></p>
                <p>本站标题：<?php echo $conf['title']; ?></p>
                <p>站关键词：<?php echo $conf['keywords']; ?></p>
                <p>本站描述：<?php echo $conf['description'] ?></p>
                <p>本站域名：<?php echo $site_http; ?></p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-head"><i class="fa fa-pie-chart fa-fw"></i>网站统计</div>
        <div class="card-body">
            <div class="content">
                <?php require('./home/statistics.php'); ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-head"><i class="fa fa-telegram fa-fw"></i>联系方式</div>
        <div class="card-body">
            <div class="content">
                <p>ＱＱ：<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['qq']; ?>&site=qq&menu=yes" target="_blank"><?php echo $conf['qq']; ?></a></p>
                <p>邮箱：<a href="mailto:<?php echo $conf['email']; ?>"><?php echo $conf['email'] ?></a></p>
            </div>
        </div>
    </div>
</div>
<?php require('./home/footer.php'); ?>

</body>
</html>