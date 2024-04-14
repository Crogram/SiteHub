<?php
// 网站统计信息
$count_category      = $DB->count('category');
$count_site          = $DB->count('site');
$count_apply         = $DB->count('apply', array('reject' => 0));
$count_apply_reject  = $DB->count('apply', array('reject' => 1));
$count_article       = $DB->count('article');
$count_article_category   = $DB->count('article_category');
$count_notice      = $DB->count('notice');
$count_link        = $DB->count('link');
$top_hits_day      = $DB->find('site','id, name', array('date' => date("Y-m-d", time())), '`hits_day` desc');
$top_hits_month    = $DB->find('site','id, name', array('datem' => date("Y-m", time())), '`hits_month` desc');
$top_hits_total    = $DB->find('site','id, name', null, '`hits_total` desc');
$top_like          = $DB->find('site','id, name', null, '`like` desc');
?>
<p>已开设分类：<b><?php echo $count_category ?></b> 个</p>
<p>已收录站点：<b><?php echo $count_site ?></b> 个</p>
<p>最高日览站：<a href="<?php echo "site-{$top_hits_day['id']}.html"; ?>" target="_blank"><?php echo $top_hits_day['name']; ?></a></p>
<p>最高月览站：<a href="<?php echo "site-{$top_hits_month['id']}.html"; ?>" target="_blank"><?php echo $top_hits_month['name']; ?></a></p>
<p>最高总览站：<a href="<?php echo "site-{$top_hits_total['id']}.html"; ?>" target="_blank"><?php echo $top_hits_total['name']; ?></a></p>
<p>最高点赞站：<a href="<?php echo "site-{$top_like['id']}.html"; ?>" target="_blank"><?php echo $top_like['name']; ?></a></p>
<p>正申请站点：<b><?php echo $count_apply ?></b> 个</p>
<p>已拒绝站点：<b><?php echo $count_apply_reject ?></b> 个</p>
<p>文章的分类：<b><?php echo $count_article_category ?></b> 个</p>
<p>已发布文章：<b><?php echo $count_article ?></b> 篇</p>
<p>已发布公告：<b><?php echo $count_notice; ?></b> 条</p>
<p>已交换友链：<b><?php echo $count_link; ?></b> 个</p>
<p>本站已稳定运行了 <b><script type="text/javascript">(function() {
    var t = new Date("<?php echo $conf['build_time']; ?>").getTime();
    var n = new Date().getTime();
    var dni = Math.floor((n - t) / (1000 * 60 * 60 * 24));
    document.write(+dni);
})();</script></b> 天。</p>
