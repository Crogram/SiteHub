<?php
if (!defined('IN_CRONLITE')) return;
$row_nav = $DB->findAll('nav', '*', '', 'nid asc');
?>

<header class="header">
    <div class="container">
        <div class="nav-bar"><span></span></div>
        <a class="logo" href="<?php echo $site_url; ?>">
            <img src="assets/images/logo.png" class="logo-main" alt="<?php echo $conf['title']; ?>">
            <img src="assets/images/logo_fixed.png" class="logo-fixed" alt="<?php echo $conf['title']; ?>">
        </a>
        <ul class="nav">
<?php foreach ($row_nav as $row) { ?>
            <li><a href="<?php echo $row['url']; ?>"><i class="fa <?php echo $row['icon']; ?>" aria-hidden="true"></i> <span><?php echo $row['name']; ?></span></a></li>
<?php } ?>
        </ul>
    </div>
</header>
