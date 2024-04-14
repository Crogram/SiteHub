<?php
define('IN_ADMIN', true);
include("../includes/common.php");
if (!checkRefererHost()) exit('{"code":403}');

$act = _get('act');
@header('Content-Type: application/json; charset=UTF-8');
switch ($act) {
    case 'form':
        // 添加站点
        $name      = _post('name', '');
        $url       = _post('url', '');
        $catename  = _post('catename', '');
        $keywords  = _post('keywords', '');
        $introduce = _post('introduce', '');

        if (!$url) {
            exit('{"code":-1,"msg":"网站网址不能为空！"}');
        }
        $site_has = $DB->count('site', array('url' => $url));
        if ($site_has) {
            exit('{"code":-1,"msg":"该站点已经存在，请勿重复提交！"}');
        }
        $apply_has = $DB->count('apply', array('url' => $url));
        if ($apply_has) {
            exit('{"code":-1,"msg":"该站点已提交过，请勿重复提交！"}');
        }
        if (!$name) {
            exit('{"code":-1,"msg":"网站名称不能为空！"}');
        }
        if (!$catename) {
            exit('{"code":-1,"msg":"网站分类不能为空！"}');
        }
        if (!$introduce) {
            exit('{"code":-1,"msg":"网站简介不能为空！"}');
        }
        // 插入数据
        $insert_data = array(
            'name'      => $name,
            'catename'  => $catename,
            'url'       => $url,
            'keywords'  => $keywords,
            'introduce' => $introduce,
        );
        $result = $DB->insert('apply', $insert_data);
        if ($result) {
            exit('{"code":0,"msg":"提交成功，请耐心等待审核！"}');
        }
        exit('{"code":-1,"msg":"提交失败，请重试！"}');
        break;
    default:
        exit('{"code":-4,"msg":"No Act"}');
        break;
}
