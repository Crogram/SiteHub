<?php
if ($admin_islogin != 1) {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <title><?php echo $title; ?> - <?php echo $lang->admin->title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,maximum-scale=1.0">
    <link rel="shortcut icon" href="../favicon.ico" />
    <link href="<?php echo $site_cdnpublic; ?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo $site_cdnpublic; ?>fontawesome/4.7.0/css/fontawesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css" />
</head>

<body>

