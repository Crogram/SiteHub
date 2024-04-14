<div class="container-fluid">
    <nav class="navbar navbar-fixed-top navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">navbar</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="./"><img src="../assets/images/logo.png" alt="<?php echo $lang->admin->title; ?>"></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="<?php echo checkIfActiveNew('index') ?>">
                        <a href="./"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a>
                    </li>
                    <li class="<?php echo checkIfActiveNew('site,site_add,site_edit') ?>">
                        <a href="site.php"><i class="fa fa-book fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->site; ?></a>
                    </li>
                    <li class="<?php echo checkIfActiveNew('apply,apply_edit') ?>">
                        <a href="apply.php"><i class="fa fa-hourglass-2 fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->apply; ?></a>
                    </li>
                    <li class="<?php echo checkIfActiveNew('article,article_add,article_edit') ?>">
                        <a href="article.php"><i class="fa fa-newspaper-o fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->article; ?></a>
                    </li>
                    <li class="<?php echo checkIfActiveNew('account'); ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 5px;padding-bottom: 5px;">
                            <img class="img-circle" src="https://q2.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['qq']; ?>&spec=100" height="40" width="40">
                            <?php echo $conf['admin_user'] ?>
                            <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="separator" class="divider"></li>
                            <li class="<?php echo checkIfActiveNew('account'); ?>"><a href="account.php"><i class="fa fa-user-circle fa-fw"></i> 管理员账号</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="<?php echo checkIfActiveNew('settings'); ?>"><a href="settings.php"><i class="fa fa-gear fa-fw fa-spin" aria-hidden="true"></i> <?php echo $lang->admin->settings; ?></a></li>
                            <li class="<?php echo checkIfActiveNew('settings_material'); ?>"><a href="settings_material.php"><i class="glyphicon glyphicon-picture fa-fw" aria-hidden="true"></i> <?php echo $lang->admin->settings_material; ?></a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo $site_http; ?>" target="_blank"><i class="fa fa-home fa-fw"></i> <?php echo $lang->index->home; ?></a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" onclick="return logout();"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> <?php echo $lang->index->logout; ?></a></li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="#" aria-hidden="true"><i id="theme-selector"></i></a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="container-fluid">
<div class="row page-wrapper">
