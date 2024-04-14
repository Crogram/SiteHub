<?php

require('./includes/common.php');
require('./includes/lang.class.php');

$page_title = $lang->index->ranking . '-' . $conf['title'];
$rank_day = $DB->findAll('site','id,name,alias,img,hits_day', array('date' => date("Y-m-d",time())), 'hits_day desc', 20);
$rank_month = $DB->findAll('site','id,name,alias,img,hits_month', array('datem' => date("Y-m",time())), 'hits_month desc', 20);
$rank_total = $DB->findAll('site','id,name,alias,img,hits_total', null, 'hits_total desc', 20);
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
<?php require('./home/sidebar.php'); ?>

<div class="container">
 <div class="card board">
    <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
    <span><a href="./">导航首页</a>&nbsp;»&nbsp;</span>
    <span><a href="./ranking.html"><?php echo $lang->index->ranking; ?></a></span>
  </div>
  <div class="ranking">
    <div class="oz-md-4 oz-sm-6 oz-md-12">
      <div class="card">
        <div class="card-head"><i>Day</i>日浏览榜</div>
        <div class="card-body">
<?php foreach($rank_day as $index => $row) { ?>
          <a href="<?php if(empty($row['alias'])){echo "site-{$row['id']}.html";}else{echo "{$row['alias']}.html";};?>" target="_blank" class="site-ranking">
            <span class="rank"><?php echo $index + 1;?></span>
            <span class="icon">
                <img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $row['img'];?>">
            </span>
            <span class="name"><?php echo $row['name'];?></span>
            <span class="view"><?php echo $row['hits_day'];?></span>
          </a>
<?php } ?>
        </div>
      </div>
    </div>

    <div class="oz-md-4 oz-sm-6 oz-md-12">
      <div class="card">
        <div class="card-head"><i>Month</i>月浏览榜</div>
        <div class="card-body">
<?php foreach($rank_month as $index => $row) { ?>
          <a href="<?php if(empty($row['alias'])){echo "site-{$row['id']}.html";}else{echo "{$row['alias']}.html";};?>" target="_blank" class="site-ranking">
            <span class="rank"><?php echo $index + 1;?></span>
            <span class="icon">
                <img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $row['img'];?>">
            </span>
            <span class="name"><?php echo $row['name'];?></span>
            <span class="view"><?php echo $row['hits_month'];?></span>
          </a>
<?php }?>
        </div>
      </div>
    </div>

    <div class="oz-md-4 oz-sm-6 oz-md-12">
      <div class="card">
        <div class="card-head"><i>Total</i>总浏览榜</div>
        <div class="card-body">
<?php foreach($rank_total as $index => $row) { ?>
          <a href="<?php if(empty($row['alias'])){echo "site-{$row['id']}.html";}else{echo "{$row['alias']}.html";};?>" target="_blank" class="site-ranking">
            <span class="rank"><?php echo $index + 1;?></span>
            <span class="icon">
                <img class="lazy-load" src="assets/images/loading.gif" data-src="<?php echo $row['img'];?>">
            </span>
            <span class="name"><?php echo $row['name'];?></span>
            <span class="view"><?php echo $row['hits_total'];?></span>
          </a><?php }?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require('./home/footer.php'); ?>

</body>
</html>