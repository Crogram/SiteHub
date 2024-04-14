<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '站点列表';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$page         = _get('page', 1);
$page_size    = 10;
$page_offset  = ($page - 1) * $page_size;
$site_count = $DB->count('site');
$site_list  = $DB->findAll('site', '*', null, 'time desc', "$page_offset,$page_size");
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li class="active"><?php echo $lang->admin->site_list; ?></li>
</ol>
<div>
    <a class="btn btn-success" href="site_add.php"><?php echo $lang->admin->site_add; ?></a>
</div>
<br />
<div class="panel panel-default">
    <div class="panel-heading">
        <a class="pull-right" href="site_add.php"><?php echo $lang->admin->site_add; ?></a>
        <b><?php echo $lang->admin->site_list;?></b>
        <span>共 <b><?php echo $site_count; ?></b> 个站点</span>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr style="white-space: nowrap;">
                    <th class="text-center" style="width: 5%;">ID</th>
                    <th class="text-center" style="width: 5%;">序号</th>
                    <th class="text-center" style="width: 10%;">名称</th>
                    <th class="text-center" style="width: 5%;">图片</th>
                    <th class="text-center" style="width: 10%;">分类</th>
                    <th class="text-center" style="width: 15%;">链接</th>
                    <th class="text-center" style="width: 5%;">推荐</th>
                    <th class="text-center" style="width: 26%;">简介</th>
                    <th class="text-center" style="width: 5%;">浏览</th>
                    <th class="text-center" style="width: 24%;">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($site_list as $row) { ?>
                <tr class="text-center">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['lid']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><img src="<?php echo $row['img']; ?>" width="20px" height="20px"></td>
                    <td><?php echo $row['catename']; ?></td>
                    <td><a href="../go.php?url=<?php echo $row['url']; ?>" title="<?php echo $row['url']; ?>" target="_blank"><?php echo $row['url']; ?></a></td>
                    <td>
                        <?php if ($row['tui'] == 1) {
                            echo "<font color=orange>是</font>";
                        } else {
                            echo "否";
                        }; ?>
                    </td>
                    <td>
                        <?php
                        $introduce = $row["introduce"];
                        if (strlen($introduce) > 48) {
                            echo mb_substr($introduce, 0, 16, "utf-8") . "..";
                        } else {
                            echo $introduce;
                        }
                        ?>
                    </td>
                    <td><?php echo $row['hits_total']; ?></td>
                    <td>
                        <a href="../site-<?php echo $row['id']; ?>.html" class="btn btn-xs btn-primary" target="_blank">查看</a>
                        <a href="./site_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-info">修改</a>
                        <button class="btn btn-xs btn-danger" onclick="javascript:return app_del_site(<?php echo $row['id']; ?>,'<?php echo $row['name']; ?>')">删除</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo pagination('site.php', $page, $site_count, $page_size); ?>

<?php require('./footer.php'); ?>
<script>
    function app_del_site(id, name) {
        layer.confirm('您确定要删除名称为「' + name + '」的站点吗？', {
            icon: 3,
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                type: 'POST',
                url: 'site_ajax.php?act=del',
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