<?php
// 所有文章按分类展示
require('./includes/common.php');
require('./includes/lang.class.php');

$page_title  = $lang->index->article . '-' . $conf['title'];
$row_article_cate    = $DB->findAll('article_category', 'id,icon,catename', '', 'sid asc');
$row_article_suggest = $DB->findAll('article', '*', 'tui=1', 'time desc', 4);
// $sql = `SELECT s.catename AS category, 
// JSON_ARRAYAGG(
//     JSON_OBJECT('id', a.id, 'name', a.name, 'introduce', a.introduce, 'hits_total', a.hits_total, 'tui', a.tui, 'time', a.time)
// ) AS articles
// FROM pre_article_category s
// LEFT JOIN pre_article a ON s.catename = a.catename
// GROUP BY s.catename`;
// $row_article = $DB->query($sql);
// print($row_article);
// exit;
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title><?php echo $page_title; ?></title>
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
    <div class="card board">
        <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
        <span><a href=".">导航首页</a>&nbsp;»&nbsp;</span>
        <span><?php echo $lang->index->article; ?></span>
    </div>
    <div class="card">
        <div class="card-head"><i class="fa fa-list-alt" aria-hidden="true"></i>推荐文章</div>
        <div class="card-body">
            <div class="content">
                <ul class="oz-timeline">
                    <?php foreach ($row_article_suggest as $row) { ?>
                        <li class="oz-timeline-item">
                            <div class="oz-timeline-time"><?php echo $row['time']; ?></div>
                            <div class="oz-timeline-main"><a href="<?php echo "article-{$row['id']}.html"; ?>" target="_blank"><?php echo $row['name']; ?></a></div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

<?php foreach ($row_article_cate as $row) { ?>
    <div class="card">
        <div class="card-head">
            <i class="fa <?php echo $row['icon']; ?>"></i><?php echo $row['catename']; ?>
            <a href="article-list-<?php echo $row['id']; ?>.html" class="more"><i class="fa fa-ellipsis-h fa-fw"></i></a>
        </div>
        <div class="card-body">
            <?php
            $row_article = $DB->findAll('article', '*', array('catename' => $row['catename']), 'time desc', 4);
            foreach ($row_article as $rows) {
                preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $rows['introduce'], $img);
                $imgsrc = !empty($img[1]) ? $img[1][0] : '';
                if (!$imgsrc) $imgsrc = 'assets/images/no.png'; ?>
                <a href="article-<?php echo $rows['id']; ?>.html" target="_blank" class="post">
                    <div class="pic"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $imgsrc; ?>"></div>
                    <div class="text">
                        <div class="title"><?php echo $rows['name']; ?></div>
                        <div class="info">
                            <span><i class="fa fa-eye fa-fw"></i><?php echo $rows['hits_total']; ?></span>
                            <span><i class="fa fa-clock-o fa-fw"></i><?php echo $rows['time']; ?></span>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
<?php } ?>
</div>

<?php require('./home/footer.php'); ?>

</body>
</html>