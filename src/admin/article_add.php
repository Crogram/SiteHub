<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title='添加文章';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');
$cate_list = $DB->findAll('article_category', '', '', 'sid asc');
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="article.php"><?php echo $lang->admin->article_list; ?></a></li>
    <li class="active"><?php echo $lang->admin->article_add; ?></li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <b><?php echo $lang->admin->article_add;?></b>
    </div>
    <div class="panel-body">
        <form action="./article_ajax.php?act=add" method="post">
            <div class="input-group">
                <span class="input-group-addon">名称</span>
                <input type="text" class="form-control" placeholder="请输入文章标题[必填]" name="name" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">推荐</span>
                <input type="number" class="form-control" placeholder="请输入[必填，且只能填数字0或1,其中1代表推荐]" name="tui" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">分类</span>
                <select name="catename" class="form-control" required>
                    <option value="">请选择站点分类[必选]</option>
                    <?php foreach($cate_list as $row) { ?>
                    <option value="<?php echo $row['catename'];?>"><?php echo $row['catename'];?></option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">文章内容</span>
                <textarea id="content" rows="15" class="form-control" name="introduce"></textarea>
            </div>
            <br />
            <input type="submit" class="btn btn-primary" value="添加">
        </form>
    </div>
</div>

<?php require ('./footer.php'); ?>

<script charset="utf-8" src="../assets/editor/kindeditor.js"></script>
<script charset="utf-8" src="../assets/editor/lang/zh_CN.js"></script>
<script>loadEditor('content');</script>
</body>
</html>