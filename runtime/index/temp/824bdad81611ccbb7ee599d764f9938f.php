<?php /*a:1:{s:54:"D:\Desktop\x\php\ThinkPHP\app\index\view\index\cs.html";i:1731390183;}*/ ?>
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\db\exception\DbException;

public function testDbConnection()
{
try {
$result = \think\Db::name('user')->find(1); // 直接查询user表中id为1的数据
echo "数据库连接成功！";
dump($result);
} catch (DataNotFoundException | ModelNotFoundException | DbException $e) {
echo "数据库连接失败：" . $e->getMessage();
}
}