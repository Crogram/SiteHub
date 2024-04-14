<?php

require('../includes/common.php');
require('../includes/lang.class.php');

$title = $lang->admin->apply_list;
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$page        = _get('page', 1);
$page_size   = 10;
$page_offset = ($page - 1) * $page_size;
$apply_count = $DB->count('apply', array('reject' => 0));
$apply_list  = $DB->findAll('apply', '*', array('reject' => 0), 'id asc', "$page_offset,$page_size");
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="site.php"><?php echo $lang->admin->site; ?></a></li>
    <li class="active"><?php echo $lang->admin->apply_list; ?></li>
</ol>
<div>
    <a class="btn btn-success" href="apply_reject.php"><?php echo $lang->admin->apply_reject; ?></a>
</div>
<br />
<div class="panel panel-default">
    <div class="panel-heading">
        <b><?php echo $lang->admin->apply;?></b>
        <span>共 <b><?php echo $apply_count;?></b> 个申请</span>
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
                    <td><?php echo  $row['catename'];?></td>
                    <td><a href="../go.php?url=<?php echo $row['url'];?>" title="<?php echo $row['url'];?>" target="_blank"><?php echo $row['url'];?></a></td>
                    <td><?php echo $row['introduce'];?></td>
                    <td>
                        <a href="./apply_edit.php?id=<?php echo $row['id'];?>" class="btn btn-xs btn-info">审核</a>
                        <a class="btn btn-xs btn-success" onclick="javascript:return app_reject_apply(<?php echo $row['id']; ?>, '<?php echo $row['name'];?>')">拒绝</a>
                        <a class="btn btn-xs btn-danger" onclick="javascript:return app_del_apply(<?php echo $row['id']; ?>, '<?php echo $row['name'];?>')">删除</a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>

<?php echo pagination('apply.php', $page, $apply_count, $page_size); ?>

<?php require ('./footer.php'); ?>
<script>
    function app_reject_apply(id, name) {
        layer.confirm('您确定要拒绝站点「' + name + '」并且放进黑名单吗？', {
            icon: 3,
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                type: 'POST',
                url: 'apply_ajax.php?act=reject',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.code == 0) {
                        layer.msg(data.msg || '拒绝申请，放进黑名单成功！', {
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