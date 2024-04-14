<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title='修改文章信息';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (empty($id)) {
    exit('<script type="text/javascript">window.location.href="article.php";</script>');
};
$item = $DB->find('article', '*', array('id' => $id));
if (empty($item)) {
    exit('<script type="text/javascript">window.location.href="article.php";</script>');
};
$cate_list = $DB->findAll('article_category', '', '', 'sid asc');
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="article.php"><?php echo $lang->admin->article_list; ?></a></li>
    <li class="active"><?php echo $lang->admin->article_edit; ?></li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <b><?php echo $lang->admin->article_edit;?></b>
    </div>
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <center>温馨提示：序号用来排序[数字越小排名越前]，<a href="http://www.fontawesome.com.cn/faicons">Font Awesome图标</a></center>
        </div>
        <form action="./article_ajax.php?act=edit" method="post">
            <input type="text" value="<?php echo $id;?>" name="id" style="display: none;">
            <div class="input-group">
                <span class="input-group-addon">名称</span>
                <input value="<?php echo $item['name'];?>" type="text" class="form-control" placeholder="请输入分类名称[必填]" name="name" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">推荐</span>
                <input value="<?php echo $item['tui'];?>" type="number" class="form-control" placeholder="请输入[必填，且只能填数字0或1,其中1代表推荐]" name="tui" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">分类</span>
                <select name="catename" class="form-control" required>
                    <option value="<?php echo $item['catename'];?>"><?php echo $item['catename'];?></option>
                    <option value="" disabled>--------------------------------</option>
                    <?php foreach($cate_list as $row) { ?>
                    <option value="<?php echo $row['catename'];?>"><?php echo $row['catename'];?></option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">文章内容</span>
                <textarea id="content" rows="15" class="form-control" placeholder="请输入文章内容" name="introduce" required><?php echo $item['introduce'];?></textarea>
            </div>
            <br />
            <input type="submit" class="btn btn-info btn-block" value="修改">
        </form>
    </div>
</div>
<?php require ('./footer.php'); ?>
<script charset="utf-8" src="../assets/editor/kindeditor.js"></script>
<script charset="utf-8" src="../assets/editor/lang/zh_CN.js"></script>
<script>
    loadEditor('content');
</script>
</body>
</html>