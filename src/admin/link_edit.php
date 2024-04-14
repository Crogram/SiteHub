<?php

require('../includes/common.php');
require('../includes/lang.class.php');
$title = '编辑友情链接';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (empty($id)) {
    exit('<script type="text/javascript">window.location.href="link.php";</script>');
};
$link_item = $DB->find('link', '*', array('id' => $id));

if (empty($link_item)) {
    exit('<script type="text/javascript">window.location.href="link.php";</script>');
};
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="link.php"><?php echo $lang->admin->link_list; ?></a></li>
    <li class="active"><?php echo $lang->admin->link_edit; ?></li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading"><b><?php echo $lang->admin->link_edit; ?></b></div>
    <div class="panel-body">
        <form action="./link_ajax.php?act=edit" method="post">
            <input type="text" value="<?php echo $id; ?>" name="id" style="display: none;">
            <div class="input-group">
                <span class="input-group-addon">友链ID</span>
                <div class="form-control"><?php echo $link_item['id']; ?></div>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">名称</span>
                <input value="<?php echo $link_item['name']; ?>" type="text" class="form-control" placeholder="请输入友链名称[必填]" name="name" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">链接</span>
                <input value="<?php echo $link_item['url']; ?>" type="url" class="form-control" placeholder="请输入友链链接[必填]" name="url" required>
            </div>
            <br />
            <input type="submit" class="btn btn-info btn-block" value="修改">
        </form>
    </div>
</div>

<?php
require('./footer.php');
?>
</body>
</html>