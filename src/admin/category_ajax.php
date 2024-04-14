<?php
define('IN_ADMIN', true);
include("../includes/common.php");
if ($admin_islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$act = _get('act');
switch ($act) {
    case 'add':
        $sid      = _post('sid');
        $icon     = _post('icon');
        $catename = _post('catename');
        $alias    = _post('alias');

        if (!$sid) {
            exit("<script>alert('sid 不能为空！');location='./category.php';</script>");
        }
        if (!$icon) {
            exit("<script>alert('icon 不能为空！');location='./category.php';</script>");
        }
        if (!$catename) {
            exit("<script>alert('分类名称不能为空！');location='./category.php';</script>");
        }
        $count_category = $DB->count('category', array('catename' => $catename));
        if ($count_category) {
            exit("<script>alert('分类名不可重复');history.go(-1)</script>");
        }
        if ($alias) {
            $count_alias = $DB->count('category', array('alias' => $alias));
            if ($count_alias) {
                exit("<script>alert('别名不可重复！');history.go(-1)</script>");
            }
        }
        $result = $DB->insert('category', array(
            'sid'      => $sid,
            'icon'     => $icon,
            'catename' => $catename,
            'alias'    => $alias
        ));
        echo "<script>alert('添加成功！');location='./category.php';</script>";
        break;
    case 'edit':
        $id  = _post('id');
        $row = $DB->find('category', '*', array('id' => $id));
        if (!$row) {
            exit("<script>alert('分类不存在！');location='./category.php';</script>");
        }
        $sid      = _post('sid');
        $icon     = _post('icon');
        $catename = _post('catename');
        $alias    = _post('alias');

        if (!$sid) {
            exit("<script>alert('sid 不能为空！');location='./category.php';</script>");
        }
        if (!$icon) {
            exit("<script>alert('icon 不能为空！');location='./category.php';</script>");
        }
        if (!$catename) {
            exit("<script>alert('分类名称不能为空！');location='./category.php';</script>");
        }
        $count_category = $DB->count('category', "`catename`='$catename' AND `id`<>$id");
        if ($count_category) {
            exit("<script>alert('分类名不可重复');history.go(-1)</script>");
        }
        if ($alias) {
            $count_alias = $DB->count('category', "`alias`='$alias' AND `id`<>$id");
            if ($count_alias) {
                exit("<script>alert('别名不可重复！');history.go(-1)</script>");
            }
        }
        // 更新
        $_data = array(
            'sid'      => $sid,
            'icon'     => $icon,
            'catename' => $catename,
            'alias'    => $alias
        );
        $result = $DB->update('category', $_data, array('id' => $id));
        echo "<script>alert('修改成功！');location='./category.php';</script>";
        break;
    case 'del':
        @header('Content-Type: application/json; charset=UTF-8');
        $id = _post('id');
        if (!$id) {
            exit('{"code":-1,"msg":"id不能为空！"}');
        }
        $result = $DB->delete('category', array('id' => $id));
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
