<?php
require('../includes/common.php');
require('../includes/lang.class.php');
$title = '后台首页';
require('./header.php');
require('./navbar.php');
require('./sidebar.php');
$checkupdate = '//auth.u-id.cn/app/php-app-domain.php?ver=' . VERSION;
?>

<link rel="stylesheet" type="text/css" href="../assets/css/admin-index.css" />

<div class="content-wrapper">
    <!-- <section class="content-header"><ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> 后台首页</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        </ol>
    </section> -->
    <section class="content">
        <!-- 统计信息 -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-book fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <span id="count_site">0</span> /<span class="count-all" id="count_category">0</span>
                                </div>
                                <div><?php echo $lang->admin->site; ?> / <?php echo $lang->admin->category; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-left"><a href="site.php"><i class="fa fa-arrow-circle-right"></i> <?php echo $lang->admin->site_list; ?></a></span>
                        <span class="pull-right"><a href="category.php"><i class="fa fa-handshake-o"></i> <?php echo $lang->admin->category_list; ?></a></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-hourglass-2 fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <span id="count_apply">0</span> /<span class="count-all" id="count_apply_reject">0</span>
                                </div>
                                <div><?php echo $lang->admin->apply; ?> / <?php echo $lang->admin->apply_reject; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-left"><a href="apply.php"><?php echo $lang->admin->apply_list; ?> <i class="fa fa-arrow-circle-right"></i></a></span>
                        <span class="pull-right"><a href="apply_reject.php"><i class="fa fa-ban"></i> <?php echo $lang->admin->apply_reject_list; ?></a></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-newspaper-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <span id="count_article">0</span> /<span class="count-all" id="count_article_category">0</span>
                                </div>
                                <div><?php echo $lang->admin->article; ?> / <?php echo $lang->admin->article_category; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-left"><a href="article.php"><?php echo $lang->admin->article; ?> <i class="fa fa-arrow-circle-right"></i></a></span>
                        <span class="pull-right"><a href="article_category.php"><i class="fa fa-envelope"></i> <?php echo $lang->admin->article_category; ?></a></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-rmb fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <span id="count_notice">0</span> /<span class="count-all" id="count_link">0</span>
                                </div>
                                <div><?php echo $lang->admin->notice; ?> / <?php echo $lang->admin->link; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-left"><a href="notice.php"><?php echo $lang->admin->notice_list; ?> <i class="fa fa-arrow-circle-right"></i></a></span>
                        <span class="pull-right"><a href="link.php"><i class="fa fa-handshake-o fa-fw"></i> <?php echo $lang->admin->link_list; ?></a></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-success" role="alert">
            欢迎管理员 <a href="account.php"><?php echo $conf['admin_user']; ?></a> 登录系统。快捷操作：
            <a href="./site_add.php" class="btn btn-primary btn-xs"><?php echo $lang->admin->site_add; ?></a>
            <a href="./notice_add.php" class="btn btn-warning btn-xs"><?php echo $lang->admin->notice_add; ?></a>
            <a href="./article_add.php" class="btn btn-success btn-xs"><?php echo $lang->admin->article_add; ?></a>
            <a href="./link_add.php" class="btn btn-info btn-xs"><?php echo $lang->admin->link_add; ?></a>
            <a href="./category_add.php" class="btn btn-link btn-xs"><?php echo $lang->admin->category_add; ?></a>
            <a href="./article_category_add.php" class="btn btn-link btn-xs"><?php echo $lang->admin->article_category_add; ?></a>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><b>系统信息</b></div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>系统程序</th>
                            <td><?php echo $lang->app->name; ?></td>
                            <th>程序版本</th>
                            <td>v<?php echo APP_VERSION; ?> <button class="btn btn-success btn-xs" onclick="appCheckUpdate();">检查更新</button></td>
                        </tr>
                        <tr>
                            <th>服务器软件</th>
                            <td><?php echo $_SERVER['SERVER_SOFTWARE'] ?></td>
                            <th>服务器语言</th>
                            <td><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE']; ?></td>
                        </tr>
                        <tr>
                            <th>服务器IP</th>
                            <td><?php echo GetHostByName($_SERVER['SERVER_NAME']); ?></td>
                            <th>PHP版本</th>
                            <td><?php echo phpversion() ?> <?php if (ini_get('safe_mode')) { echo '线程安全'; } else { echo '非线程安全'; } ?></td>
                        </tr>
                        <tr>
                            <th>POST许可</th>
                            <td><?php echo ini_get('post_max_size'); ?></td>
                            <th>文件上传许可</th>
                            <td><?php echo ini_get('upload_max_filesize'); ?></td>
                        </tr>
                        <tr>
                            <th>程序最大运行时间</th>
                            <td><?php echo ini_get('max_execution_time') ?>s</td>
                            <th>网站路径</th>
                            <td><?php echo ROOT; ?>/</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><b>支持信息</b></div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>最新版本下载网址</th>
                            <td>
                                <a href="https://github.com/crogram/SiteHub" target="_blank">源码下载</a>
                                <a href="https://txc.qq.com/products/377144" target="_blank">交流反馈</a>
                            </td>
                            <th>联系微信</th><td>jksdou</td>
                        </tr>
                        <tr>
                            <th>联系邮箱</th><td>jksdou@qq.com</td>
                            <th>联系QQ</th><td>350430869</td>
                        </tr>
                        <tr>
                            <th>Copyright</th>
                            <td colspan="3">
                                <strong>Copyright &copy; <?php echo date('Y'); ?> <a target="_blank" href="https://crogram.org">CROGRAM</a>.</strong> All Rights Reserved. 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php require('./footer.php'); ?>

<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "ajax.php?act=stat",
            dataType: 'json',
            async: true,
            success: function(data) {
                $('#count_nav').html(data.count.nav);
                $('#count_category').html(data.count.category);
                $('#count_site').html(data.count.site);
                $('#count_apply').html(data.count.apply);
                $('#count_apply_reject').html(data.count.apply_reject);
                $('#count_article_category').html(data.count.article_category);
                $('#count_article').html(data.count.article);
                $('#count_notice').html(data.count.notice);
                $('#count_link').html(data.count.link);
            }
        });
        // $.ajax({
        //     url: '<?php echo $checkupdate ?>',
        //     type: 'get',
        //     dataType: 'jsonp',
        //     jsonpCallback: 'callback'
        // }).done(function(data){
        //     $("#checkupdate").html(data.msg);
        // });
    });
    function appCheckUpdate () {
        layer.msg('开发中');
    }
</script>

</body>
</html>