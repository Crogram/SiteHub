<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '公告列表';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$page         = _get('page', 1);
$page_size    = 10;
$page_offset  = ($page - 1) * $page_size;
$notice_count = $DB->count('notice');
$notice_list  = $DB->findAll('notice', '*', null, 'id desc', "$page_offset,$page_size");
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li class="active"><?php echo $lang->admin->notice_list; ?></li>
</ol>
<div>
    <a class="btn btn-success" href="notice_add.php"><?php echo $lang->admin->notice_add; ?></a>
</div>
<br />
<div class="panel panel-default">
    <div class="panel-heading">
        <b><?php echo $lang->admin->notice_list; ?></b>
        <span>共 <b><?php echo $notice_count; ?></b> 条公告</span>
        <a class="pull-right" href="notice_add.php"><?php echo $lang->admin->notice_add; ?></a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr style="white-space: nowrap;">
                <th class="text-center" style="width: 10%;">ID</th>
                <th class="text-center" style="width: 75%;">内容</th>
                <th class="text-center" style="width: 15%;">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($notice_list as $row) { ?>
            <tr class="text-center">
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['content']; ?></td>
                <td>
                    <a href="./notice_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-info">修改</a>
                    <a class="btn btn-xs btn-danger" onclick="javascript:return app_del_notice(<?php echo $row['id']; ?>)">删除</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php echo pagination('notice.php', $page, $notice_count, $page_size); ?>

<?php require('./footer.php'); ?>
<script>
    function app_del_notice(id) {
        layer.confirm('您确定要删除ID为「' + id + '」的公告吗？', {
            icon: 3,
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                type: 'POST',
                url: 'notice_ajax.php?act=del',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.code == 0) {
                        layer.msg('删除成功', {
                            icon: 1,
                            time: 500,
                            end: function () {
                                window.location.assign(window.location.href);
                            }
                        });
                    } else {
                        layer.alert(data.msg, {
                            icon: 2
                        });
                    }
                }
            });
        });
    }
</script>
</body>
</html>