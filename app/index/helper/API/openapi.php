<?php
use think\facade\Db; // 引入ThinkPHP框架的Db类
function getAccessToken($AppID) {
    // 从数据库中获取对应的记录
    $record = Db::name('users_bot')->where('AppID', $AppID)->find();

    if (!$record) {
        return '未找到AppID对应的记录';
    }

    // 获取当前时间戳
    $currentTime = time();

    // 判断是否需要更新AccessToken
    if ($currentTime < $record['AccessToken_time'] - 30) {
        // 如果有效，直接返回已有的AccessToken
        return $record['AccessToken'];
    } else {
        // 构建请求数据
        $data = [
            'appId' => $AppID,
            'clientSecret' => $record['AppSecret']
        ];

        // 将数组转换为JSON格式
        $jsonData = json_encode($data);

        // 初始化cURL会话
        $ch = curl_init();

        // 设置cURL选项
        curl_setopt($ch, CURLOPT_URL, "https://bots.qq.com/app/getAppAccessToken");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // 忽略SSL证书验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // 执行cURL请求
        $response = curl_exec($ch);

        // 检查是否有错误发生
        if (curl_errno($ch)) {
            $errorMessage = 'Curl错误: ' . curl_error($ch);
            curl_close($ch);
            return $errorMessage;
        }

        // 关闭cURL资源，并释放系统资源
        curl_close($ch);

        // 解析API返回的数据
        $responseData = json_decode($response, true);

        if (isset($responseData['access_token'])) {
            // 更新数据库中的AccessToken和过期时间戳
            $newAccessToken = $responseData['access_token'];
            $newExpiresIn = $responseData['expires_in'];
            $newAccessTokenTime = $currentTime + $newExpiresIn - 30; // 减去30秒的安全缓冲

            Db::name('users_bot')
                ->where('AppID', $AppID)
                ->update([
                    'AccessToken' => $newAccessToken,
                    'AccessToken_time' => $newAccessTokenTime
                ]);

            return $newAccessToken;
        } else {
            return '从API获取访问令牌失败';
        }
    }
}

function le_groups_files($appid, $openid, $type, $path)
{
    // 获取access_token
    $access_token = getAccessToken($appid);

    // 构建请求URL
    $url = "https://api.sgroup.qq.com/api/v2/users/{$openid}/files";

    // 初始化JSON对象
    $data = array(
        'file_type' => intval($type),
        'srv_send_msg' => false,
    );

    // 根据文件类型处理文件路径
    if (strpos($path, 'http') === 0) {
        // 如果是URL，则直接设置
        $data['url'] = $path;
    } else {
        // 否则，读取文件并转换为Base64编码
        if (file_exists($path)) {
            $file_content = file_get_contents($path);
            $data['file_data'] = base64_encode($file_content);
        } else {
            return array('error' => '文件不存在');
        }
    }

    // 设置HTTP头信息
    $headers = array(
        'Content-Type: application/json',
        'Authorization: QQBot ' . $access_token,
    );

    // 初始化cURL会话
    $ch = curl_init();

    // 设置cURL选项
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // 忽略SSL证书验证
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    // 执行cURL会话
    $response = curl_exec($ch);

    // 检查是否有错误发生
    if (curl_errno($ch)) {
        return array('error' => '请求失败：' . curl_error($ch));
    }

    // 关闭cURL会话
    curl_close($ch);

    // 解析响应
    $result = json_decode($response, true);

    // 返回文件信息或错误信息
    if (isset($result['file_info'])) {
        return $result['file_info'];
    } else {
        return $result; // 直接返回API返回的所有数据
    }
}

function sendGroupMessage($Appid, $group_openid, $union_openid, $msg_id, $msg, $msg_type, $media = null) {

    updateBotDau("发送消息");

    static $seq = 0;
    $seq++;

    if ($msg_type == "1") {
        $msg_type = "7"; // 将类型1的消息改为类型7
    }

    $json = new stdClass();
    if (!in_array($msg_type, ["2","3","4"])) { // 如果不是特殊类型，则为普通文本
        $json->content = $msg;
    }

    $json->msg_type = (int)$msg_type;
    $json->msg_id = $msg_id;
    $json->msg_seq = $seq;

    if ($msg_type == "2") { // markdown
        // 这里假设markdown处理逻辑已经存在
    } elseif ($msg_type == "3") { // 卡片
        $json->ark = [
            "template_id" => 23,
            "kv" => [
                ["key" => "#DESC#", "value" => "descaaaaaa"],
                ["key" => "#PROMPT#", "value" => $media],
                ["key" => "#LIST#", "obj" => [["obj_kv" => [["key" => "desc", "value" => $msg]]]]]
            ]
        ];
    } elseif ($msg_type == "4") { // 大图
        $json->ark = [
            "template_id" => 37,
            "kv" => [
                ["key" => "#PROMPT#", "value" => $media],
                ["key" => "#METACOVER#", "value" => $msg]
            ]
        ];
        $json->msg_type = 3; // 都是ark，所以都是3
    } elseif ($msg_type == "7") {
        // 直接构造 media 数组
        $json->media = ["file_info" => $media];
    }

    $url = "https://api.sgroup.qq.com/v2/groups/" . $group_openid . "/messages";

    $headers = [
        "Content-Type: application/json",
        "Authorization: QQBot " . getAccessToken($Appid),
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    $responseData = json_decode($response, true);

    deleteFile(networkPathToLocalPath($msg));// 删除网络图片

    if (empty($responseData['id'])) {
        le_log('群聊发送', $union_openid, $group_openid, '发送失败-->' . $responseData['message']);
    } else {
        le_log('群聊发送', $union_openid, $group_openid, '发送成功-->' . $responseData['id']);
    }

    return $response;
}

function sendunionMessage($Appid,$union_openid, $msg_id, $msg, $msg_type, $media = null) {

    updateBotDau("发送消息");

    static $seq = 0;
    $seq++;

    if ($msg_type == "1") {
        $msg_type = "7"; // 将类型1的消息改为类型7
    }

    $json = new stdClass();
    if (!in_array($msg_type, ["2","3","4"])) { // 如果不是特殊类型，则为普通文本
        $json->content = $msg;
    }

    $json->msg_type = (int)$msg_type;
    $json->msg_id = $msg_id;
    $json->msg_seq = $seq;

    if ($msg_type == "2") { // markdown
        // 这里假设markdown处理逻辑已经存在
    } elseif ($msg_type == "3") { // 卡片
        $json->ark = [
            "template_id" => 23,
            "kv" => [
                ["key" => "#DESC#", "value" => "descaaaaaa"],
                ["key" => "#PROMPT#", "value" => $media],
                ["key" => "#LIST#", "obj" => [["obj_kv" => [["key" => "desc", "value" => $msg]]]]]
            ]
        ];
    } elseif ($msg_type == "4") { // 大图
        $json->ark = [
            "template_id" => 37,
            "kv" => [
                ["key" => "#PROMPT#", "value" => $media],
                ["key" => "#METACOVER#", "value" => $msg]
            ]
        ];
        $json->msg_type = 3; // 都是ark，所以都是3
    } elseif ($msg_type == "7") {
        // 直接构造 media 数组
        $json->media = ["file_info" => $media];
    }

    $url = "https://api.sgroup.qq.com/v2/users/" . $union_openid . "/messages";

    $headers = [
        "Content-Type: application/json",
        "Authorization: QQBot " . getAccessToken($Appid),
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    $responseData = json_decode($response, true);

    deleteFile(networkPathToLocalPath($msg));// 删除网络图片

    if (empty($responseData['id'])) {
        le_log('私聊发送', $union_openid, '-', '发送失败-->' . $responseData['message']);
    } else {
        le_log('私聊发送', $union_openid, '-', '发送成功-->' . $responseData['id']);
    }

    return $response;
}

function uploadGroupFile($Appid, $group_openid, $file_type, $file_path)
{
    // 如果是语音文件，先转换为SILK格式
    if ($file_type == '3') {
        $file_path = encodeMP3ToSilk($file_path); // 假设有这个函数
    }

    // 初始化JSON文档
    $json = new stdClass();

    // 判断文件路径是否为URL
    if (strpos($file_path, 'http') !== false) {
        $json->url = $file_path;
    } else {
        $file_data = base64_encode(file_get_contents($file_path));
        $json->file_data = $file_data;
    }

    $json->file_type = (int)$file_type;
    $json->srv_send_msg = false;

    // 构建API URL
    $api_url = "https://api.sgroup.qq.com/v2/groups/" . urlencode($group_openid) . "/files";

    // 设置HTTP头
    $headers = [
        "Content-Type: application/json",
        "Authorization: QQBot " . getAccessToken($Appid)
    ];

    // 将JSON对象转换为字符串
    $json_string = json_encode($json);

    // 使用cURL发送POST请求
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 忽略SSL证书验证（仅用于测试环境）

    // 执行请求并获取响应
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    // 解析返回的JSON数据
    $result = json_decode($response, true);

    // 返回文件信息

    return isset($result['file_info']) ? $result['file_info'] : null;
}

function uploadunionFile($Appid, $union_openid, $file_type, $file_path)
{
    // 如果是语音文件，先转换为SILK格式
    if ($file_type == '3') {
        $file_path = encodeMP3ToSilk($file_path); // 假设有这个函数
    }

    // 初始化JSON文档
    $json = new stdClass();

    // 判断文件路径是否为URL
    if (strpos($file_path, 'http') !== false) {
        $json->url = $file_path;
    } else {
        $file_data = base64_encode(file_get_contents($file_path));
        $json->file_data = $file_data;
    }

    $json->file_type = (int)$file_type;
    $json->srv_send_msg = false;

    // 构建API URL
    $api_url = "https://api.sgroup.qq.com/v2/users/" . urlencode($union_openid) . "/files";

    // 设置HTTP头
    $headers = [
        "Content-Type: application/json",
        "Authorization: QQBot " . getAccessToken($Appid)
    ];

    // 将JSON对象转换为字符串
    $json_string = json_encode($json);

    // 使用cURL发送POST请求
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 忽略SSL证书验证（仅用于测试环境）

    // 执行请求并获取响应
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    // 解析返回的JSON数据
    $result = json_decode($response, true);

    // 返回文件信息

    return isset($result['file_info']) ? $result['file_info'] : null;
}

// 假设的函数，用于编码MP3到SILK格式
function encodeMP3ToSilk($mp3FilePath)
{
    // 这里应该实现从MP3到SILK的转换逻辑
    // 例如，调用FFmpeg或其他工具进行转换
    // 返回转换后的SILK文件路径
    return $mp3FilePath; // 临时返回原路径，实际应替换为转换后的路径
}
