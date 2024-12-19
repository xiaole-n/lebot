<?php

namespace app\index\helper;

include __DIR__ . '/../helper/API/openapi.php';
//include __DIR__ . '/../helper/tool/tool.php';
include __DIR__ . '/Messageprocessing.php';

require_once 'tool/signature.php'; // 引入签名函数所在文件

class PostRequestHandler
{
    public static function handlePostRequest()
    {
        // 检查请求方法是否为 POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // 方法不允许
            header('Content-Type: application/json');
            echo json_encode(['error' => '大笨蛋! 要用Post请求!!!']);
            exit();
        }

        // 获取所有HTTP头信息
        $headers = getallheaders();

        // 从请求头获取需要的信息
        $Appid = isset($headers['X-Bot-Appid']) ? $headers['X-Bot-Appid'] : null; // 从请求头获取机器人的Appid
        $Signature = isset($headers['X-Signature-Ed25519']) ? $headers['X-Signature-Ed25519'] : null; // 从请求头获取签名
        $Timestamp = isset($headers['X-Signature-Timestamp']) ? $headers['X-Signature-Timestamp'] : null; // 从请求头获取签名时间戳

        // 获取POST请求的数据
        $postData = file_get_contents('php://input');

        // 解析 POST 数据（假设它是一个 JSON 对象）
        $jsonData = json_decode($postData, true);
        if ($jsonData === null) {
            die("Invalid JSON data.");
        }

        $op = isset($jsonData['op']) ? $jsonData['op'] : null;
        $t = isset($jsonData['t']) ? $jsonData['t'] : null; // 类型
        $union_openid = isset($jsonData['d']['author']['union_openid']) ? $jsonData['d']['author']['union_openid'] : null; // 用户ID
        $group_openid = isset($jsonData['d']['group_openid']) ? $jsonData['d']['group_openid'] : null; // 群ID
        $content = isset($jsonData['d']['content']) ? $jsonData['d']['content'] : null; // 内容
        $msg_id = isset($jsonData['d']['id']) ? $jsonData['d']['id'] : null; // 消息ID

        $t = le_Intentsconvert($t); // 让我们说中文

        if ($op == '13') { // 回调验证签名
            $group_openid = '-';
            $union_openid = $Appid;
            $t = '回调验证';
            $content = isset($jsonData['d']['plain_token']) ? $jsonData['d']['plain_token'] : null;
        }

        if ($group_openid == '') {
            $group_openid = '-';
        }

        le_log($t, $union_openid, $group_openid, $content); // 调用日志记录函数记录收到的消息

        if ($op == '13') { // 配置回调地址后，开放平台会对回调地址进行验证
            // 定义常量
            $golangbody = '{"plain_token": "[plain_token]","signature": "[signature]"}'; // 签名包

            $botSecret = getAppSecretByAppId($Appid); // 发放平台的secret
            $plainToken = isset($jsonData['d']['plain_token']) ? $jsonData['d']['plain_token'] : null; // 代签名的信息
            $eventTs = isset($jsonData['d']['event_ts']) ? $jsonData['d']['event_ts'] : null; // 签名时间戳

            // 调用签名函数生成签名
            if (function_exists('generateSignature')) {
                $signature = generateSignature($botSecret, $plainToken, $eventTs); // 签名函数

                $golangbody = str_replace('[plain_token]', $plainToken, $golangbody);
                $golangbody = str_replace('[signature]', $signature, $golangbody);

                echo $golangbody;
                exit();
            } else {
                die("Function generateSignature is not defined.");
            }
        }

        //消息处理
        if ($op == '0') {

            echo json_encode(["code" => 200, "msg" => "大笨蛋，收到啦！", "time" => date('Y-m-d H:i:s')]);
            //这里一直有一个问题，就是会被重复推送消息，开放平台收不到消息就会重新推送，可是这里给了回复还是重复推送！

            if ($Signature != generateSignature(getAppSecretByAppId($Appid), $postData, $Timestamp)) {
                le_log($t, $union_openid, $group_openid, "签名验证失败，消息疑似被串改-->" . $content);
                echo json_encode(["code" => 403, "msg" => "大笨蛋，你消息被篡改啦！", "time" => date('Y-m-d H:i:s')]);
                exit;
            }

            updateBotDau($t);//统计接收消息
            updateBotUserInfo($union_openid);//统计用户数量/DAU

            $content = ltrim($content);//去除指令前面的空格！
            //检测机器人是否开启并且跳过开启的指令
            if(le_Enquirenew('bot_directives', 'newdirectives', $content, 'directives') !== '开启'){

                if(le_Enquire('bot_info','appid',$Appid)){

                    if(le_Enquirenew('bot_info','appid',$Appid,'status') == 1){
                        exit;
                    }
                }
            }

            if ($t == '群聊消息' || '私聊消息') {

                if($content=='a'){
                    sendGroupMessage($Appid, $group_openid, $union_openid, $msg_id, '文本测试', 0);
                }

                if($content=='b'){
                    $file = uploadGroupFile($Appid, $group_openid, '1', 'https://api.lolimi.cn/API/boy/api.php');
                    sendGroupMessage($Appid, $group_openid, $union_openid, $msg_id, '图片测试', 1,$file);
                }

                if($content=='c'){
                    le_sendMessage($Appid,$group_openid,$union_openid,$msg_id,'视频测试',2,'https://api.lolimi.cn/API/xjj/xjj.php');
//                    $file = uploadGroupFile($Appid, $group_openid, '2', 'https://api.lolimi.cn/API/xjj/xjj.php');
//                    sendGroupMessage($Appid, $group_openid, $union_openid, $msg_id, '视频测试', 1,$file);
                }

                if($content=='d'){
                    $file = uploadGroupFile($Appid, $group_openid, '3', 'https://thinkphp.xiaole.work/test/语音.mp3');
                    sendGroupMessage($Appid, $group_openid, $union_openid, $msg_id, '语音测试', 1,$file);
                }

                if($content=='e'){
                    $file = uploadGroupFile($Appid, $group_openid, '3', 'https://thinkphp.xiaole.work/test/1.silk');
                    sendGroupMessage($Appid, $group_openid, $union_openid, $msg_id, '语言编码测试', 1,$file);
                }

                le_directives($Appid,$group_openid,$union_openid,$msg_id,$content);//指令处理函数

                le_menu($Appid,$group_openid,$union_openid,$msg_id,$content);//菜单处理函数

                le_api($Appid,$group_openid,$union_openid,$msg_id,$content);//接口处理函数
            }

            echo json_encode(["code" => 200, "msg" => "大笨蛋，收到啦！", "time" => date('Y-m-d H:i:s')]);
        };
    }

}