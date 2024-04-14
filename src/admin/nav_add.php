<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '添加导航';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="nav.php"><?php echo $lang->admin->nav_list; ?></a></li>
    <li class="active"><?php echo $lang->admin->nav_add; ?></li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading"><b><?php echo $lang->admin->nav_add; ?></b></div>
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <center>温馨提示：序号用来排序[数字越小排名越前]，<a href="http://www.fontawesome.com.cn/faicons" target="_blank">Font Awesome图标</a></center>
        </div>
        <form action="./nav_ajax.php?act=add" method="post">
            <div class="input-group">
                <span class="input-group-addon">序号</span>
                <input type="number" class="form-control" placeholder="请输入导航序号[必填，且只能填数字]"" name="nid" pattern="[1-9]+[0-9]*" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">图标</span>
                <input type="text" class="form-control" placeholder="请输入导航图标[必填，Font Awesome图标]"" name="icon" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">名称</span>
                <input type="text" class="form-control" placeholder="请输入导航名称[必填]"" name="name" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">链接</span>
                <input type="text" class="form-control" placeholder="请输入导航链接[必填]"" name="url" required>
            </div>
            <br />
            <div style="text-align: center;">
                <input type="submit" class="btn btn-info btn-block" value="添加">
            </div>
        </form>
    </div>
</div>

<?php
require('./footer.php');
?>
</body>
</html>