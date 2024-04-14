<?php

require('../includes/common.php');
require('../includes/lang.class.php');
$title='友链列表';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$page        = _get('page', 1);
$page_size   = 10;
$page_offset = ($page - 1) * $page_size;
$link_count  = $DB->count('link');
$link_list   = $DB->findAll('link', '*', null, 'id asc', "$page_offset,$page_size");
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="link.php"><?php echo $lang->admin->link_list; ?></a></li>
</ol>
<div>
    <a class="btn btn-success" href="link_add.php"><?php echo $lang->admin->link_add; ?></a>
</div>
<br />
<div class="panel panel-default">
    <div class="panel-heading">
        <a href="link_add.php" class="pull-right"><?php echo $lang->admin->link_add; ?></a>
        <b><?php echo $lang->admin->link_list;?></b>
        <span>(共 <b><?php echo $link_count;?></b> 个)</span>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr style="white-space: nowrap;">
                    <th class="text-center" style="width: 10%;">ID</th>
                    <th class="text-center" style="width: 15%;">名称</th>
                    <th class="text-center" style="width: 45%;">链接</th>
                    <th class="text-center" style="width: 20%;">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($link_list as $row) { ?>
                <tr class="text-center">
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo  $row['name'];?></td>
                    <td><a href="<?php echo $row['url'];?>" title="<?php echo $row['url'];?>" target="_blank"><?php echo $row['url'];?></a></td>
                    <td>
                        <a href="./link_edit.php?id=<?php echo $row['id'];?>" class="btn btn-xs btn-info">修改</a> 
                        <a class="btn btn-xs btn-danger" onclick="javascript:return app_del_link(<?php echo $row['id']; ?>, '<?php echo $row['name'];?>')">删除</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>

<?php echo pagination('link.php', $page, $link_count, $page_size); ?>

<?php require('./footer.php'); ?>
<script>
    function app_del_link(id, name) {
        layer.confirm('您确定要删除名称为「' + name + '」的友链吗？', {
            icon: 3,
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                type: 'POST',
                url: 'link_ajax.php?act=del',
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