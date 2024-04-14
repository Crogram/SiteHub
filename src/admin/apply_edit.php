<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title='审核站点申请';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$id = _get('id', null);
if (empty($id)) {
    exit('<script type="text/javascript">window.location.href="apply.php";</script>');
};
$apply_item = $DB->find('apply', '*', array('id' => $id));

if (empty($apply_item)) {
    exit('<script type="text/javascript">window.location.href="apply.php";</script>');
};
$cate_list = $DB->findAll('category', 'catename', null, 'sid asc');
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="site.php"><?php echo $lang->admin->site; ?></a></li>
    <li><a href="apply.php"><?php echo $lang->admin->apply_list; ?></a></li>
    <li class="active"><?php echo $lang->admin->apply_edit; ?></li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading"><b><?php echo $lang->admin->apply_edit;?></b></div>
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <center>温馨提示：序号用来排序[数字越小排名越前]，别名是指链接别名[不可重复]<br />至于图片你可以默认用google的接口获取ico，也可以直接换成你自己的图片地址</center>
        </div>
        <form action="./site_ajax.php?act=add" method="post" enctype="multipart/form-data">
            <input type="text" value="<?php echo $id;?>" name="apply_id" style="display: none;">
            <div class="input-group">
                <span class="input-group-addon">序号</span>
                <input type="number" class="form-control" placeholder="请输入站点序号[必填，且只能填数字]" name="lid" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">推荐</span>
                <input type="number" class="form-control" placeholder="请输入[必填，且只能填数字0或1，其中1代表推荐]" name="tui" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">星级</span>
                <input type="number" class="form-control" placeholder="请输入[必填，且只能填数字1或2或3或4或5]" name="star" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">名称</span>
                <input value="<?php echo $apply_item['name'];?>" type="text" class="form-control" placeholder="请输入站点名称[必填]" name="name" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">图标</span>
                <input value="<?php echo $apply_item['img'];?>" type="text" class="form-control" placeholder="请输入站点图片[必填，请填写favicon.ico链接]" name="img">
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">分类</span>
                <select name="catename" class="form-control" required>
                    <option value="<?php echo $apply_item['catename'];?>"><?php echo $apply_item['catename'];?></option>
                    <option value="" disabled>--------------------------------</option>
                    <?php foreach ($cate_list as $row) { ?>
                    <option value="<?php echo $row['catename']; ?>"><?php echo $row['catename']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">链接</span>
                <input value="<?php echo $apply_item['url'];?>" type="url" class="form-control" placeholder="请输入站点链接[必填]" name="url" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">别名</span>
                <input value="" type="text" class="form-control" placeholder="请输入站点别名[非必填，且只能填英文字母]" name="alias" pattern="[a-zA-Z]+">
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">关键词</span>
                <input value="<?php echo $apply_item['keywords'];?>" type="text" class="form-control" placeholder="请输入站点关键词[必填，每个词用逗号隔开]" name="keywords" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">简介</span>
                <textarea rows="3" class="form-control" placeholder="请输入站点简介[必填]" name="introduce" required><?php echo $apply_item['introduce'];?></textarea>
            </div>
            <br />
            <input type="submit" class="btn btn-info btn-block" value="修改并通过审核">
        </form>
    </div>
</div>

<?php require ('./footer.php'); ?>
</body>
</html>