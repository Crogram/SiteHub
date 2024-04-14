<?php
define('IN_ADMIN', true);
include("../includes/common.php");
if ($admin_islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$act = _get('act');
switch ($act) {
    case 'reject':
        @header('Content-Type: application/json; charset=UTF-8');
        $id = _post('id');
        if (!$id) {
            exit('{"code":-1,"msg":"id不能为空！"}');
        }
        $result = $DB->update('apply', array('reject' => '1'), array('id' => $id));
        if ($result) {
            exit('{"code":0,"msg":"拒绝申请，放进黑名单成功！"}');
        }
        exit('{"code":-1,"msg":"拒绝申请失败！"}');
        break;
    case 'reset':
        @header('Content-Type: application/json; charset=UTF-8');
        $id = _post('id');
        if (!$id) {
            exit('{"code":-1,"msg":"id不能为空！"}');
        }
        $result = $DB->update('apply', array('reject' => '0'), array('id' => $id));
        if ($result) {
            exit('{"code":0,"msg":"恢复审核申请成功！"}');
        }
        exit('{"code":-1,"msg":"恢复审核申请失败！"}');
        break;
    case 'del':
        @header('Content-Type: application/json; charset=UTF-8');
        $id = _post('id');
        if (!$id) {
            exit('{"code":-1,"msg":"id不能为空！"}');
        }
        $result = $DB->delete('apply', array('id' => $id));
        if ($result) {
            exit('{"code":0,"msg":"删除成功！"}');
        }
        exit('{"code":-1,"msg":"删除失败！"}');
        break;
    default:
        exit('{"code":-4,"msg":"No Act"}');
        break;
}
