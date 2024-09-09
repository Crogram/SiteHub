<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '修改导航信息';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (empty($id)) {
    exit('<script type="text/javascript">window.location.href="./nav.php";</script>');
};
$nav_item = $DB->find('nav', '*', array('id' => $id));

if (empty($nav_item)) {
    exit('<script type="text/javascript">window.location.href="./nav.php";</script>');
};
?>

<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
            <li><a href="nav.php"><?php echo $lang->admin->nav_list; ?></a></li>
            <li class="active"><?php echo $lang->admin->nav_edit; ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading"><b><?php echo $lang->admin->nav_edit; ?></b></div>
            <div class="panel-body">
                <div class="alert alert-info" role="alert">
                    <center>温馨提示：序号用来排序[数字越小排名越前]，<a href="http://www.fontawesome.com.cn/faicons" target="_blank">Font Awesome图标</a></center>
                </div>
                <form action="./nav_ajax.php?act=edit" method="post">
                    <input type="text" value="<?php echo $id; ?>" name="id" style="display: none;">
                    <div class="input-group">
                        <span class="input-group-addon">序号</span>
                        <input value="<?php echo $nav_item['nid']; ?>" type="number" class="form-control" placeholder="请输入导航序号[必填，且只能填数字]"" name="nid" pattern="[1-9]+[0-9]*" required>
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">图标</span>
                        <input value="<?php echo $nav_item['icon']; ?>" type="text" class="form-control" placeholder="请输入导航图标[必填，Font Awesome图标]"" name="icon" required>
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">名称</span>
                        <input value="<?php echo $nav_item['name']; ?>" type="text" class="form-control" placeholder="请输入导航名称[必填]"" name="name" required>
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">链接</span>
                        <input value="<?php echo $nav_item['url']; ?>" type="text" class="form-control" placeholder="请输入导航链接[必填]"" name="url" required>
                    </div>
                    <br />
                    <input type="submit" class="btn btn-info btn-block" value="修改">
                </form>
            </div>
        </div>
    </section>
</div>

<?php require('./footer.php'); ?>

</body>
</html>