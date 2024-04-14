<?php
require_once('./includes/common.php');
// 置顶站点
$site_list_top = $DB->findAll('site', 'id,name,img,alias', array('tui' => '1'), 'lid asc', 12);
// 通知
$notice = $DB->find('notice', 'content', '', 'id desc');
// 侧边类型导航
$cate_list = $DB->findAll('category', '*', '', 'sid asc');
// 更新最新点入友链
updateRefererIn();
// 最新点入：友链后在贵站点击即排本站首位
$site_list_drtime = $DB->findAll('site', 'id,name,img', '', 'drtime desc', 14);
// 总浏览top10
$site_list_rank = $DB->findAll('site', 'id,alias,name,img,hits_total', null, 'hits_total desc', 10);
// 最新收录
$site_list_time = $DB->findAll('site', 'id,alias,name,img,time', null, 'time desc', 10);
// 文章分类
$article_cate_list = $DB->findAll('article_category', 'id,catename,icon', null, 'sid asc');
// 最新文章
$article_list_time = $DB->findAll('article', 'id,name', null, 'time desc', 10);
// 友情链接
$link_list = $DB->findAll('link', 'url,name', null, 'id asc', 20);
// 文章推荐
$article_list_suggest = $DB->findAll('article', 'id,name,hits_total,time,introduce', 'tui=1', 'time desc', 8);
$page_title = $conf['title'];
require_once('./includes/lang.class.php');
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
        <link href="./assets/fontawesome/4.7.0/css/fontawesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="./assets/css/ozui.min.css"/>
        <link rel="stylesheet" type="text/css" href="./templates/default/css/style.css"/>
        <?php echo $conf['script_header']; ?>

    </head>
<body>
<?php require('./home/header.php'); ?>
<?php require('./home/banner.php'); ?>

<ul class="category">
    <li><a href="#置顶站点" class="move"><span>置顶推荐</span> <i class="fa fa-thumbs-o-up fa-fw"></i></a></li>
<?php foreach($cate_list as $rows) { ?>
    <li><a href="#<?php echo $rows['catename']; ?>" class="move"><span><?php echo $rows['catename']; ?></span> <i class="fa <?php echo $rows['icon']; ?> fa-fw"></i></a></li>
<?php } ?>
</ul>

<div class="container">
    <div class="main">
        <div class="card board">
            <span class="icon"><i class="fa fa-bullhorn fa-fw"></i></span>
            <marquee scrollamount="4" behavior="scroll" onmouseover="this.stop()" onmouseout="this.start()">
                <span class="board-notice"><?php echo $notice['content']; ?></span>
            </marquee>
        </div>

        <div class="card">
            <div class="wzgg">
                <a href="#" target="_blank" rel="nofollow">文字广告火爆招租</a>
                <a href="#" target="_blank" rel="nofollow">文字广告火爆招租</a>
                <a href="#" target="_blank" rel="nofollow">文字广告火爆招租</a>
                <a href="#" target="_blank" rel="nofollow">文字广告火爆招租</a>
            </div>
        </div>

        <div id="置顶站点" class="card">
            <div class="top-grid">
            <?php foreach($site_list_top as $rows) { ?>
                <a href="<?php echo empty($rows['alias']) ? "site-{$rows['id']}.html" : "{$rows['alias']}.html"; ?>" class="item" title="<?php echo $rows['name']; ?>" data-id="<?php echo $rows['id']; ?>">
                    <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $rows['img']; ?>"></span>
                    <span class="name"><?php echo $rows['name']; ?></span>
                </a><?php } ?>
            </div>
        </div>

        <!-- <div class="card">
            <a class="ad" target="blank" href="apply.html">
                <img src="assets/images/2.gif">
            </a>
        </div> -->

        <div class="card">
            <div class="card-head">
                <i class="fa fa-link fa-fw"></i>最新点入：友链后在贵站点击即排本站首位!<a href="apply.html" class="more"><i class="fa fa-plus-square" aria-hidden="true"></i>申请收录</a>
            </div>
            <div class="card-body">
                <?php foreach($site_list_drtime as $rows) { ?>
                <a href="<?php echo "site-{$rows['id']}.html"; ?>" target="_blank" class="item" title="<?php echo $rows['name']; ?>" data-id="<?php echo $rows['id']; ?>">
                    <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $rows['img']; ?>"></span>
                    <span class="name"><?php echo $rows['name']; ?></span>
                </a>
                <?php } ?>

            </div>
        </div>

        <?php foreach ($cate_list as $row) { ?>
        <div id="<?php echo $row['catename']; ?>" class="card">
            <div class="card-head">
                <i class="fa <?php echo $row['icon']; ?> fa-fw"></i><?php echo $row['catename']; ?>
                <a href="<?php echo empty($row['alias']) ? "category-{$row['id']}.html" : "category-{$row['alias']}.html"; ?>" class="more"><i class="fa fa-ellipsis-h fa-fw"></i></a>
            </div>
            <div class="card-body">
                <?php $site_list = $DB->findAll('site', 'id,name,alias,img', array('catename' => $row['catename']), 'lid asc', 14);
                foreach ($site_list as $rows) { ?>
                <a href="<?php echo empty($rows['alias']) ? "site-{$rows['id']}.html" : "{$rows['alias']}.html"; ?>" target="_blank" class="item" title="<?php echo $rows['name']; ?>" data-id="<?php echo $rows['id']; ?>">
                    <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $rows['img']; ?>"></span>
                    <span class="name"><?php echo $rows['name']; ?></span>
                </a><?php } ?>

            </div>
        </div>
        <?php } ?>

        <div class="card">
            <div class="card-head">
                <i class="fa fa-book fa-fw"></i>文章推荐
                <a href="article.html" class="more"><i class="fa fa-ellipsis-h fa-fw"></i></a>
            </div>
            <div class="card-body"><?php foreach($article_list_suggest as $rs) {
                preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $rs['introduce'], $img);
                $imgsrc = !empty($img[1]) ? $img[1][0] : '';
                if (!$imgsrc) $imgsrc = './assets/images/no.png';
            ?>
                <a href="article-<?php echo $rs['id']; ?>.html" target="_blank" class="post">
                    <div class="pic">
                        <img class="lazy-load" src="./assets/images/loading.gif" data-src="<?php echo $imgsrc; ?>">
                    </div>
                    <div class="text">
                        <div class="title"><?php echo $rs['name']; ?></div>
                        <div class="info">
                            <span><i class="fa fa-eye fa-fw"></i><?php echo $rs['hits_total']; ?></span>
                            <span><i class="fa fa-clock-o fa-fw"></i><?php echo $rs['time']; ?></span>
                        </div>
                    </div>
                </a>
            <?php } ?>
            </div>
        </div>
    </div>

    <div class="side">
        <div class="card">
            <div class="card-head"><i class="fa fa-line-chart fa-fw"></i>总浏览TOP10</div>
            <div class="card-body">
                <div class="view-list">
                <?php foreach ($site_list_rank as $index => $row ) { ?>
                    <a href="<?php echo empty($row['alias']) ? "site-{$row['id']}.html" : "{$row['alias']}.html";?>" data-id="<?php echo $row['id']; ?>">
                        <span class="rank"><?php echo $index + 1; ?></span>
                        <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $row['img']; ?>"></span>
                        <span class="name"><?php echo $row['name']; ?></span>
                        <span class="view"><?php echo $row['hits_total']; ?></span>
                    </a><?php } ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-head"><i class="fa fa-coffee fa-fw"></i>最新收录</div>
            <div class="card-body">
                <div class="side-latest oz-timeline">
                    <?php foreach ($site_list_time as $index => $row ) { ?>
                    <a href="<?php echo empty($row['alias']) ? "site-{$row['id']}.html" : "{$row['alias']}.html"; ?>"
                        data-id="<?php echo $row['id']; ?>"
                    class="oz-timeline-item">
                        <div class="oz-timeline-time"><?php echo $row['time']; ?></div>
                        <div class="oz-timeline-main">
                            <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $row['img']; ?>"></span>
                            <span class="name"><?php echo $row['name']; ?></span>
                        </div>
                    </a><?php } ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-head"><i class="fa fa-folder-open fa-fw"></i>文章分类</div>
            <div class="card-body">
                <div class="side-category">
                <?php foreach ($article_cate_list as $row ) { ?>
                    <a href="<?php echo "article-list-{$row['id']}.html"; ?>" class="">
                        <i class="fa fa-pencil-square-o <?php echo $row['icon']; ?>"></i> <?php echo $row['catename']; ?></a>
                <?php } ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-head"><i class="fa fa-bar-chart fa-fw"></i>最新文章</div>
            <div class="card-body">
                <div class="view-list">
                <?php foreach ($article_list_time as $index => $row ) { ?>
                    <a href="<?php echo "article-{$row['id']}.html"; ?>" target="_blank" title="<?php echo $row['name']; ?>" data-id="<?php echo $row['id']; ?>">
                        <span class="rank"><?php echo $index + 1; ?></span>
                        <span class="name"><?php echo $row['name']; ?></span>
                    </a>
                <?php } ?>
                </div>
            </div>
        </div>

        <!-- <div class="card">
            <a class="ad" target="blank" href="apply.html">
                <img src="assets/images/3.gif">
            </a>
        </div> -->

        <div class="card">
            <div class="card-head"><i class="fa fa-pie-chart fa-fw"></i>本站统计</div>
            <div class="card-body">
                <div class="side-common"><?php require('./home/statistics.php'); ?></div>
            </div>
        </div>
    </div>

    <div class="card links">
        <div class="card-head"><i class="fa fa-link fa-fw"></i>友情链接</div>
        <div class="card-body">
        <?php foreach ($link_list as $rows ) { ?><a href="<?php echo $rows['url']; ?>" target="_blank"><?php echo $rows['name']; ?></a><?php } ?>
        </div>
    </div>

</div>

<?php require('./home/footer.php'); ?>

</body>
</html>