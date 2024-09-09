<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '导航列表';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$page        = _get('page', 1);
$page_size   = 10;
$page_offset = ($page - 1) * $page_size;
$nav_count   = $DB->count('nav');
$nav_list    = $DB->findAll('nav', '*', null, 'nid asc', "$page_offset,$page_size");
?>
<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
            <li class="active"><?php echo $lang->admin->nav_list; ?></li>
        </ol>
    </section>
    <section class="content">
        <div>
            <a class="btn btn-success" href="nav_add.php"><?php echo $lang->admin->nav_add; ?></a>
        </div>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <span><b><?php echo $lang->admin->nav_list; ?></b></span>
                <span>共 <b><?php echo $nav_count; ?></b> 个导航</span>
                <a class="pull-right" href="nav_add.php"><?php echo $lang->admin->nav_add; ?></a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr style="white-space: nowrap;">
                            <th class="text-center" style="width: 10%;">序号</th>
                            <th class="text-center" style="width: 10%;">图标</th>
                            <th class="text-center" style="width: 15%;">名称</th>
                            <th class="text-center" style="width: 45%;">链接</th>
                            <th class="text-center" style="width: 20%;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($nav_list as $row) { ?>
                        <tr class="text-center">
                            <td><?php echo $row['nid']; ?></td>
                            <td><i class="fa <?php echo $row['icon']; ?> fa-fw" aria-hidden="true"></i></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['url']; ?></td>
                            <td>
                                <a href="../<?php echo $row['url']; ?>" class="btn btn-xs btn-primary" target="_blank">查看</a>
                                <a href="./nav_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-info">修改</a>
                                <a class="btn btn-xs btn-danger" onclick="javascript:return app_del_menu(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>')">删除</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php echo pagination('nav.php', $page, $nav_count, $page_size); ?>
    </section>
</div>

<?php require('./footer.php'); ?>

<script>
    function app_del_menu(id, name) {
        layer.confirm('您确定要删除名称为「' + name + '」的导航菜单吗？', {
            icon: 3,
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                type: 'POST',
                url: 'nav_ajax.php?act=del',
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
