<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

// 测试专用 使用时请注释掉
Route::get('text', 'text/getToken'); // 测试
Route::get('test', 'index/test'); // 测试

//基本样式
Route::get('layout', 'index/layout');
Route::get('head', 'index/head');

//登录
Route::get('login', 'index/login');
Route::post('handle-login', 'index/handleLogin');//处理登录请求
Route::get('handle-login', 'index/handleLogin'); // 可选，处理用户的手动请求

//账号列表
Route::get('usersbot', 'index/usersbot');//视图
Route::post('usersdelete', 'index/delete');//删除用户
Route::post('updateUser', 'index/updateUser'); // 添加编辑用户的路由
Route::post('addRecord', 'index/addRecord'); // 新增用户的路由

//菜单管理
Route::get('menu', 'index/menu');//视图
Route::post('delete_menu', 'index/deleteMenu');//删除菜单
Route::post('update_menu', 'index/updateMenu'); // 编辑菜单
Route::post('add_menu', 'index/addMenu'); // 新增菜单


//管理账号
Route::get('users', 'index/users');//后台账号修改视图
Route::post('ajax/user/profile', 'index/UserController/profile');// 用户资料和密码修改
Route::post('ajax/user/passWord', 'index/UserController/passWord');

// 处理平台请求
// 处理POST请求，例如来自腾讯的请求
Route::post('post-data', 'index/postData');
Route::get('post-data', 'index/getData');//用户手动请求返回文档

// 日志
Route::get('log', 'index/index/getLatestLogs');

//程序安装
Route::get('install', 'index/viewinstall');
Route::post('dbconfig', 'index/dbconfig');
Route::post('testdbconnection', 'index/testdbconnection');
Route::post('performInstall', 'index/performInstall');

//设置
Route::get('set', 'index/set');

//更新
Route::get('updata', 'index/updata');

//帮助
Route::get('help', 'index/help');