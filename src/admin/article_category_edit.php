<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title='修改分类信息';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$id = _get('id');
if (empty($id)) {
    exit('<script type="text/javascript">window.location.href="article_category.php";</script>');
};
$row = $DB->find('article_category', '*', array('id' => $id));

if (empty($row)) {
    exit('<script type="text/javascript">window.location.href="article_category.php";</script>');
};
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="article.php"><?php echo $lang->admin->article_list; ?></a></li>
    <li><a href="article_category.php"><?php echo $lang->admin->article_category_list; ?></a></li>
    <li class="active"><?php echo $lang->admin->article_category_edit; ?></li>
</ol>

<div class="panel panel-default">
    <div class="panel-heading"><b><?php echo $lang->admin->article_category_edit;?></b></div>
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <center>温馨提示：序号用来排序[数字越小排名越前]，<a href="http://www.fontawesome.com.cn/faicons">Font Awesome图标</a></center>
        </div>
        <form action="./article_category_ajax.php?act=edit" method="post">
            <input type="text" value="<?php echo $id;?>" name="id" style="display: none;">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">序号</span>
                <input value="<?php echo $row['sid'];?>" type="number" class="form-control" placeholder="请输入分类序号[必填，且只能填数字]" aria-describedby="basic-addon1" name="sid" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">图标</span>
                <input value="<?php echo $row['icon'];?>" type="text" class="form-control" placeholder="请输入分类图标[必填，Font Awesome图标]" aria-describedby="basic-addon1" name="icon" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">名称</span>
                <input value="<?php echo $row['catename'];?>" type="text" class="form-control" placeholder="请输入分类名称[必填]" aria-describedby="basic-addon1" name="catename" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">别名</span>
                <input value="<?php echo $row['alias'];?>" type="text" class="form-control" placeholder="请输入分类别名[非必填，且只能填英文字母]" aria-describedby="basic-addon1" name="alias" pattern="[a-zA-Z]+">
            </div>
            <br />
            <div style="text-align: center;">
                <input type="submit" class="btn btn-info" style="width: 80%;" value="修改">
            </div>
        </form>
    </div>
</div>

<?php
    require ('./footer.php');
?>
</body>
</html>