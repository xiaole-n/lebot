-- 删除表,防止错误
DROP TABLE IF EXISTS users_bot;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS log;
DROP TABLE IF EXISTS bot_dau;
DROP TABLE IF EXISTS bot_userinfo;
DROP TABLE IF EXISTS bot_menu;
DROP TABLE IF EXISTS bot_directives;
DROP TABLE IF EXISTS bot_api;

-- 创建用户机器人表
CREATE TABLE IF NOT EXISTS users_bot (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    QQ VARCHAR(255) NOT NULL,
    AppID VARCHAR(255) NOT NULL,
    Token VARCHAR(255) NOT NULL,
    AppSecret VARCHAR(255) NOT NULL,
    AccessToken VARCHAR(255) DEFAULT NULL,
    AccessToken_time BIGINT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建用户表
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    qq VARCHAR(20) DEFAULT NULL,
    email VARCHAR(100) DEFAULT NULL,
    name VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建日志表
CREATE TABLE IF NOT EXISTS log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    time DATETIME NOT NULL,
    type VARCHAR(50) NOT NULL,
    union_openid VARCHAR(255) NOT NULL,
    group_openid VARCHAR(255) DEFAULT NULL,
    content TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建机器人每日活跃数据表
CREATE TABLE IF NOT EXISTS bot_dau (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    received_messages INT DEFAULT 0,
    sent_messages INT DEFAULT 0,
    user_count INT DEFAULT 0,
    group_count INT DEFAULT 0,
    usage_frequency INT DEFAULT 0,
    channel_private_chat INT DEFAULT 0,
    group_private_chat INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建机器人用户信息表
CREATE TABLE IF NOT EXISTS bot_userinfo (
    id INT NOT NULL AUTO_INCREMENT,
    union_openid VARCHAR(255) NOT NULL,   -- 用户ID
    permission INT DEFAULT NULL,          -- 用户权限，默认为0（普通用户）
    points INT DEFAULT 0,                 -- 用户积分
    balance DECIMAL(10, 2) DEFAULT 0.00,  -- 用户余额
    sign_in_date DATE DEFAULT NULL,       -- 签到日期
    post_date DATE NOT NULL,              -- 发言日期
    post_count INT DEFAULT 0,             -- 发言数量
    PRIMARY KEY (id),
    UNIQUE KEY unique_union_openid (union_openid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建机器人菜单表
CREATE TABLE IF NOT EXISTS bot_menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    menu VARCHAR(255) NOT NULL,        -- 菜单名称或标题
    content TEXT NOT NULL,             -- 菜单内容或描述
    permission INT DEFAULT 0,          -- 权限级别，默认为0（普通用户）
    status TINYINT(1) DEFAULT 1        -- 状态，1表示启用，0表示禁用，默认启用
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建指令表
CREATE TABLE `bot_directives` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    directives varchar(255) NOT NULL,
    newdirectives varchar(255) DEFAULT NULL,
    content text,
    permission int(11) NOT NULL DEFAULT 0,
    status tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建接口表
CREATE TABLE bot_api(
    id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
    command VARCHAR(255) NOT NULL COMMENT '触发指令',
    submit_url VARCHAR(255) NOT NULL COMMENT '提交地址',
    submit_data TEXT NOT NULL COMMENT '提交数据',
    submit_headers TEXT COMMENT '提交协议头',
    submit_cookies TEXT COMMENT '提交Cookies',
    success_response VARCHAR(255) NOT NULL COMMENT '成功回复',
    failure_response VARCHAR(255) NOT NULL COMMENT '失败回复',
    submit_method int(11) NOT NULL DEFAULT 0 COMMENT '提交方式',
    response_type int(11) NOT NULL DEFAULT 0 COMMENT '回复类型',
    points_deducted INT(11) NOT NULL DEFAULT 0 COMMENT '扣除积分',
    param_count INT(11) NOT NULL DEFAULT 0 COMMENT '参数个数',
    permission int(11) NOT NULL DEFAULT 0,
    status tinyint(4) NOT NULL DEFAULT 1,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建机器人信息表
CREATE TABLE bot_info (
    id int(11) NOT NULL,
    appid varchar(255) NOT NULL,
    status tinyint(4) DEFAULT '0',
    send_mode int(11) DEFAULT NULL,
    message_signature tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 数据

-- 菜单
INSERT INTO `bot_menu` (`id`, `menu`, `content`, `permission`, `status`) VALUES (NULL, '菜单', '功能菜单\r\n-------------\r\n运行信息\r\n我的信息\r\n-------------\r\nPs:开发中', '0', '1');

-- 指令
INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '运行信息', '运行信息', '运行信息\r\n-----------\r\n账号信息\r\n----\r\n接收消息：[接收消息]\r\n发送消息：[发送消息]\r\n用户总数：[用户总数]\r\n托管账号：[托管账号]\r\n----\r\n系统信息\r\n----\r\n系统名称：[系统名称]\r\n系统版本：[系统版本]\r\n系统详情：[系统详情]\r\n机器架构：[机器架构]\r\nPHP版本: [PHP版本]\r\n系统语言: [系统语言]\r\n运行时间: [运行时间]\r\n内存占用: [内存占用]\r\n磁盘大小: [磁盘大小]\r\n磁盘剩余: [磁盘剩余]\r\n磁盘占用: [磁盘占用]\r\nCPU占用: [CPU占用]\r\n----\r\n当前时间：[当前时间]', '0', '1');
INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '我的信息', '我的信息', '个人信息\r\n-------------\r\n用户标识：[用户标识]\r\n用户权限：[用户权限]\r\n用户积分：[用户积分]\r\n用户余额：[用户余额]\r\n-------------\r\nPs:你的信息', '0', '1');
INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '开启', '开启', '开启成功！', '3', '1');
INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '关闭', '关闭', '关闭成功！', '3', '1');
INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '兽语转换', '兽语转换', '[转换结果]', '0', '1');
-- 接口
