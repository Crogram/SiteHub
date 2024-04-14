<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '发布公告';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="notice.php"><?php echo $lang->admin->notice_list; ?></a></li>
    <li class="active"><?php echo $lang->admin->notice_add; ?></li>
</ol>

<div class="panel panel-default">
    <div class="panel-heading">
        <b><?php echo $lang->admin->notice_add; ?></b>
        <span>（温馨提示：网站前台只会显示最新的一条公告）</span>
    </div>
    <div class="panel-body">
        <form action="notice_ajax.php?act=add" method="post">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">内容</span>
                <textarea rows="5" class="form-control" placeholder="请输入公告内容[必填]" aria-describedby="basic-addon1" name="content" required></textarea>
            </div>
            <br />
            <div style="text-align: center;">
                <input type="submit" class="btn btn-info btn-block" value="发布">
            </div>
        </form>
    </div>
</div>
<?php
require('./footer.php');
?>
</body>
</html>