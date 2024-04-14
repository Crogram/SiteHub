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
        $count_article_category = $DB->count('article_category', array('catename' => $catename));
        if ($count_article_category) {
            exit("<script>alert('分类名不可重复');history.go(-1)</script>");
        }
        if ($alias) {
            $count_alias = $DB->count('article_category', array('alias' => $alias));
            if ($count_alias) {
                exit("<script>alert('别名不可重复！');history.go(-1)</script>");
            }
        }
        $result = $DB->insert('article_category', array(
            'sid'      => $sid,
            'icon'     => $icon,
            'catename' => $catename,
            'alias'    => $alias
        ));
        echo "<script>alert('添加成功！');location='./article_category.php';</script>";
        break;
    case 'edit':
        $id       = _post('id');
        $sid      = _post('sid');
        $icon     = _post('icon');
        $catename = _post('catename');
        $alias    = _post('alias');
        $row      = $DB->find('article_category', '*', array('id' => $id));
        if (!$row) {
            exit("<script>alert('分类不存在！');location='./article_category.php';</script>");
        }
        if ($alias) {
            $count_alias = $DB->count('article_category', "`alias`='$alias' AND `id`<>$id");
            if ($count_alias) {
                exit("<script>alert('别名不可重复！');history.go(-1)</script>");
            }
        }
        // 更新分类信息
        $update_data = array(
            'sid'      => $sid,
            'icon'     => $icon,
            'catename' => $catename,
            'alias'    => $alias
        );
        $result = $DB->update('article_category', $update_data, array('id' => $id));
        if ($row['catename'] != $catename) {
            // 分类名称有变更：更新文章表中的分类名
            $result = $DB->update('article', array('catename' => $catename), array('catename' => $row['catename']));
        }
        echo "<script>alert('修改成功！');location='./article_category.php';</script>";
        break;
    case 'del':
        @header('Content-Type: application/json; charset=UTF-8');
        $id = _post('id');
        if (!$id) {
            exit('{"code":-1,"msg":"ID不能为空！"}');
        }
        $row = $DB->count('article_category', array('id' => $id));
        if (!$row) {
            exit('{"code":-1,"msg":"分类不存在！"}');
        }
        $result = $DB->delete('article_category', array('id' => $id));
        if ($result) {
            exit('{"code":0,"msg":"删除成功！"}');
        }
        exit('{"code":-1,"msg":"分类不存在！"}');
        break;
    default:
        @header('Content-Type: application/json; charset=UTF-8');
        exit('{"code":-4,"msg":"No Act"}');
        break;
}
