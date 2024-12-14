<?php

return [
// session name
'name'           => 'PHPSESSID',
// SESSION_ID的提交变量,解决flash上传跨域
'var_session_id' => '',
// 驱动方式 支持file cache
'type'           => 'file',
// 存储连接标识 当type使用cache的时候有效
'store'          => null,
// 过期时间
'expire'         => 1440,
// 前缀
'prefix'         => 'lebot_',
// 存储路径
'path'           => sys_get_temp_dir() // 使用临时目录，保证所有系统都可以使用(感觉应该写到项目文件的临时目录，不过能用就好啦)
];