<?php

function le_sendMessage($appid,$group_openid,$union_openid,$msg_id,$msg,$msg_type,$file_path = null){
    //$group_openid 为空视为发送私聊消息
    //$msg_type 0为普通消息，1为图文，2为视频，3为语音，4为卡片(ark)，5为大图(ark)
    //其实感觉这个意义不大..........
    //主要还方便全局变量和转图转卡等操作

    //全局变量
    $msg = le_variable($msg,$union_openid);
    //很迷惑。为啥没传入$group_openid 的值是-
    if($group_openid == '-'){

        $msg = ltrim($msg);

        if($msg_type == 0){
            sendunionMessage($appid,$union_openid, $msg_id, $msg, 0);
        }

        if($msg_type == 1){
            $media = uploadunionFile($appid,$union_openid,1, $file_path);
            sendunionMessage($appid,$union_openid, $msg_id, $msg, 1, $media);
        }

        if($msg_type == 2){
            $media = uploadunionFile($appid,$union_openid,2, $file_path);
            sendunionMessage($appid,$union_openid, $msg_id, $msg, 1, $media);
        }

        if($msg_type == 3){
            $media = uploadunionFile($appid,$union_openid,3, $file_path);
            sendunionMessage($appid,$union_openid, $msg_id, $msg, 1, $media);
        }

        if($msg_type == 4){
            sendunionMessage($appid,$union_openid, $msg_id, $msg, 3, '卡片外显');
        }

        if($msg_type == 5){
            sendunionMessage($appid,$union_openid, $msg_id, $msg, 4, '大图外显');
        }
    }
    else{

        $msg = "\n".$msg;

        if($msg_type == 0){
            sendGroupMessage($appid, $group_openid, $union_openid, $msg_id, $msg, 0);
        }

        if($msg_type == 1){
            $media = uploadGroupFile($appid, $group_openid,1, $file_path);
            sendGroupMessage($appid, $group_openid, $union_openid, $msg_id, $msg, 1, $media);
        }

        if($msg_type == 2){
            $media = uploadGroupFile($appid, $group_openid,2, $file_path);
            sendGroupMessage($appid, $group_openid, $union_openid, $msg_id, $msg, 1, $media);
        }

        if($msg_type == 3){
            $media = uploadGroupFile($appid, $group_openid,3, $file_path);
            sendGroupMessage($appid, $group_openid, $union_openid, $msg_id, $msg, 1, $media);
        }

        if($msg_type == 4){
            sendGroupMessage($appid, $group_openid, $union_openid, $msg_id, $msg, 3, '卡片外显');
        }

        if($msg_type == 5){
            sendGroupMessage($appid, $group_openid, $union_openid, $msg_id, $msg, 4, '大图外显');
        }
    }

}



function le_menu($appid,$group_openid,$union_openid,$msg_id,$content) {
    //检测指令是否存在，不存在直接返回
    if(le_Enquire('bot_menu','menu',$content) == false){
        return "-1";
    };

    if(le_Enquirenew('bot_menu','menu',$content,'status') == 0){
        return "-2";
    }

    $Permission = le_Enquirenew('bot_menu','menu',$content,'permission');

    if($Permission > le_Enquirenew('bot_userinfo','union_openid',$union_openid,'permission')){
        le_sendMessage($appid,$group_openid,$union_openid,$msg_id,"你没有权限呦！，该指令最低权限要求:".le_Permission($Permission),0);
        return '-3';
    }
    le_sendMessage($appid,$group_openid,$union_openid,$msg_id,le_Enquirenew('bot_menu','menu',$content,'content'),0);

    return true;
}

function le_api($appid,$group_openid,$union_openid,$msg_id,$content){

    //用空格分割指令的参数
    $array = explode(" ", $content);

    //检测接口是否存在，不存在直接返回
    if(le_Enquire('bot_api','command',$array[0]) == false){
        return "-1";
    }

    //判断参数是否齐全
    if(count($array) == le_Enquirenew('bot_api','command',$array[0],'param_count')){
        le_sendMessage($appid,$group_openid,$union_openid,$msg_id,'请确保提交的参数完整！',0);
        return "-5";
    }

    //检测接口是否开启
    if(le_Enquirenew('bot_api','command',$array[0],'status') == 0){
        return "-2";
    }
    //判断用户的权限
    $Permission = le_Enquirenew('bot_api','command',$array[0],'permission');//获取指令的权限

    if($Permission > le_Enquirenew('bot_userinfo','union_openid',$union_openid,'permission')){
        le_sendMessage($appid,$group_openid,$union_openid,$msg_id,"你没有权限呦！，该指令最低权限要求:".le_Permission($Permission),0);
        return '-3';
    }

    //这里已经确保了参数和状态以及权限，直接写即可

    //分为2个情况，get和post，get的话直接拼接url，非媒体直接丢连接过去，文本处理返回
    //post设置默认的json请求头，把提交内容构架成json返回

    $submit_url = le_Enquirenew('bot_api','command',$array[0],'submit_url');
    $submit_data = le_Enquirenew('bot_api','command',$array[0],'submit_data');
    $success_response = le_Enquirenew('bot_api','command',$array[0],'success_response');


    //get的情况，不设置请求头和ck
    if(le_Enquirenew('bot_api','command',$array[0],'permission')==0){
        //这是文本，应该进行json解析
        if(le_Enquirenew('bot_api','command',$array[0],'response_type')==0){

            le_sendMessage($appid,$group_openid,$union_openid,$msg_id,$success_response,0);

        }
        //这是图片，直接把url丢给平台
        if(le_Enquirenew('bot_api','command',$array[0],'response_type')==1){

            le_sendMessage($appid,$group_openid,$union_openid,$msg_id,$success_response,1,$submit_url.$submit_data);

        }
        //这是视频，直接把url丢给平台
        if(le_Enquirenew('bot_api','command',$array[0],'response_type')==2){

            le_sendMessage($appid,$group_openid,$union_openid,$msg_id,$success_response,2,$submit_url.$submit_data);

        }
        //这是语音，直接把url丢给平台
        if(le_Enquirenew('bot_api','command',$array[0],'response_type')==2){

            le_sendMessage($appid,$group_openid,$union_openid,$msg_id,$success_response,3,$submit_url.$submit_data);

        }



    }

    //post的情况，设置请求头和ck
    if(le_Enquirenew('bot_api','command',$array[0],'permission')==1){

    }


    le_Enquirenew('bot_api','command',$array[0],'submit_url');//url

}

function le_directives($appid,$group_openid,$union_openid,$msg_id,$content)
{

    //用空格分割指令的参数
    $array = explode(" ", $content);

    //检测指令是否存在，不存在直接返回
    if (le_Enquire('bot_directives', 'newdirectives', $array[0]) == false) {
        return "-1";
    };

    //把自定义指令替换成系统内置的指令
    $array[0] = le_Enquirenew('bot_directives', 'newdirectives', $array[0], 'directives');

    if (le_Enquirenew('bot_directives', 'directives', $array[0], 'status') == 0) {
        return "-2";
    }

    $Permission = le_Enquirenew('bot_directives', 'directives', $array[0], 'permission');

    if ($Permission > le_Enquirenew('bot_userinfo', 'union_openid', $union_openid, 'permission')) {
        le_sendMessage($appid,$group_openid,$union_openid,$msg_id,"你没有权限呦！，该指令最低权限要求:" . le_Permission($Permission),0);
        return '-3';
    }
    //获取该指令的返回内容
    $return = le_Enquirenew('bot_directives', 'directives', $array[0], 'content');

    if ($array[0] == '开启') {

        le_updateColumn('bot_info', 'appid', $appid, 'status', 0);
    }

    if ($array[0] == '关闭') {

        le_updateColumn('bot_info', 'appid', $appid, 'status', 1);
    }

    if ($array[0] == '兽语转换') {
        //这里应该验证一下成员是否存在
        $return = str_replace("[转换结果]", "1", le_languageconversion($array[1]));
    }

    le_sendMessage($appid,$group_openid,$union_openid,$msg_id,$return,0);

    return true;
}

function le_languageconversion($text) {

    if (containsOnlyWuAndAo($text)) {
        return binaryToString($text);
    } else {
        return stringToBinary($text);
    }
}

function containsOnlyWuAndAo($text) {
    // 正则表达式，确保整个字符串只由 '呜~' 和 '嗷' 组成
    $pattern = '/^(?:呜~|嗷)+$/u';

    // 使用 preg_match 函数来检查字符串是否完全匹配模式
    return (bool)preg_match($pattern, $text);
}


function stringToBinary($string) {
    $binaryString = '';
    for ($i = 0; $i < strlen($string); $i++) {
        // Convert each character to its ASCII value, then to binary, and pad with zeros to ensure 8 bits
        $binaryString .= str_pad(decbin(ord($string[$i])), 8, '0', STR_PAD_LEFT);
    }

    $binaryString = str_replace(['0', '1'], ['嗷', '呜~'], $binaryString);

    return $binaryString;
}
function binaryToString($binaryString) {
    $string = '';
    // Split the binary string into chunks of 8 bits

    $binaryString = str_replace(['嗷', '呜~'],['0', '1'],$binaryString);

    for ($i = 0; $i < strlen($binaryString); $i += 8) {
        // Extract 8 bits, convert from binary to decimal, then to character
        $byte = substr($binaryString, $i, 8);
        $char = chr(bindec($byte));
        $string .= $char;
    }
    return $string;
}

?>