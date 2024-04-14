<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '添加分类';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="article.php"><?php echo $lang->admin->article_list; ?></a></li>
    <li><a href="article_category.php"><?php echo $lang->admin->article_category_list; ?></a></li>
    <li class="active"><?php echo $lang->admin->article_category_add; ?></li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading"><b><?php echo $lang->admin->article_category_add; ?></b></div>
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <center>温馨提示：序号用来排序[数字越小排名越前]，<a href="http://www.fontawesome.com.cn/faicons">Font Awesome图标</a></center>
        </div>
        <form action="article_category_ajax.php?act=add" method="post">
            <div class="input-group">
                <span class="input-group-addon">序号</span>
                <input type="number" class="form-control" placeholder="请输入分类序号[必填，且只能填数字]" name="sid" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">图标</span>
                <input type="text" class="form-control" placeholder="请输入分类图标[必填，Font Awesome图标]" name="icon" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">名称</span>
                <input type="text" class="form-control" placeholder="请输入分类名称[必填]" name="catename" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">别名</span>
                <input type="text" class="form-control" placeholder="请输入分类别名[非必填，且只能填英文字母]" name="alias" pattern="[a-zA-Z]+">
            </div>
            <br />
            <input type="submit" class="btn btn-info btn-block" value="添加">
        </form>
    </div>
</div>

<?php
require('./footer.php');
?>
</body>
</html>