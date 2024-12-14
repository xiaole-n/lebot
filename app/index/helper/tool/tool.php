<?php

use think\facade\Db;

function le_variable($text,$union_openid) {
    // 定义变量映射表
    $variables = [
        '[系统名称]' => php_uname("s"),
        '[系统版本]' => php_uname("r"),
        '[系统详情]' => php_uname("v"),
        '[机器架构]' => php_uname("m"),
        '[当前时间]' => date('Y-m-d H:i:s', time()),
        '[PHP版本]'  => phpversion(),
        '[系统语言]' => "开发中",
        '[运行时间]' => "开发中",
        '[内存占用]' => "开发中",
        '[磁盘大小]' => round(disk_total_space("/") / 1024 ** 3, 2) . 'G',
        '[磁盘剩余]' => round(disk_free_space('/') / 1024 ** 3, 2) . 'G',
        '[磁盘占用]' => round((disk_total_space('/') - disk_free_space('/')) / 1024 ** 3, 2) . 'G',
        '[CPU占用]' => "开发中",
        '[用户标识]' => $union_openid,
        '[用户积分]' => getPointsByUnionOpenid($union_openid),
        '[用户权限]' => le_Enquirenew('bot_userinfo','union_openid',$union_openid,'permission'),
        '[用户余额]' => getBalanceByUnionOpenid($union_openid),
        '[接收消息]' => getFieldSum('received_messages'),
        '[发送消息]' => getFieldSum('sent_messages'),
        '[用户总数]' => getusersinfoBotRowCount(),
        '[托管账号]' => getUsersBotRowCount(),
    ];

    // 遍历变量映射表，进行替换
    foreach ($variables as $key => $value) {
        $text = str_replace($key, $value, $text);
    }

    return $text;
}
function le_Intentsconvert($intents) {
// 定义一个映射表
    $eventMap = [
        'GROUP_AT_MESSAGE_CREATE' => '群聊消息',
        'C2C_MESSAGE_CREATE' => '私聊消息',
        'AT_MESSAGE_CREATE' => '频道消息',
        'FRIEND_ADD' => '用户添加',
        'FRIEND_DEL' => '用户删除',
        'GROUP_ADD_ROBOT' => '群聊添加',
        'GROUP_DEL_ROBOT' => '群聊移除',
        'DIRECT_MESSAGE_CREATE' => '频道私聊',
    ];

// 检查传入的事件代码是否存在于映射表中
    if (isset($eventMap[$intents])) {
        return $eventMap[$intents];
    }

// 如果没有找到匹配项，则返回原始事件代码
    return $intents;
}

function le_log($type, $union_openid, $group_openid, $content) {
    // 插入新的日志记录
    Db::name('log')->insert([
        'time' => date('Y-m-d H:i:s'),
        'type' => $type,
        'union_openid' => $union_openid,
        'group_openid' => $group_openid,
        'content' => $content
    ]);

    // 检查日志数量是否超过1000条
    $count = Db::name('log')->count();

    if ($count > 1000) {
        try {
            // 使用 JOIN 和 DELETE 一次性删除最早的500条记录
            Db::execute("
            DELETE l1 FROM log l1
            INNER JOIN (
                SELECT id FROM log ORDER BY id ASC LIMIT 500
            ) l2 ON l1.id = l2.id
        ");
        } catch (\think\db\exception\DbException $e) {
            // 记录错误日志
            le_log('系统消息','-', '-', $e->getMessage());
        }
    }
}

function getAppSecretByAppId($appId)
{
    $appSecret = Db::name('users_bot')
        ->where('AppID', $appId)
        ->value('AppSecret');

    return $appSecret;
}

//此函数用于统计消息数量，类型有群聊消息，频道消息，频道私聊。私聊消息，发送消息
function updateBotDau($type) {
    $today = date('Y-m-d');

    // 检查今天的数据行是否存在
    $dauRecord = Db::table('bot_dau')->where('date', $today)->find();

    if (!$dauRecord) {
        // 如果不存在，创建新的数据行
        $dauRecord = [
            'date' => $today,
            'received_messages' => 0,
            'sent_messages' => 0,
            'user_count' => 0,
            'group_count' => 0,
            'usage_frequency' => 0,
            'channel_private_chat' => 0,
            'group_private_chat' => 0
        ];
        Db::table('bot_dau')->insert($dauRecord);
        $dauRecord = Db::table('bot_dau')->where('date', $today)->find();
    }

    // 根据传入的类型更新相应的字段
    switch ($type) {
        case '群聊消息':
            Db::table('bot_dau')->where('id', $dauRecord['id'])->inc('received_messages')->inc('group_count')->update();
            break;
        case '频道消息':
            Db::table('bot_dau')->where('id', $dauRecord['id'])->inc('received_messages')->inc('usage_frequency')->update();
            break;
        case '频道私聊':
            Db::table('bot_dau')->where('id', $dauRecord['id'])->inc('received_messages')->inc('channel_private_chat')->update();
            break;
        case '私聊消息':
            Db::table('bot_dau')->where('id', $dauRecord['id'])->inc('received_messages')->inc('group_private_chat')->update();
            break;
        case '发送消息':
            Db::table('bot_dau')->where('id', $dauRecord['id'])->inc('sent_messages')->update();
            break;
    }
}


//此函数是用于统计dau的，请在收到消息那里调用
function updateBotUserInfo($union_openid) {
    $today = date('Y-m-d');

    // 检查用户是否存在
    $userInfo = Db::table('bot_userinfo')->where('union_openid', $union_openid)->find();

    if ($userInfo) {
        // 如果存在，检查 post_date 是否是今天
        if ($userInfo['post_date'] != $today) {
            // 如果不是今天，更新 post_date
            Db::table('bot_userinfo')->where('id', $userInfo['id'])->update(['post_date' => $today]);

            // 更新 bot_dau 表的 user_count
            $dauRecord = Db::table('bot_dau')->where('date', $today)->find();
            if (!$dauRecord) {
                // 如果今天的数据行不存在，创建新的数据行
                $dauRecord = [
                    'date' => $today,
                    'received_messages' => 0,
                    'sent_messages' => 0,
                    'user_count' => 0,
                    'group_count' => 0,
                    'usage_frequency' => 0,
                    'channel_private_chat' => 0,
                    'group_private_chat' => 0
                ];
                Db::table('bot_dau')->insert($dauRecord);
                $dauRecord = Db::table('bot_dau')->where('date', $today)->find();
            }
            Db::table('bot_dau')->where('id', $dauRecord['id'])->inc('user_count')->update();
        }
    } else {
        // 如果用户不存在，插入新的用户记录
        $newUser = [
            'union_openid' => $union_openid,
            'permission' => 0,
            'post_date' => $today,
            'post_count' => 0
        ];
        Db::table('bot_userinfo')->insert($newUser);

        // 更新 bot_dau 表的 user_count
        $dauRecord = Db::table('bot_dau')->where('date', $today)->find();
        if (!$dauRecord) {
            // 如果今天的数据行不存在，创建新的数据行
            $dauRecord = [
                'date' => $today,
                'received_messages' => 0,
                'sent_messages' => 0,
                'user_count' => 0,
                'group_count' => 0,
                'usage_frequency' => 0,
                'channel_private_chat' => 0,
                'group_private_chat' => 0
            ];
            Db::table('bot_dau')->insert($dauRecord);
            $dauRecord = Db::table('bot_dau')->where('date', $today)->find();
        }
        Db::table('bot_dau')->where('id', $dauRecord['id'])->inc('user_count')->update();
    }
}

function getFieldSum($field) {
    // 查询 bot_dau 表中指定字段的总和
    $sum = Db::table('bot_dau')->sum($field);
    return $sum;
}

function getUsersBotRowCount() {
    // 查询 users_bot 表的行数
    $rowCount = Db::table('users_bot')->count();
    return $rowCount;
}

function getusersinfoBotRowCount() {
    // 查询 bot_usersinfo 表的行数
    return Db::table('bot_userinfo')->count();
}
function le_Permission($text)
{
    // 定义变量映射表
    $variables = [
        '-1' => '封禁用户',
        '0' => '普通用户',
        '1' => '普通管理',
        '2' => '超级管理',
        '3' => '后台管理',
        // 可以继续添加更多变量
    ];

    // 检查$text是否为数组键，并返回对应值或默认信息
    return isset($variables[$text]) ? $variables[$text] : '未知权限';
}


//这里面的查询其实可以修改一下，改为一个通用查询，比传入表名，传入要查的字段，例如下面的

//这个是查询数值是否存在的
function le_Enquire($table, $column, $row) {
    // 查询指定数据库中的某项的某值是否存在
    return Db::name($table)
            ->where($column, '=', $row)
            ->value($column) !== null;
}

//
function le_Enquirenew($table, $column, $row, $newColumn)
{
    /**
     * 数据库查询
     *
     * 本函数用于根据给定条件从数据库中查询特定列的值。
     *
     * @param string $table 数据库表名，指定要查询的数据库表。
     * @param string $column 用来匹配行的列名，即查询条件中的字段。
     * @param mixed $row 匹配列的值，即查询条件中列应等于的值。
     * @param string $newColumn 要查询的列名，即需要获取其值的字段。
     *
     * @return mixed             如果查询成功且找到结果，则返回对应的新列的值；
     *                           如果未找到任何结果，则返回 -1。
     */
    $result = Db::name($table)
        ->where($column, '=', $row)
        ->value($newColumn); // 获取新列的值

    // 如果结果不为null则返回结果，否则返回-1
    return $result !== null ? $result : -1;
}

function le_updateColumn($table, $column, $row, $newColumn, $newValue) {
    /**
     * 数据库更新
     *
     * @param string $table      数据库表名
     * @param string $column     用来匹配行的列名
     * @param mixed  $row        匹配列的值
     * @param string $newColumn  要更新的列名
     * @param mixed  $newValue   新列的值
     *
     * @return int|false         返回受影响的行数，或者在失败时返回 false
     */
    // 执行更新操作
    $result = Db::name($table)
        ->where($column, '=', $row)
        ->update([$newColumn => $newValue]);

    // 检查是否有任何行受到影响
    return $result !== false ? $result : false;
}

/**
 * 根据union_openid获取用户的points
 *
 * @param string $unionOpenid 用户的唯一标识
 * @return mixed 返回用户的points，如果没有找到则返回null
 */
function getPointsByUnionOpenid(string $unionOpenid)
{
    // 使用查询构造器执行查询并直接返回points字段的值
    return db::table('bot_userinfo')
        ->where('union_openid', $unionOpenid)
        ->value('points'); // 只获取单个字段的值
}

/**
 * 根据union_openid获取用户的balance
 *
 * @param string $unionOpenid 用户的唯一标识
 * @return mixed 返回用户的balance，如果没有找到则返回null
 */
function getBalanceByUnionOpenid(string $unionOpenid)
{
    // 使用查询构造器执行查询并直接返回balance字段的值
    return db::table('bot_userinfo')
        ->where('union_openid', $unionOpenid)
        ->value('balance'); // 只获取单个字段的值
}