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
        $text = "春临大地万物苏，柳绿桃红映日初。\r\n燕舞晴空风细细，蝶戏花丛香徐徐。\r\n\r\n夏来炎日炽如炉，荷叶田田水满湖。\r\n蝉鸣高树声不断，蛙鼓池塘夜未孤。\r\n\r\n秋霜染尽千山色，枫叶流丹映夕阳。\r\n稻谷金黄丰收喜，雁阵南归人字长。\r\n\r\n冬雪纷飞天地白，梅枝傲雪独自开。\r\n寒鸦栖树添寂静，冰河封冻待春回。\r\n\r\n岁月悠悠似水流，人间万事几春秋。\r\n富贵荣华终成梦，淡泊名利乐无忧。\r\n\r\n晨钟暮鼓醒尘世，朝起夕落见真知。\r\n心怀宽广容天地，笑看风云任去留。\r\n\r\n山川湖海未足过，岁月静好共此时。\r\n但愿此生长康健，与君携手赏四时。";
        $imagePath = text_to_image_promax($text, "D:\Desktop\arial.ttf", 25);
        // 输出图像路径
        echo $imagePath;
    }
}