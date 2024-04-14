<?php

require('./includes/common.php');

$id = $_GET['id'];
if (empty($id)) {
    exit('<script type="text/javascript">window.location.href="../404.html";</script>');
};
$article_item = $DB->find('article', '*', array('id' => $id));
if (empty($article_item)) {
    exit('<script type="text/javascript">window.location.href="../404.html";</script>');
};
require('./includes/lang.class.php');
// 更新文章阅读量
$update_data = array('hits_total' => $article_item['hits_total'] + 1);
$DB->update('article', $update_data, array('id' => $id));
// 显示最新阅读量
$article_item['hits_total'] = $update_data['hits_total'];
// 文章分类列表
$article_cate = $DB->find('article_category', '*', array('catename' => $article_item['catename']));
if (empty($article_cate['alias'])) {
    $article_cate_url = "article-list-{$article_cate['id']}.html";
} else {
    $article_cate_url = "article-list-{$article_cate['alias']}.html";
};
$page_title = $article_item['name'] . '-' . $conf['title'];
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
    <div class="card board">
        <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
        <span><a href="./">导航首页</a>&nbsp;»&nbsp;</span>
        <span><a href="./article.html"><?php echo $lang->index->article; ?></a>&nbsp;»&nbsp;</span>
        <span><a href="<?php echo $article_cate_url; ?>"><?php echo $article_item['catename']; ?></a></span>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="content">
                <div class="text-center">
                    <h1><?php echo $article_item['name']; ?></h1>
                    <em><?php echo $article_item['time']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $conf['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;已浏览<?php echo $article_item['hits_total']; ?>次</em>
                </div>
                <br /><br />
                <?php echo $article_item['introduce']; ?>
                <br /><br />
            </div>
        </div>
    </div>
</div>

<?php require('./home/footer.php'); ?>

</body>
</html>