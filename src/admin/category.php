<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '分类列表';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$page        = _get('page', 1);
$page_size   = 10;
$page_offset = ($page - 1) * $page_size;
$cate_count = $DB->count('category');
$cate_list  = $DB->findAll('category', '*', null, 'sid asc', "$page_offset,$page_size");
?>
<div class="content-wrapper">
    <section class="content-header"><ol class="breadcrumb">
            <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
            <li class="active"><?php echo $lang->admin->category_list; ?></li>
        </ol>
    </section>
    <section class="content">
        <div>
            <a class="btn btn-success" href="category_add.php"><?php echo $lang->admin->category_add; ?></a>
        </div>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <b><?php echo $lang->admin->category_list; ?></b>
                <span>共 <b><?php echo $cate_count; ?></b> 个分类</span>
                <a class="pull-right" href="category_add.php"><?php echo $lang->admin->category_add; ?></a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr style="white-space: nowrap;">
                            <th class="text-center" style="width: 50px;">ID</th>
                            <th class="text-center" style="width: 50px;">排序</th>
                            <th class="text-center">图标</th>
                            <th class="text-center">名称</th>
                            <th class="text-center">别名</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cate_list as $row) { ?>
                        <tr class="text-center">
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['sid']; ?></td>
                            <td><i class="fa <?php echo $row['icon']; ?> fa-fw" aria-hidden="true"></i></td>
                            <td><?php echo  $row['catename']; ?></td>
                            <td><?php echo  $row['alias']; ?></td>
                            <td>
                                <a href="./category_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-info">修改</a>
                                <a class="btn btn-xs btn-danger" onclick="javascript:return app_del_category(<?php echo $row['id']; ?>, '<?php echo $row['catename'];?>')">删除</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php echo pagination('category.php', $page, $cate_count, $page_size); ?>
    </section>
</div>

<?php require('./footer.php'); ?>

<script>
    function app_del_category(id, catename) {
        layer.confirm('您确定要删除名称为「' + catename + '」的分类吗？', {
            icon: 3,
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                type: 'POST',
                url: 'category_ajax.php?act=del',
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