<?php
define('IN_ADMIN', true);
include("../includes/common.php");
if ($admin_islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$act = _get('act');
switch ($act) {
    case 'add':
        // 添加站点
        $lid       = _post('lid');
        $tui       = _post('tui');
        $star      = _post('star');
        $name      = _post('name');
        $img       = _post('img');
        $catename  = _post('catename');
        $url       = _post('url');
        $alias     = _post('alias', '');
        $keywords  = _post('keywords', '');
        $introduce = _post('introduce', '');
        $time      = date("Y-m-d H:i:s");
        $date      = date("Y-m-d");
        $datem     = date("Y-m");
        if ($alias) {
            $count_alias = $DB->count('site', array('alias' => $alias));
            if ($count_alias) {
                exit("<script>alert('别名不可重复！');history.go(-1)</script>");
            }
        }
        $count_url = $DB->count('site', array('url' => $url));
        if ($count_url) {
            exit("<script>alert('该站点已存在！');history.go(-1)</script>");
        }
        // 插入数据
        $insert_data = array(
            'lid'       => $lid,
            'tui'       => $tui,
            'star'      => $star,
            'name'      => $name,
            'img'       => $img,
            'catename'  => $catename,
            'url'       => $url,
            'alias'     => $alias,
            'keywords'  => $keywords,
            'introduce' => $introduce,
            'time'      => $time,
            'date'      => $date,
            'datem'     => $datem,
        );
        // print_r($insert_data);exit;
        $result = $DB->insert('site', $insert_data);
        if ($result) {
            // 删除申请记录
            $apply_id = _post('apply_id');
            if ($apply_id) {
                $DB->delete('apply', array('id' => $apply_id));
            }
            exit("<script>alert('添加成功！');location='./site.php';</script>");
        }
        exit("<script>alert('添加失败！');history.go(-1)</script>");
        break;
    case 'edit':
        $id        = _post('id');
        $lid       = _post('lid');
        $tui       = _post('tui');
        $star      = _post('star');
        $name      = _post('name');
        $img       = _post('img');
        $catename  = _post('catename');
        $url       = _post('url');
        $alias     = _post('alias', '');
        $keywords  = _post('keywords', '');
        $introduce = _post('introduce', '');
        $time      = date("Y-m-d H:i:s");

        if ($alias) {
            $count_alias = $DB->count('site', "`alias`='$alias' AND `id`<>$id");
            if ($count_alias) {
                exit("<script>alert('别名不可重复！');history.go(-1)</script>");
            }
        }
        $count_url = $DB->count('site', "`url`='$url' AND `id`<>$id");
        if ($count_url) {
            exit("<script>alert('该站点已存在！');history.go(-1)</script>");
        }
        // 更新数据
        $result = $DB->update('site', array(
            'lid'       => $lid,
            'tui'       => $tui,
            'star'      => $star,
            'name'      => $name,
            'img'       => $img,
            'catename'  => $catename,
            'url'       => $url,
            'alias'     => $alias,
            'keywords'  => $keywords,
            'introduce' => $introduce,
            'time'      => $time
        ), array('id' => $id));
        echo "<script>alert('修改成功！');location='./site.php';</script>";
        break;
    case 'del':
        @header('Content-Type: application/json; charset=UTF-8');
        $id = _post('id');
        if (!$id) {
            exit('{"code":-1,"msg":"ID不能为空！"}');
        }
        $result = $DB->delete('site', array('id' => $id));
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
