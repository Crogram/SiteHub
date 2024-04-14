<?php
require('./includes/common.php');
require('./includes/lang.class.php');

$keyword = _get('keyword');
if (empty($keyword)) {
    exit('<script type="text/javascript">window.location.href="index.html";</script>');
};

$results = $DB->getAll("SELECT * FROM `pre_site` WHERE `name` LIKE '%$keyword%' OR `url` LIKE '%$keyword%' OR `introduce` LIKE '%$keyword%' order by `lid` ASC");
$count = count($results);
$site_list_rank = $DB->findAll('site', '*', null, 'hits_total desc', 10);
$page_title = '站内搜索 -' . $conf['title'];
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
    <link href="./assets/fontawesome/4.7.0/css/fontawesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="./assets/css/ozui.min.css" />
    <link rel="stylesheet" type="text/css" href="./templates/default/css/style.css" />
    <?php echo $conf['script_header']; ?>

</head>

<body>
<?php require('./home/header.php'); ?>
<?php require('./home/banner.php'); ?>
<?php require('./home/sidebar.php'); ?>

<div class="container">
    <div class="main">
        <div class="card board">
            <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
            <span><a href="./">导航首页</a>&nbsp;»&nbsp;</span>
            <span>搜索 <?php echo $keyword; ?> 的结果</span>
        </div>
        <div id="<?php echo $keyword; ?>" class="card">
            <div class="card-head"><i class="fa fa-search fa-fw"></i>搜索 <?php echo $keyword; ?> 的结果</div>
            <div class="card-body">
                <?php if ($count == 0) { ?>
                    <div class="content"><h3>暂无搜索结果，请尝试更换关键词重新搜索！</h3></div>
                <?php } else { foreach ($results as $row) { ?>
                <a title="<?php echo $row['url']; ?>" href="<?php echo empty($row['alias']) ? "site-{$row['id']}.html" : "{$row['alias']}.html"; ?>" target="_blank" class="item" data-id="<?php echo $row['id']; ?>">
                    <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $row['img']; ?>"></span>
                    <span class="name"><?php echo $row['name']; ?></span>
                </a>
                <?php }
                } ?>
            </div>
        </div>
    </div>
    <div class="side">
        <div class="card">
            <div class="card-head"><i class="fa fa-bar-chart fa-fw"></i>分类总TOP10</div>
            <div class="card-body">
                <div class="view-list">
                <?php foreach($site_list_rank as $index => $rs) { ?>
                    <a href="<?php echo empty($rs['alias']) ? "site-{$rs['id']}.html" : "{$rs['alias']}.html"; ?>" data-id="<?php echo $rs['id']; ?>">
                        <span class="rank"><?php echo $index + 1; ?></span>
                        <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $rs['img']; ?>"></span>
                        <span class="name"><?php echo $rs['name']; ?></span>
                        <span class="view"><?php echo $rs['hits_total']; ?></span>
                    </a>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('./home/footer.php'); ?>

</body>
</html>