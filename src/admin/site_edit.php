<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '修改站点信息';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');

$id = _get('id');
if (empty($id)) {
    exit('<script type="text/javascript">window.location.href="./site.php";</script>');
};
$row = $DB->find('site', '*', array('id' => $id));
if (empty($row)) {
    exit('<script type="text/javascript">window.location.href="./site.php";</script>');
};

$cate_list = $DB->findAll('category', 'catename', null, 'sid asc');
?>
<ol class="breadcrumb">
    <li><a href="./"><?php echo $lang->admin->index; ?></a></li>
    <li><a href="site.php"><?php echo $lang->admin->site_list; ?></a></li>
    <li class="active"><?php echo $lang->admin->site_edit; ?></li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading"><b><?php echo $lang->admin->site_edit; ?></b></div>
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <center>温馨提示：序号用来排序[数字越小排名越前]，别名是指链接别名[不可重复]<br />至于图片你可以默认用google的接口获取ico，也可以直接换成你自己的图片地址</center>
        </div>
        <form action="./site_ajax.php?act=edit" method="post" enctype="multipart/form-data">
            <input type="text" value="<?php echo $id; ?>" name="id" style="display: none;">
            <div class="input-group">
                <span class="input-group-addon">序号</span>
                <input value="<?php echo $row['lid']; ?>" type="number" class="form-control" placeholder="请输入站点序号[必填，且只能填数字]" name="lid" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">推荐</span>
                <input value="<?php echo $row['tui']; ?>" type="number" class="form-control" placeholder="请输入[必填，且只能填数字0或1，其中1代表推荐]" name="tui" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">星级</span>
                <input value="<?php echo $row['star']; ?>" type="number" class="form-control" placeholder="请输入[必填，且只能填数字1或2或3或4或5]" name="star" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">名称</span>
                <input value="<?php echo $row['name']; ?>" type="text" class="form-control" placeholder="请输入站点名称[必填]" name="name" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">图片</span>
                <input value="<?php echo $row['img']; ?>" type="text" class="form-control" placeholder="<?php echo $conf['ico_api']; ?>这里文字请换成你添加的域名链接" name="img">
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">分类</span>
                <select name="catename" class="form-control" required>
                    <option value="<?php echo $row['catename']; ?>"><?php echo $row['catename']; ?></option>
                    <option value="" disabled>--------------------------------</option>
                <?php foreach ($cate_list as $cate) { ?>
                    <option value="<?php echo $cate['catename']; ?>"><?php echo $cate['catename']; ?></option>
                <?php } ?>
                </select>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">链接</span>
                <input value="<?php echo $row['url']; ?>" type="url" class="form-control" placeholder="请输入站点链接[必填]" name="url" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">别名</span>
                <input value="<?php echo $row['alias']; ?>" type="text" class="form-control" placeholder="请输入站点别名[非必填，且只能填英文字母]" name="alias" pattern="[a-zA-Z]+">
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">关键词</span>
                <input value="<?php echo $row['keywords']; ?>" type="text" class="form-control" placeholder="请输入站点关键词[必填，每个词用逗号隔开]" name="keywords" required>
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon">简介</span>
                <textarea rows="3" class="form-control" placeholder="请输入站点简介[必填]" name="introduce" required><?php echo $row['introduce']; ?></textarea>
            </div>
            <br />
            <input type="submit" class="btn btn-info btn-block" value="修改">
        </form>
    </div>
</div>
<?php
require('./footer.php');
?>
</body>
</html>