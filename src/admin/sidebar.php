<div class="col-sm-3 col-md-3 col-lg-2">
    <!-- <div class="page-header">
        <a href="profile.php" class="sidebar-link sidebar-link-with-icon">
            <span class="sidebar-icon bg-transparent text-dark rounded-circle">
                <img class="rounded-circle" src="https://dn-qiniu-avatar.qbox.me/avatar/<?php echo $avatar_path; ?>?s=30" height="30px" width="30px">
            </span>
            <?php echo $conf['admin_user']; ?>
        </a>
    </div> -->
    <div class="sidebar hidden-xs">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="panel-title">管理菜单</span></div>
            <div class="list-group">
                <a class="list-group-item <?php echo checkIfActiveNew('index,') ?>" href="index.php"><i class="fa fa-dashboard fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->index; ?></a>
                <a class="list-group-item <?php echo checkIfActiveNew('category,category_add,category_edit') ?>" href="category.php"><i class="fa fa-map-signs fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->category; ?></a>
                <a class="list-group-item <?php echo checkIfActiveNew('site,site_add,site_edit') ?>" href="site.php"><i class="fa fa-book fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->site; ?></a>
                <a class="list-group-item <?php echo checkIfActiveNew('apply,apply_edit') ?>" href="apply.php"><i class="fa fa-hourglass-2 fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->apply; ?></a>
                <a class="list-group-item <?php echo checkIfActiveNew('apply_reject') ?>" href="apply_reject.php"><i class="fa fa-ban fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->apply_reject; ?></a>
                <a class="list-group-item <?php echo checkIfActiveNew('article_category,article_category_add,article_category_edit') ?>" href="article_category.php"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->article_category; ?></a>
                <a class="list-group-item <?php echo checkIfActiveNew('article,article_add,article_edit') ?>" href="article.php"><i class="fa fa-newspaper-o fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->article; ?></a>
                <a class="list-group-item <?php echo checkIfActiveNew('notice,notice_add,notice_edit') ?>" href="notice.php"><i class="fa fa-bullhorn fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->notice; ?></a>
                <a class="list-group-item <?php echo checkIfActiveNew('link,link_add,link_edit') ?>" href="link.php"><i class="fa fa-handshake-o fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->link; ?></a>
                <a class="list-group-item <?php echo checkIfActiveNew('nav,nav_add,nav_edit') ?>" href="nav.php"><i class="fa fa-location-arrow fa-fw"></i> <?php echo $lang->admin->nav; ?></a>
                <a class="list-group-item <?php echo checkIfActiveNew('settings') ?>" href="settings.php"><i class="fa fa-gear fa-fw fa-spin" aria-hidden="true"></i> <?php echo $lang->admin->settings; ?></a>
                <a class="list-group-item <?php echo checkIfActiveNew('settings_material') ?>" href="settings_material.php"><i class="glyphicon glyphicon-picture fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->settings_material; ?></a>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="list-group">
                <a class="list-group-item" href="#" onclick="return logout();"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> <?php echo $lang->index->logout; ?></a>
            </div>
        </div>
        <div class="panel panel-default sidebar-footer">
            <div class="list-group">
                <div class="list-group-item text-center bg-success"><?php echo $lang->app->name; ?> v<?php echo APP_VERSION; ?></div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-9 col-md-9 col-lg-10">
