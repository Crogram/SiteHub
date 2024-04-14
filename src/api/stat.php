<?php
require('../includes/common.php');
// 网站统计信息
@header('Content-Type: application/json; charset=UTF-8');
exit(json_encode(array(
    'code' => 0,
    'msg' => '网站统计',
    'data' => array(
        'build_time'       => $conf['build_time'],
        'category'         => $DB->count('category'),
        'site'             => $DB->count('site'),
        'apply'            => $DB->count('apply', array('reject' => 0)),
        'apply_reject'     => $DB->count('apply', array('reject' => 1)),
        'article'          => $DB->count('article'),
        'article_category' => $DB->count('article_category'),
        'notice'           => $DB->count('notice'),
        'link'             => $DB->count('link'),
        'top_hits_day'     => $DB->find('site', 'id, name', array('date' => date("Y-m-d", time())), '`hits_day` desc'),
        'top_hits_month'   => $DB->find('site', 'id, name', array('datem' => date("Y-m", time())), '`hits_month` desc'),
        'top_hits_total'   => $DB->find('site', 'id, name', null, '`hits_total` desc'),
        'top_like'         => $DB->find('site', 'id, name', null, '`like` desc'),
    )
)));
