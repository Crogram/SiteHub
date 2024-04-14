<?php
if (!defined('IN_CRONLITE')) return;
// 站点分类列表
$row_cate = $DB->findAll('category', '*', '', 'sid asc');
?>

<ul class="category">
    <li><a href="./"><span>返回首页</span> <i class="fa fa-reply fa-fw"></i></a></li>
<?php foreach($row_cate as $row) { ?>
    <li><a href="category-<?php echo $row['id'];?>.html"><span><?php echo $row['catename'];?></span> <i class="fa <?php echo $row['icon'];?> fa-fw"></i></a></li>
<?php } ?>
</ul>
