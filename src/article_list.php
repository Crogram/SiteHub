<?php

require('./includes/common.php');
require('./includes/lang.class.php');

$id = $_GET['id'];
if (empty($id)) {
    exit('<script type="text/javascript">window.location.href="../404.html";</script>');
};
$article_cate = $DB->find('article_category', 'id,catename', array('id' => $id));
if (empty($article_cate)) {
    exit('<script type="text/javascript">window.location.href="../404.html";</script>');
};
$page_title = $article_cate['catename'] . ' - 文章列表 -' . $conf['title'];
// 该分类下的文章列表
$article_list = $DB->findAll('article', 'id,name,time', array('catename' => $article_cate['catename']), 'id desc', 30);
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
        <span><a href="./">导航首页</a>&nbsp;»&nbsp;</span>
        <span><a href="article.html"><?php echo $lang->index->article; ?></a>&nbsp;»&nbsp;</span>
        <span><a href="article-list-<?php echo $article_cate['id']; ?>.html"><?php echo $article_cate['catename']; ?></a></span>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="content">
                <ul class="oz-timeline">
                <?php foreach ($article_list as $row) { ?>
                    <li class="oz-timeline-item">
                        <div class="oz-timeline-time"><?php echo $row['time']; ?></div>
                        <div class="oz-timeline-main">
                            <a href="<?php echo "article-{$row['id']}.html"; ?>" target="_blank"><?php echo $row['name']; ?></a>
                        </div>
                    </li><?php } ?>

                </ul>
            </div>
        </div>
        <br />
        <br />
    </div>
</div>

<?php require('./home/footer.php'); ?>

</body>
</html>