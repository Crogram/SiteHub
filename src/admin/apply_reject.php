<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title='拒绝列表';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$page        = 1;
$page_size   = 10;
if (!isset($_GET['page'])) {
    $page    = 1;
    $pageu   = $page - 1;
} else {  
    $page    = $_GET['page'] ? $_GET['page'] : 1;
    $pageu   = ($page - 1) * $page_size;
}
$apply_count = $DB->count('apply', array('reject' => 1));
$apply_list  = $DB->findAll('apply', '*', array('reject' => 1), 'id asc', "$pageu,$page_size");
?>
<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
            <li><a href="site.php"><?php echo $lang->admin->site; ?></a></li>
            <li class="active"><?php echo $lang->admin->apply_reject_list; ?></li>
        </ol>
    </section>
    <section class="content">
        <div>
            <a class="btn btn-success" href="apply.php"><?php echo $lang->admin->apply; ?></a>
        </div>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <b><?php echo $lang->admin->apply_reject;?></b>
                <span>共 <b><?php echo $apply_count;?></b> 个拒绝</span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr style="white-space: nowrap;">
                            <th class="text-center" style="width: 10%;">名称</th>
                            <th class="text-center" style="width: 5%;">图片</th>
                            <th class="text-center" style="width: 10%;">分类</th>
                            <th class="text-center" style="width: 15%;">链接</th>
                            <th class="text-center" style="width: 40%;">简介</th>
                            <th class="text-center" style="width: 20%;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($apply_list as $row) { ?>
                        <tr class="text-center">
                            <td><?php echo $row['name'];?></td>
                            <td><img src="<?php echo $row['img'];?>" width="20px" height="20px"></td>
                            <td><?php echo $row['catename'];?></td>
                            <td><a href="../go.php?url=<?php echo $row['url'];?>" title="<?php echo $row['url'];?>" target="_blank"><?php echo $row['url'];?></a></td>
                            <td><?php echo $row['introduce'];?></td>
                            <td>
                                <a class="btn btn-xs btn-success" onclick="javascript:return app_reset_apply(<?php echo $row['id']; ?>, '<?php echo $row['name'];?>')">恢复审核</a>
                                <a class="btn btn-xs btn-danger" onclick="javascript:return app_del_apply(<?php echo $row['id']; ?>, '<?php echo $row['name'];?>')">删除</a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php echo pagination('apply_reject.php', $page, $apply_count, $page_size); ?>
    </section>
</div>


<?php require ('./footer.php'); ?>
<script>
    function app_reset_apply(id, name) {
        layer.confirm('您确定要恢复审核站点「' + name + '」吗？', {
            icon: 3,
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                type: 'POST',
                url: 'apply_ajax.php?act=reset',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.code == 0) {
                        layer.msg(data.msg || '恢复审核申请成功！', {
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
    function app_del_apply(id, name) {
        layer.confirm('您确定要删除站点为「' + name + '」的申请吗？', {
            icon: 3,
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                type: 'POST',
                url: 'apply_ajax.php?act=del',
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