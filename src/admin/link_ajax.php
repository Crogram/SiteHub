<?php
define('IN_ADMIN', true);
include("../includes/common.php");
if ($admin_islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$act = _get('act');
switch ($act) {
    case 'add':
        $name = _post('name');
        $url = _post('url');
        if (!$name) {
            exit("<script>alert('名称不能为空！');location='./link.php';</script>");
        }
        if (!$url) {
            exit("<script>alert('链接不能为空！');location='./link.php';</script>");
        }
        // 数据
        $_data = array(
            'name' => $name,
            'url' => $url
        );
        $result = $DB->insert('link', $_data);
        echo "<script>alert('添加成功！');location='./link.php';</script>";
        break;
    case 'edit':
        $id = _post('id');
        $row = $DB->find('link', '*', array('id' => $id));
        if (!$row) {
            exit("<script>alert('链接不存在！');location='./link.php';</script>");
        }
        $name = _post('name');
        $url = _post('url');
        if (!$name) {
            exit("<script>alert('名称不能为空！');location='./link.php';</script>");
        }
        if (!$url) {
            exit("<script>alert('链接不能为空！');location='./link.php';</script>");
        }
        // 更新
        $_data = array(
            'name' => $name,
            'url' => $url
        );
        $result = $DB->update('link', $_data, array('id' => $id));
        echo "<script>alert('修改成功！');location='./link.php';</script>";
        break;
    case 'del':
        @header('Content-Type: application/json; charset=UTF-8');
        $id = _post('id');
        if (!$id) {
            exit('{"code":-1,"msg":"ID不能为空！"}');
        }
        $result = $DB->delete('link', array('id' => $id));
        if ($result) {
            exit('{"code":0,"msg":"删除成功！"}');
        }
        exit('{"code":-1,"msg":"删除失败！"}');
        break;
    default:
        @header('Content-Type: application/json; charset=UTF-8');
        exit('{"code":-4,"msg":"No Act"}');
        break;
}
