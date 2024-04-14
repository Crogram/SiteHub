<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '添加友链';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="link.php"><?php echo $lang->admin->link_list; ?></a></li>
    <li class="active"><?php echo $lang->admin->link_add; ?></li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading"><b><?php echo $lang->admin->link_add;?></b></div>
    <div class="panel-body">
        <form action="./link_ajax.php?act=add" method="post">
            <div class="input-group">
                <span class="input-group-addon">名称</span>
                <input type="text" class="form-control" placeholder="请输入友链名称[必填]" name="name" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">链接</span>
                <input type="url" class="form-control" placeholder="请输入友链链接[必填]" name="url" required>
            </div>
            <br />
            <input type="submit" class="btn btn-info btn-block" value="添加">
        </form>
    </div>
</div>
<?php require ('./footer.php'); ?>
</body>
</html>