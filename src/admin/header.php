<?php
if ($admin_islogin != 1) {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <title><?php echo $title; ?> - <?php echo $lang->admin->title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,maximum-scale=1.0" />
    <link rel="shortcut icon" href="../favicon.ico" />
    <link rel="stylesheet" href="<?php echo $site_cdnpublic; ?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $site_cdnpublic; ?>font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="<?php echo $site_cdnpublic; ?>admin-lte/2.4.2/css/AdminLTE.min.css"> -->
    <!-- <link rel="stylesheet" href="<?php echo $site_cdnpublic; ?>admin-lte/2.4.2/css/skins/_all-skins.min.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css" />
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
