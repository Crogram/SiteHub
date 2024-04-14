<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '修改公告内容';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$id = _get('id');
if (empty($id)) {
    exit('<script type="text/javascript">window.location.href="./notice.php";</script>');
};
$row = $DB->find('notice', '*', array('id' => $id));
if (empty($row)) {
    exit('<script type="text/javascript">window.location.href="./notice.php";</script>');
};
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="notice.php"><?php echo $lang->admin->notice_list; ?></a></li>
    <li class="active"><?php echo $lang->admin->notice_edit; ?></li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <b><?php echo $lang->admin->notice_edit; ?></b>
        <span>（温馨提示：网站前台只会显示最新的一条公告）</span>
    </div>
    <div class="panel-body">
        <form action="notice_ajax.php?act=edit" method="post">
            <input type="text" value="<?php echo $id; ?>" name="id" style="display: none;">
            <div class="input-group">
                <span class="input-group-addon">内容</span>
                <textarea rows="5" class="form-control" placeholder="请输入公告内容[必填]" name="content" required><?php echo $row['content']; ?></textarea>
            </div>
            <hr />
            <input type="submit" class="btn btn-info btn-block" value="修改">
        </form>
    </div>
</div>

<?php
require('./footer.php');
?>
</body>
</html>