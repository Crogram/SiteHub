<?php
define('IN_ADMIN', true);
include("../includes/common.php");
if ($admin_islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$act = _get('act');
switch ($act) {
    case 'add':
        $name      = _post('name');
        $catename  = _post('catename');
        $introduce = _post('introduce');
        $tui       = _post('tui');
        if (empty($name)) {
            exit("<script>alert('标题不能为空');history.go(-1)</script>");
        }
        if (empty($catename)) {
            exit("<script>alert('分类不能为空');history.go(-1)</script>");
        }
        $result = $DB->insert('article', array(
            'name'       => $name,
            'catename'   => $catename,
            'introduce'  => $introduce,
            'hits_total' => 0,
            'tui'        => $tui,
            'time'       => date("Y-m-d H:i:s"),
        ));
        echo "<script>alert('添加成功！');location='./article.php';</script>";
        break;
    case 'edit':
        $id        = _post('id');
        $name      = _post('name');
        $catename  = _post('catename');
        $introduce = _post('introduce');
        $tui       = _post('tui');
        $time      = date("Y-m-d H:i:s");
        if (empty($id)) {
            exit("<script>alert('ID不能为空');history.go(-1)</script>");
        }
        if (empty($name)) {
            exit("<script>alert('标题不能为空');history.go(-1)</script>");
        }
        if (empty($catename)) {
            exit("<script>alert('分类不能为空');history.go(-1)</script>");
        }
        $result = $DB->update('article', array(
            'name'      => $name,
            'catename'  => $catename,
            'introduce' => $introduce,
            'tui'       => $tui,
            'time'      => date("Y-m-d H:i:s"),
        ), array('id' => $id));
        echo "<script>alert('修改成功！');location='./article.php';</script>";
        break;
    case 'del':
        @header('Content-Type: application/json; charset=UTF-8');
        $id = _post('id');
        if (!$id) {
            exit('{"code":-1,"msg":"id不能为空！"}');
        }
        $result = $DB->delete('article', array('id' => $id));
        if ($result) {
            exit('{"code":0,"msg":"删除成功！"}');
        }
        exit('{"code":-1,"msg":"删除失败！"}');
        break;
    default:
        exit('{"code":-4,"msg":"No Act"}');
        break;
}