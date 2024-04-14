<?php
define('IN_ADMIN', true);
include("../includes/common.php");
if ($admin_islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$act = _get('act');
switch ($act) {
    case 'add':
        $content = _post('content');
        if (!$content) {
            exit("<script>alert('内容不能为空！');location='./notice.php';</script>");
        }
        $result = $DB->insert('notice', array('content' => $content));
        echo "<script>alert('添加成功！');location='./notice.php';</script>";
        break;
    case 'edit':
        $id = _post('id');
        $row = $DB->find('notice', '*', array('id' => $id));
        if (!$row) {
            exit("<script>alert('分类不存在！');location='./notice.php';</script>");
        }
        $content = _post('content');
        // 更新分类信息
        $update_data = array(
            'id' => $id,
            'content' => $content
        );
        $result = $DB->update('notice', $update_data, array('id' => $id));
        echo "<script>alert('修改成功！');location='./notice.php';</script>";
        break;
    case 'del':
        @header('Content-Type: application/json; charset=UTF-8');
        $id = _post('id');
        if (!$id) {
            exit('{"code":-1,"msg":"ID不能为空！"}');
        }
        $result = $DB->delete('notice', array('id' => $id));
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
