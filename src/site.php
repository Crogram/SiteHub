<?php

require('./includes/common.php');

$seconds = '3';
$refresh = '2';
$cur_time = time();
if (isset($_SESSION['last_time'])) {
    $_SESSION['refresh_times'] += 1;
} else {
    $_SESSION['refresh_times'] = 1;
    $_SESSION['last_time'] = $cur_time;
}
if ($cur_time - $_SESSION['last_time'] < $seconds) {
    if ($_SESSION['refresh_times'] >= $refresh) {
        sysmsg('<div style="color: red; font-size: 50px;">你是打算刷排行榜吗？！</div>');
    }
} else {
    $_SESSION['refresh_times'] = 0;
    $_SESSION['last_time'] = $cur_time;
}

$id = _get('id');
$alias = _get('alias');
if (empty($id) && empty($alias)) {
    exit('<script type="text/javascript">window.location.href="404.html";</script>');
};

if (empty($alias)) {
    $site_item = $DB->find('site', '*', array('id' => $id));
} else {
    $site_item = $DB->find('site', '*', array('alias' => $alias));
}
if (empty($site_item)) {
    exit('<script type="text/javascript">window.location.href="404.html";</script>');
};

require('./includes/lang.class.php');

$date = date("Y-m-d", time());
$datem = date("Y-m", time());
$zero1 = strtotime($date);
$zero2 = strtotime($datem);

$rdate = $site_item['date'];
$datey = $site_item['datem'];
$zero11 = strtotime($rdate);
$zero22 = strtotime($datey);
$update_data = array();
if ($zero1 == $zero11 and $zero2 == $zero22) {
    $update_data = array(
        'hits_total' => $site_item['hits_total'] + 1,
        'hits_month' => $site_item['hits_month'] + 1,
        'hits_day' => $site_item['hits_day'] + 1
    );
} elseif ($zero11 < $zero1 and $zero2 == $zero22) {
    $update_data = array(
        'hits_total' => $site_item['hits_total'] + 1,
        'hits_month' => $site_item['hits_month'] + 1,
        'hits_day' => 1,
        'date' => $date
    );
} elseif ($zero2 > $zero22) {
    $update_data = array(
        'hits_total' => $site_item['hits_total'] + 1,
        'hits_month' => 1,
        'hits_day' => 1,
        'date' => $date,
        'datem' => $datem
    );
} else {
    $update_data = array(
        'hits_total' => $site_item['hits_total'] + 1
    );
}
// 更新统计信息
$DB->update('site', $update_data, array('id' => $site_item['id']));
// 合并统计数据
$site_item = array_merge($site_item, $update_data);

preg_match("/^(http:\/\/|https:\/\/)?([^\/]+)/i", $site_item['url'], $matches);
$domain = $matches[2];
$page_title = $site_item['name'] . '-' . $conf['title'];
$keywords = $site_item['keywords'];
$description = $site_item['introduce'];
if (strlen($description) > 240) {
    $description = mb_substr($description, 0, 80, "utf-8") . "..";
}
$cate_list = $DB->findAll('category', '*', '', 'sid asc');
$cate_item = $DB->find('category', 'id,catename,alias', array('catename' => $site_item['catename']), 'sid asc');
$site_list = $DB->findAll('site', 'id,name,alias,img', array('catename' => $site_item['catename']), 'lid asc', 14);
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title><?php echo $page_title; ?></title>
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="description" content="<?php echo $description; ?>">
    <link rel="shortcut icon" type="images/x-icon" href="./favicon.ico" />
    <link rel="stylesheet" href="<?php echo $site_cdnpublic; ?>font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/ozui.min.css" />
    <link rel="stylesheet" type="text/css" href="./templates/default/css/style.css" />
    <?php echo $conf['script_header']; ?>

</head>

<body>
<?php require('./home/header.php'); ?>
<?php require('./home/banner.php'); ?>

<ul class="category">
    <li><a href="./"><span>返回首页</span> <i class="fa fa-reply fa-fw"></i></a></li>
<?php foreach($cate_list as $row) { ?>
    <li><a href="category-<?php echo $row['id'];?>.html" class="<?php if ($site_item['catename'] == $row['catename']) { echo "active"; }; ?>"><span><?php echo $row['catename'];?></span> <i class="fa <?php echo $row['icon'];?> fa-fw"></i></a></li>
<?php } ?>
</ul>

<div class="container">
    <div class="card board">
        <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
        <span><a href="./">导航首页</a>&nbsp;»&nbsp;</span>
        <span><a title="<?php echo $site_item['catename']; ?>" href="<?php echo empty($cate_item['alias']) ? "category-{$cate_item['id']}.html" : "category-{$cate_item['alias']}.html"; ?>"><?php echo $site_item['catename']; ?></a>&nbsp;»&nbsp;</span>
        <span><?php echo $site_item['name']; ?></span>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="part-main">
                <span class="site-name"><?php echo $site_item['name']; ?></span>
                <span class="oz-xs-12 oz-sm-6 oz-lg-4">站点域名：<?php echo $domain; ?></span>
                <span class="oz-xs-12 oz-sm-6 oz-lg-4">站点星级：<img class="lazy-load" src="templates/default/images/star/<?php echo $site_item['star'] || 1; ?>.png"></span>
                <span class="oz-xs-12 oz-sm-6 oz-lg-4">是否推荐：<?php echo $site_item['tui'] == 1 ? "<span color=red>是</span>" : '否'; ?></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4">日浏览数：<?php echo $site_item['hits_day']; ?> 次</span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4">月浏览数：<?php echo $site_item['hits_month']; ?> 次</span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4">总浏览数：<?php echo $site_item['hits_total']; ?> 次</span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4">所属分类：<a title="<?php echo $site_item['catename']; ?>" href="<?php if (empty($cate_item['alias'])) {
                                                                                                                        echo "category-{$cate_item['id']}.html";
                                                                                                                    } else {
                                                                                                                        echo "category-{$cate_item['alias']}.html";
                                                                                                                    }; ?>"><?php echo $site_item['catename']; ?></a></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4">百度权重：<img class="lazy-load" src="https://baidurank.aizhan.com/api/br?domain=<?php echo $domain; ?>&style=images"></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4">移动权重：<img class="lazy-load" src="https://baidurank.aizhan.com/api/mbr?domain=<?php echo $domain; ?>&style=images"></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4">搜狗权重：<img class="lazy-load" src="https://sogourank.aizhan.com/api/br?domain=<?php echo $domain; ?>&style=images"></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4">移动权重：<img class="lazy-load" src="https://sogourank.aizhan.com/api/mbr?domain=<?php echo $domain; ?>&style=images"></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4">头条权重：<img class="lazy-load" src="https://toutiaorank.aizhan.com/api/br?domain=<?php echo $domain; ?>&style=images"></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4">360权重：<img class="lazy-load" src="https://sorank.aizhan.com/api/br?domain=<?php echo $domain; ?>&style=images"></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4">神马权重：<img class="lazy-load" src="https://smrank.aizhan.com/api/br?domain=<?php echo $domain; ?>&style=images"></span>
                <span class="oz-xs-12 oz-sm-6 oz-lg-4">收录日期：<?php echo $site_item['time']; ?></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4"><a title="Whois查询" href="http://whois.chinaz.com/<?php echo $domain; ?>" target="_blank">Whois查询</a></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4"><a title="备案查询" href="http://icp.chinaz.com/<?php echo $domain; ?>" target="_blank">备案查询</a></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4"><a title="综合查询" href="http://seo.chinaz.com/?host=<?php echo $domain; ?>" target="_blank">综合查询</a></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4"><a title="收录查询" href="http://tool.chinaz.com/baidu/?wd=<?php echo $domain; ?>" target="_blank">收录查询</a></span>
                <span class="oz-xs-6 oz-sm-6 oz-lg-4"><a title="百度权重" href="http://rank.chinaz.com/all/<?php echo $domain; ?>" target="_blank">百度权重</a></span>
            </div>
            <div class="part-side">
                <div class="site-img">
                    <img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $conf['shots_api']; ?><?php echo $site_item['url']; ?>">
                </div>
                <a title="<?php echo $domain; ?>" href="go.php?url=<?php echo $site_item['url']; ?>" target="_blank" data-id="1" class="oz-btn oz-btn-lg oz-btn-block oz-bg-orange">
                    <i class="fa fa-telegram fa-fw" aria-hidden="true"></i> 网站快速直达
                </a>
                <button class="oz-btn oz-btn-lg oz-btn-block oz-bg-blue like-btn" rel="<?php echo $site_item['id']; ?>"><i class="fa fa-heart-o fa-fw" aria-hidden="true"></i> 点赞支持 [<?php echo $site_item['like']; ?>]</button>
                <a href="http://seo.chinaz.com/<?php echo $site_item['url']; ?>" target="_blank" data-id="1" class="oz-btn oz-btn-lg oz-btn-block oz-bg-green">
                    <i class="fa fa-external-link fa-fw" aria-hidden="true"></i> 综合SEO查询
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-head">
            <i class="fa fa-feed fa-fw" aria-hidden="true"></i> 站点信息
        </div>
        <div class="card-body">
            <div class="content">
                <p><b>描述：</b></p>
                <center><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $conf['shots_api']; ?><?php echo $site_item['url']; ?>"></center><br>
                <?php echo $site_item['introduce']; ?><br /><br /><br />
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-head">
            <i class="fa fa-magnet fa-fw" aria-hidden="true"></i> 相关站点
        </div>
        <div class="card-body">
        <?php foreach($site_list as $rows) { ?>
            <a
                class="item"
                href="<?php echo empty($rows['alias']) ? "site-{$rows['id']}.html" : "{$rows['alias']}.html"; ?>"
                title="<?php echo $rows['name']; ?>"
                data-id="<?php echo $rows['id']; ?>"
            >
                <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $rows['img']; ?>"></span>
                <span class="name"><?php echo $rows['name']; ?></span>
            </a>
        <?php } ?>
        </div>
    </div>
</div>

<?php require('./home/footer.php'); ?>

</body>
</html>