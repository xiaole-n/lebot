<?php
namespace app\index\controller;

// 使用相对路径引用 openapi.php
include __DIR__ . '/../helper/API/openapi.php';
include __DIR__ . '/../helper/tool/tool.php';
include __DIR__ . '/../helper/tool/install.php';
include __DIR__ . '/../helper/Messageprocessing.php';

class text
{
    public function getToken()
    {
        $union_openid = '51690C10640588D7830D58026BA236AC';
        $Appid = '102450011';

        echo le_variable(le_directives('运行信息',$union_openid,$Appid),$union_openid);
    }
}