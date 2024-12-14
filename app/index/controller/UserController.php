<?php

namespace app\index\controller;

use think\facade\Db;
use think\Request;
use think\Session;

class UserController
{
    // 更新个人资料
    public function profile(Request $request)
    {
        if (!session('?user_id')) {
            return json(['code' => 0, 'message' => '未登录']);
        }

        $data = $request->post();
        $userId = session('user_id');

        // 验证数据
        if (empty($data['username']) || empty($data['nickname']) || empty($data['qq']) || empty($data['mail'])) {
            return json(['code' => 0, 'message' => '缺少必要参数']);
        }

        // 检查用户名是否已被使用
        $existingUser = Db::table('users')
            ->where('username', $data['username'])
            ->where('id', '<>', $userId) // 排除当前用户自己
            ->find();

        if ($existingUser) {
            return json(['code' => 0, 'message' => '该用户名已被使用']);
        }

        // 更新用户信息
        $result = Db::table('users')
            ->where('id', $userId)
            ->update([
                'username' => $data['username'], // 添加这一行以更新用户名
                'name' => $data['nickname'],
                'qq' => $data['qq'],
                'email' => $data['mail']
            ]);

        if ($result) {
            // 更新会话中的用户数据
            $user = Db::table('users')->where('id', $userId)->find();
            session('user_data', $user);

            return json(['code' => 1, 'message' => '个人资料更新成功']);
        } else {
            return json(['code' => 0, 'message' => '个人资料更新失败']);
        }
    }

    // 修改密码
    public function passWord(Request $request)
    {
        if (!session('?user_id')) {
            return json(['code' => 0, 'message' => '未登录']);
        }

        $data = $request->post();
        $userId = session('user_id');

        // 验证数据
        if (empty($data['outpass']) || empty($data['password']) || empty($data['repass'])) {
            return json(['code' => 0, 'message' => '缺少必要参数']);
        }

        if ($data['password'] !== $data['repass']) {
            return json(['code' => 0, 'message' => '两次新密码输入不一致']);
        }

        // 查询用户信息
        $user = Db::table('users')
            ->where('id', $userId)
            ->find();

        // 将当前密码和新密码转换为大写形式的MD5哈希值
        $currentPasswordHash = strtoupper(md5($data['outpass']));
        $newPasswordHash = strtoupper(md5($data['password']));

        if (!$user || $user['password'] !== $currentPasswordHash) {
            return json(['code' => 0, 'message' => '当前密码错误']);
        }

        // 更新密码
        $result = Db::table('users')
            ->where('id', $userId)
            ->update(['password' => $newPasswordHash]);

        if ($result) {
            return json(['code' => 1, 'message' => '密码修改成功']);
        } else {
            return json(['code' => 0, 'message' => '密码修改失败']);
        }
    }
}