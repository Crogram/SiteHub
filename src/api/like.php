<?php

require('../includes/common.php');

$id = _post('id');
@header('Content-Type: application/json; charset=UTF-8');
// if (!checkRefererHost()) exit('{"code":403}');
if (empty($id)) {
    exit(json_encode(array('code' => -1, 'msg' => '缺失ID')));
}
// 获取点赞者IP
$ip = get_real_ip();

// 获取点赞记录
$count = $DB->count('like', array('site_id' => $id, 'like_ip' => $ip));
// 如果没有记录
if ($count == 0) {
    // 更新点赞数量
    // $sql = "UPDATE `pre_site` SET `like`=`like`+1 WHERE `id`='$id'";
    // $DB->exec($sql);
    $DB->update('site', '`like`=`like`+1', array('id' => $id));
    // 记录点赞id以及ip
    $DB->insert('like', array('site_id' => $id, 'like_ip' => $ip));
    // 获取当前点赞数量
    $row = $DB->find('site', '`like`', array('id' => $id));
    exit(json_encode(array('code' => 0, 'data' => $row['like'], 'msg' => '点赞成功')));
} else {
    exit(json_encode(array('code' => -1, 'msg' => '已经赞过了')));
}
