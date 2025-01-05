-- 删除表,防止错误
DROP TABLE IF EXISTS users_bot;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS log;
DROP TABLE IF EXISTS bot_dau;
DROP TABLE IF EXISTS bot_userinfo;
DROP TABLE IF EXISTS bot_menu;
DROP TABLE IF EXISTS bot_directives;
DROP TABLE IF EXISTS bot_api;
DROP TABLE IF EXISTS bot_info;

-- 创建用户机器人表
CREATE TABLE IF NOT EXISTS users_bot (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    QQ VARCHAR(255) NOT NULL,               --  QQ号
    AppID VARCHAR(255) NOT NULL,            -- AppID
    Token VARCHAR(255) NOT NULL,            -- Token（令牌）
    AppSecret VARCHAR(255) NOT NULL,        -- AppSecret（密钥）
    AccessToken VARCHAR(255) DEFAULT NULL,  -- 鉴权凭证
    AccessToken_time BIGINT DEFAULT NULL    -- 鉴权凭证有效期时间戳（秒级）
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建管理员表
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,                    -- 账号
    password VARCHAR(255) NOT NULL,                           -- 密码
    qq VARCHAR(20) DEFAULT NULL,                              -- QQ，用于显示头像
    email VARCHAR(100) DEFAULT NULL,                          -- 邮箱，后续估计会出邮箱找回密码的功能，也许会出
    name VARCHAR(100) DEFAULT NULL,                           -- 昵称
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP   -- 注册时间（或许改为登录时间更好）
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建日志表
CREATE TABLE IF NOT EXISTS log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    time DATETIME NOT NULL,                  -- 时间
    type VARCHAR(50) NOT NULL,               -- 类型
    union_openid VARCHAR(255) NOT NULL,      -- union_openid
    group_openid VARCHAR(255) DEFAULT NULL,  -- group_openid
    content TEXT NOT NULL                    -- 内容
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建机器人每日活跃数据表
CREATE TABLE IF NOT EXISTS bot_dau (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,                     -- 日期
    received_messages INT DEFAULT 0,        -- 接收的消息数量
    sent_messages INT DEFAULT 0,            -- 发送的消息数量
    user_count INT DEFAULT 0,               -- 用户数量
    group_count INT DEFAULT 0,              -- 使用群数
    usage_frequency INT DEFAULT 0,          -- 使用人数
    channel_private_chat INT DEFAULT 0,     -- 忘记了
    group_private_chat INT DEFAULT 0        -- 忘记了
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
    directives varchar(255) NOT NULL,        -- 原指令，固定不可修改
    newdirectives varchar(255) DEFAULT NULL, -- 新指令，触发指令，可修改
    content text,                            -- 回复内容
    permission int(11) NOT NULL DEFAULT 0,   -- 权限级别，默认为0
    status tinyint(4) NOT NULL DEFAULT 1     -- 状态，1表示启用，0表示禁用，默认启用
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
    appid varchar(255) NOT NULL,             -- appid
    status tinyint(4) DEFAULT '0',           -- 状态，0表示启用，1+365表示禁用，默认启用
    send_mode int(11) DEFAULT 0,          -- 发送模式，0为文本，1为图片，2为卡片，3为大图
    message_signature tinyint(4) DEFAULT '0' -- 忘记了
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 数据

-- 菜单
INSERT INTO `bot_menu` (`id`, `menu`, `content`, `permission`, `status`) VALUES (NULL, '菜单', '功能菜单\r\n-------------\r\n运行信息\r\n我的信息\r\n主人功能\r\n-------------\r\nPs:开发中', '0', '1');
INSERT INTO `bot_menu` (`id`, `menu`, `content`, `permission`, `status`) VALUES (NULL, '主人功能', '主人功能\r\n-------------\r\n开启\r\n关闭\r\n切换文字\r\n切换图片\r\n-------------\r\nPs:仅管理员可用', '3', '1');
-- 指令
INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '运行信息', '运行信息', '运行信息\r\n-----------\r\n账号信息\r\n----\r\n接收消息：[接收消息]\r\n发送消息：[发送消息]\r\n用户总数：[用户总数]\r\n托管账号：[托管账号]\r\n----\r\n系统信息\r\n----\r\n系统名称：[系统名称]\r\n系统版本：[系统版本]\r\n系统详情：[系统详情]\r\n机器架构：[机器架构]\r\nPHP版本: [PHP版本]\r\n系统语言: [系统语言]\r\n运行时间: [运行时间]\r\n内存占用: [内存占用]\r\n磁盘大小: [磁盘大小]\r\n磁盘剩余: [磁盘剩余]\r\n磁盘占用: [磁盘占用]\r\nCPU占用: [CPU占用]\r\n----\r\n当前时间：[当前时间]', '0', '1');
INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '我的信息', '我的信息', '个人信息\r\n-------------\r\n用户标识：[用户标识]\r\n用户权限：[用户权限]\r\n用户积分：[用户积分]\r\n用户余额：[用户余额]\r\n-------------\r\nPs:你的信息', '0', '1');
INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '开启', '开启', '开启成功！', '3', '1');
INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '关闭', '关闭', '关闭成功！', '3', '1');
INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '兽语转换', '兽语转换', '[转换结果]', '0', '1');

INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '切换文字', '切换文字', '切换成功！', '3', '1');
INSERT INTO `bot_directives` (`id`, `directives`, `newdirectives`, `content`, `permission`, `status`) VALUES (NULL, '切换图片', '切换图片', '切换成功！', '3', '1');
-- 接口
