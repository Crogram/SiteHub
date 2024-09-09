<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '文章列表';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$page        = _get('page', 1);
$page_size   = 10;
$page_offset = ($page - 1) * $page_size;
$article_count = $DB->count('article');
$article_list  = $DB->findAll('article', '*', null, 'id desc', "$page_offset,$page_size");
?>
<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
            <li class="active"><a href="article.php"><?php echo $lang->admin->article_list; ?></a></li>
        </ol>
    </section>
    <section class="content">
        <div>
            <a class="btn btn-success" href="article_add.php"><?php echo $lang->admin->article_add; ?></a>
        </div>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="pull-right" href="article_add.php"><?php echo $lang->admin->article_add; ?></a>
                <b><?php echo $lang->admin->article_list; ?></b>
                <span>共 <b><?php echo $article_count; ?></b> 篇文章</span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr style="white-space: nowrap;">
                            <th class="text-center" style="width: 7%;">序号</th>
                            <th class="text-center" style="width: 50%;">名称</th>
                            <th class="text-center" style="width: 16%;">分类</th>
                            <th class="text-center" style="width: 5%;">推荐</th>
                            <th class="text-center" style="width: 7%;">浏览</th>
                            <th class="text-center" style="width: 20%;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($article_list as $row) { ?>
                        <tr class="text-center">
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['catename']; ?></td>
                            <td>
                                <?php echo $row['tui'] == 1 ? "<font color=orange>是</font>" : "否"; ?>
                            </td>
                            <td><?php echo $row['hits_total']; ?></td>
                            <td>
                                <a href="/article-<?php echo $row['id']; ?>.html" target="_blank" class="btn btn-xs btn-primary">查看</a>
                                <a href="article_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-info">修改</a>
                                <a class="btn btn-xs btn-danger" onclick="javascript:return app_del_article(<?php echo $row['id']; ?>, '<?php echo $row['name'];?>')">删除</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php echo pagination('article.php', $page, $article_count, $page_size); ?>
    </section>
</div>


<?php require('./footer.php'); ?>
<script>
    function app_del_article(id, name) {
        layer.confirm('您确定要删除名称为「' + name + '」的文章吗？', {
            icon: 3,
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                type: 'POST',
                url: 'article_ajax.php?act=del',
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