<?php 
define('IN_ADMIN', true);
include("../includes/common.php");
if ($admin_islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
@header('Content-Type: application/json; charset=UTF-8');
$act = _get('act');
switch ($act) {
    case 'stat':
        $result = array(
            "code" => 0,
            "count" => array(
                // 'nav'              => $DB->count('nav'),
                'category'         => $DB->count('category'),
                'site'             => $DB->count('site'),
                'apply'            => $DB->count('apply', 'reject=0'),
                'apply_reject'     => $DB->count('apply', 'reject=1'),
                'article'          => $DB->count('article'),
                'article_category' => $DB->count('article_category'),
                'notice'           => $DB->count('notice'),
                'link'             => $DB->count('link'),
            )
        );
        exit(json_encode($result));
        break;
    case 'cleanlogin':
        $lastday = date("Y-m-d", strtotime("-1 day")) . ' 00:00:00';
        $tokens = $DB->delete('order', "`create_time` < '$lastday'");
        $DB->exec("OPTIMIZE TABLE `pre_order`");
        exit('{"code":0,"msg":"删除成功！"}');
        break;
    case 'settings':
        // 修改配置
        if (empty($_POST)) exit('{"code":-4,"msg":"操作有误"}');
        try {
            foreach ($_POST as $k => $v) {
                if (in_array($k, array('script_header', 'script_footer'))) {
                    saveSetting($k, trim($v));
                } else {
                    saveSetting($k, trim(htmlspecialchars($v)));
                }
            }
            exit('{"code":0,"msg":"保存成功"}');
        } catch (\Throwable $th) {
            exit('{"code":-1,"msg":"保存失败"}');
        }
        break;
    case 'settings_material':
        $type = _post('type');
        // 检查文件类型、大小和扩展名
        $allowed_extensions = ['jpg', 'png', 'gif', 'ico', 'jpeg']; // 允许上传的图像文件扩展名列表
        $file_name = $_FILES['file']['name']; // 获取上传文件的名称
        $file_temp = $_FILES['file']['tmp_name']; // 获取上传文件的临时路径
        $file_info = pathinfo($file_name); // 获取文件信息
        $file_type = $file_info['extension']; // 获取文件的扩展名
        if (!in_array($file_type, $allowed_extensions)) {
            exit('{"code":-1,"msg":"只允许上传图像文件"}');
        }

        if (is_uploaded_file($file_temp)) {
            // $fileupname =  mkdir("../assets/images");
            if (move_uploaded_file($file_temp, ROOT . $type)) {
                exit('{"code":0,"msg":"保存成功"}');
            } else {
                exit('{"code":-1,"msg":"上传失败！请检查「img」目录权限是否为777！"}');
            }
        } else {
            exit('{"code":-1,"msg":"请选择图片！"}');
        }
        break;
    case 'account':
        // 修改账号和密码
        if (empty($_POST)) exit('{"code":-4,"msg":"操作有误"}');
        $admin_user = _post('admin_user', '');
        $admin_pwd  = _post('admin_pwd', '');
        $newpwd     = _post('newpwd', '');
        $newpwd2    = _post('newpwd2', '');

        if (empty($admin_user)) exit('{"code":-1,"msg":"管理员账号不能为空！"}');
        if (empty($admin_pwd)) exit('{"code":-1,"msg":"请输入当前管理员密码！"}');
        if ($conf['admin_pwd'] != $admin_pwd) exit('{"code":-1,"msg":"您输入的密码不正确！"}');

        // 修改用户名
        saveSetting('admin_user', $admin_user);
        // 全不为空时，设置新密码
        if (!empty($newpwd) && !empty($newpwd2)) {
            // 修改密码
            if (strlen($newpwd) < 6) exit('{"code":-1,"msg":"密码长度不能低于6个字符串！"}');
            if ($newpwd != $newpwd2) exit('{"code":-1,"msg":"两次新密码输入不一致"}');
            saveSetting('admin_pwd', $newpwd2);
            $session = md5($admin_user . $newpwd2 . $password_hash);
        } else {
            $session = md5($admin_user . $admin_pwd . $password_hash);
        }
        $expiretime = time() + 2592000;
        $token = authcode("{$admin_user}\t{$session}\t{$expiretime}", 'ENCODE', SYS_KEY);
        setcookie("admin_token", $token, $expiretime);
        exit('{"code":0,"msg":"保存成功"}');
        break;
    case 'iptype':
        $result = [
            ['name' => '0_X_FORWARDED_FOR', 'ip' => real_ip(0), 'city' => get_ip_city(real_ip(0))],
            ['name' => '1_X_REAL_IP', 'ip' => real_ip(1), 'city' => get_ip_city(real_ip(1))],
            ['name' => '2_REMOTE_ADDR', 'ip' => real_ip(2), 'city' => get_ip_city(real_ip(2))]
        ];
        exit(json_encode($result));
        break;
    case 'userList':
        $sql = " 1=1";
        $type_arr = ['qq' => 'QQ', 'wx' => '微信'];
        if (isset($_POST['dstatus']) && $_POST['dstatus'] > -1) {
            $dstatus = intval($_POST['dstatus']);
            $sql .= " AND `enable`={$dstatus}";
        }
        if (isset($_POST['kw']) && !empty($_POST['kw'])) {
            $type = intval($_POST['type']);
            $kw = trim(daddslashes($_POST['kw']));
            if ($type == 1) {
                $sql .= " AND `uid`='{$kw}'";
            } elseif ($type == 2) {
                $sql .= " AND `openid`='{$kw}'";
            } elseif ($type == 3) {
                $sql .= " AND `nickname` LIKE '%{$kw}%'";
            } elseif ($type == 4) {
                $sql .= " AND `loginip`='{$kw}'";
            }
        }
        $offset = intval($_POST['offset']);
        $limit = intval($_POST['limit']);
        $total = $DB->getColumn("SELECT count(*) from pre_user WHERE{$sql}");
        $list = $DB->getAll("SELECT * FROM pre_user WHERE{$sql} order by uid desc limit $offset,$limit");
        $list2 = [];
        foreach ($list as $row) {
            $row['type'] = $type_arr[$row['type']];
            $list2[] = $row;
        }

        exit(json_encode(['total' => $total, 'rows' => $list2]));
        break;
    case 'setUserEnable':
        $uid = intval($_POST['uid']);
        $enable = intval($_POST['enable']);
        $sql = "UPDATE pre_user SET enable='$enable' WHERE uid='$uid'";
        if ($DB->exec($sql) !== false) exit('{"code":0,"msg":"修改用户成功！"}');
        else exit('{"code":-1,"msg":"修改用户失败[' . $DB->error() . ']"}');
        break;
    case 'saveUserInfo':
        $uid = intval($_POST['uid']);
        $level = intval($_POST['level']);
        $sql = "UPDATE pre_user SET level='$level' WHERE uid='$uid'";
        if ($DB->exec($sql) !== false) exit('{"code":0,"msg":"修改用户成功！"}');
        else exit('{"code":-1,"msg":"修改用户失败[' . $DB->error() . ']"}');
        break;
    case 'delUser':
        $uid = intval($_POST['uid']);
        $row = $DB->getRow("select * from pre_user where uid='$uid' limit 1");
        if (!$row)
            exit('{"code":-1,"msg":"当前用户不存在！"}');
        $sql = "DELETE FROM pre_user WHERE uid='$uid'";
        if ($DB->exec($sql)) exit('{"code":0,"msg":"删除文件成功！"}');
        else exit('{"code":-1,"msg":"删除文件失败[' . $DB->error() . ']"}');
        break;
    case 'logout':
        setcookie("admin_token", "", time() - 604800);
        exit('{"code":0,"msg":"您已成功注销本次登陆！"}');
    default:
        exit('{"code":-4,"msg":"No Act"}');
        break;
}
