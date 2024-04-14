<?php
define('IN_ADMIN', true);
include("../includes/common.php");
if ($admin_islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$act = _get('act');
switch ($act) {
    case 'add':
        $nid  = _post('nid');
        $icon = _post('icon');
        $name = _post('name');
        $url  = _post('url');
        if (!$nid) {
            exit("<script>alert('排序号不能为空！');location='./nav.php';</script>");
        }
        if (!$icon) {
            exit("<script>alert('图标不能为空！');location='./nav.php';</script>");
        }
        if (!$name) {
            exit("<script>alert('名称不能为空！');location='./nav.php';</script>");
        }
        if (!$name) {
            exit("<script>alert('名称不能为空！');location='./nav.php';</script>");
        }
        if (!$url) {
            exit("<script>alert('链接不能为空！');location='./nav.php';</script>");
        }
        // 数据
        $_data = array(
            'nid' => $nid,
            'icon' => $icon,
            'name' => $name,
            'url' => $url
        );
        $result = $DB->insert('nav', $_data);
        echo "<script>alert('添加成功！');location='./nav.php';</script>";
        break;
    case 'edit':
        $id  = _post('id');
        $row = $DB->find('nav', '*', array('id' => $id));
        if (!$row) {
            exit("<script>alert('导航菜单不存在！');location='./nav.php';</script>");
        }
        $nid  = _post('nid');
        $icon = _post('icon');
        $name = _post('name');
        $url  = _post('url');
        if (!$nid) {
            exit("<script>alert('排序号不能为空！');location='./nav.php';</script>");
        }
        if (!$icon) {
            exit("<script>alert('图标不能为空！');location='./nav.php';</script>");
        }
        if (!$name) {
            exit("<script>alert('名称不能为空！');location='./nav.php';</script>");
        }
        if (!$name) {
            exit("<script>alert('名称不能为空！');location='./nav.php';</script>");
        }
        if (!$url) {
            exit("<script>alert('链接不能为空！');location='./nav.php';</script>");
        }
        // 更新
        $_data = array(
            'nid' => $nid,
            'icon' => $icon,
            'name' => $name,
            'url' => $url
        );
        $result = $DB->update('nav', $_data, array('id' => $id));
        echo "<script>alert('修改成功！');location='./nav.php';</script>";
        break;
    case 'del':
        @header('Content-Type: application/json; charset=UTF-8');
        $id = _post('id');
        if (!$id) {
            exit('{"code":-1,"msg":"ID不能为空！"}');
        }
        $result = $DB->delete('nav', array('id' => $id));
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
