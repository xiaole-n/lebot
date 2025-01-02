<?php

namespace app\index\controller;

use app\index\helper\PostRequestHandler;
use think\facade\Db;
use think\facade\Log;
use think\response\View;
use think\Request;
use think\Session;
use think\helper\Str;

include __DIR__ . '/../helper/tool/tool.php';

class Index
{
    //检测是否登录
    protected function checkLogin()
    {
        if (!session('?user_id')) {
            return false;
        }
        return true;
    }

    //检测是否安装
    private function isInstalled(): bool
    {
        // 获取项目根目录路径并拼接 lock.lock 文件路径
        $lockFilePath = app()->getRootPath() . 'lock.lock';

        // 检查 lock.lock 文件是否存在
        return file_exists($lockFilePath);
    }

    //安装
    public function viewinstall(): View
    {
        // 调用 isInstalled 方法检查安装状态
        if ($this->isInstalled()) {
            // 如果文件存在，返回 index 视图
            return view('/index/login/login');
        } else {
            // 如果文件不存在，返回 install 视图
            return view('index/install');
        }
    }

    public function users(): View
    {
        if ($this->checkLogin()) {
            return view('index/users');
        } else {
            return view('index/login/login');
        }
    }

    public function index()
    {
        // 首先检查系统是否已安装
        if (!$this->isInstalled()) {
            // 如果系统未安装，重定向到安装页面
            return redirect('index/install');
        }

        // 检查用户是否已登录
        if ($this->checkLogin()) {
            // 获取数据
            $receivedMessages = getFieldSum('received_messages');
            $sentMessages = getFieldSum('sent_messages');
            $userCount = getusersinfoBotRowCount();
            $accountCount = getUsersBotRowCount();

            // 将数据传递给视图
            return view('index/index', [
                'receivedMessages' => $receivedMessages,
                'sentMessages' => $sentMessages,
                'userCount' => $userCount,
                'accountCount' => $accountCount
            ]);
        } else {
            // 如果用户未登录，显示登录页面
            return view('index/login/login');
        }
    }

    public function test(): View
    {

        return view('index/test');

//        if ($this->checkLogin()) {
//            return view('index/test');
//        } else {
//            return view('index/login/login');
//        }
    }

    public function usersbot(Request $request)
    {
        if ($this->checkLogin()) {
            // 直接从数据库中查询数据
            $usersBotData = Db::name('users_bot')->field('ID, QQ, AppID, Token, AppSecret')->select();
            // 将数据传递给视图
            return view('users_bot', ['usersBotData' => $usersBotData]);
        } else {
            return view('index/login/login');
        }
    }

    public function delete(Request $request)
    {
        $id = $request->post('id'); // 更改获取请求参数的方式
        if ($id) {
            $result = Db::name('users_bot')->where('ID', $id)->delete();
            if ($result) {
                return json(['success' => true]);
            } else {
                return json(['success' => false, 'message' => '删除失败']);
            }
        } else {
            return json(['success' => false, 'message' => '缺少ID参数']);
        }
    }

    public function login(): View
    {
        return view('index/login/login');
    }

    public function layout(): View
    {
        if ($this->checkLogin()) {
            return view('index/layout');
        } else {
            return view('index/login/login');
        }
    }

    public function head(): View
    {
        if ($this->checkLogin()) {
            return view('index/head');
        } else {
            return view('index/login/login');
        }
    }

    public function set(): View
    {
        if ($this->checkLogin()) {
            return view('index/set');
        } else {
            return view('index/login/login');
        }
    }

    public function help(): View
    {
        if ($this->checkLogin()) {
            return view('index/help');
        } else {
            return view('index/login/login');
        }
    }

    public function updata(): View
    {
        if ($this->checkLogin()) {
            return view('index/updata');
        } else {
            return view('index/login/login');
        }
    }
    //登录处理

    public function handleLogin(Request $request)
    {
        // 获取POST数据
        $data = $request->post();

        // 验证数据
        if (!isset($data['username']) || !isset($data['password'])) {
            return json(['code' => 1, 'msg' => '缺少必要的参数']);
        }

        // 查询用户信息
        $user = Db::table('users')
            ->where('username', $data['username'])
            ->find();

        // 使用MD5加密输入的密码并转换为大写形式
        $hashedPassword = strtoupper(md5($data['password']));



        // 检查用户是否存在并且密码匹配
        if ($user && $user['password'] === $hashedPassword) {
            // 登录成功
            session('user_id', $user['id']); // 设置session
            session('user_data', $user); // 存储用户数据到session
            \think\facade\Session::save(); // 确保Session数据被保存
            return json(['code' => 0, 'msg' => '登录成功 - 正在跳转至主页面']);
        } else {
            // 登录失败
            return json(['code' => 1, 'msg' => '登录失败 - 账号或密码错误']);
        }
    }

    // 退出登录
    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session('user_id', null);
        session_unset();
        session_destroy();

        return redirect('/');
    }
    //post处理
    public function postData()
    {
        return PostRequestHandler::handlePostRequest();
    }

    public function getData()
    {
        if ($this->checkLogin()) {
            return view('index/docx');
        } else {
            return view('index/login/login');
        }
    }

    // 新增方法：获取最新的50条日志记录
    public function getLatestLogs(): View
    {
        if (!$this->checkLogin()) {
            return view('index/login/login');
        }

        // 直接从数据库中获取最新的50条日志记录
        $latestLogs = Db::name('log')
            ->order('time', 'desc')
            ->limit(50)
            ->select();

        // 将数据传递给视图
        return view('index/log', ['logs' => $latestLogs]);
    }

    // 更新用户信息
    public function updateUser(Request $request)
    {
        if (!$this->checkLogin()) {
            return json(['code' => 1, 'msg' => '未登录']);
        }

        $data = $request->post();
        if (!isset($data['id']) || !isset($data['data'])) {
            return json(['code' => 1, 'msg' => '缺少必要的参数']);
        }

        // 允许更新的字段列表，根据数据库表结构定义
        $allowedFields = ['QQ', 'AppID', 'Token', 'AppSecret', 'AccessToken', 'AccessToken_time'];

        // 过滤掉不允许更新的字段
        $validData = array_intersect_key($data['data'], array_flip($allowedFields));

        if (empty($validData)) {
            return json(['code' => 1, 'msg' => '没有有效的更新数据']);
        }

        $result = Db::name('users_bot')
            ->where('id', $data['id'])
            ->update($validData);

        if ($result !== false) {
            return json(['code' => 0, 'msg' => '更新成功']);
        } else {
            return json(['code' => 1, 'msg' => '更新失败']);
        }
    }

    // 删除用户信息
    public function deleteUser(Request $request)
    {
        if (!$this->checkLogin()) {
            return json(['code' => 1, 'msg' => '未登录']);
        }

        $id = $request->post('id');
        if (!$id) {
            return json(['code' => 1, 'msg' => '缺少必要的参数']);
        }

        $result = Db::name('users_bot')
            ->where('id', $id)
            ->delete();

        if ($result !== false) {
            return json(['code' => 0, 'msg' => '删除成功']);
        } else {
            return json(['code' => 1, 'msg' => '删除失败']);
        }
    }
    //新增账号
    public function addRecord(Request $request)
    {
        $data = $request->post();

        // 验证数据（省略）

        // 直接使用DB类进行数据库操作
        $result = Db::name('users_bot')->insert($data);

        if ($result) {
            return json(['success' => true, 'message' => '记录已成功添加']);
        } else {
            return json(['success' => false, 'message' => '添加记录失败']);
        }
    }
    //更新数据库配置
    public function dbconfig(Request $request)
    {
        try {
            // 获取前端传递的数据
            $data = $request->post();

            // 检查必要字段是否存在
            if (!isset($data['db_hostname']) || !isset($data['db_hostport']) || !isset($data['db_database']) || !isset($data['db_username']) || !isset($data['db_password'])) {
                return json(['success' => false, 'message' => '请提供所有必要的数据库配置信息！']);
            }

            $config = [
                'default' => 'mysql',
                'connections' => [
                    'mysql' => [
                        'type'       => 'mysql',
                        'hostname'   => $data['db_hostname'],
                        'database'   => $data['db_database'],
                        'username'   => $data['db_username'],
                        'password'   => $data['db_password'],
                        'hostport'   => $data['db_hostport'],
                        'charset'    => 'utf8',
                        'prefix'     => '',
                    ]
                ]
            ];

            // 将配置写入文件
            $filePath = app()->getRuntimePath() . '../../config/database.php';
            file_put_contents($filePath, "<?php\nreturn " . var_export($config, true) . ";");

            // 返回响应给前端
            return json(['success' => true]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return json(['success' => false, 'message' => '保存失败，请检查输入信息是否正确！']);
        }
    }

    public function testDbConnection(Request $request)
    {
        try {
            // 获取前端传递的数据
            $data = $request->post();

            // 检查必要字段是否存在
            if (!isset($data['db_hostname']) || !isset($data['db_hostport']) || !isset($data['db_database']) || !isset($data['db_username']) || !isset($data['db_password'])) {
                return json(['success' => false, 'message' => '请提供所有必要的数据库配置信息！']);
            }

            // 测试数据库连接
            $pdo = new \PDO(
                "mysql:host={$data['db_hostname']};port={$data['db_hostport']};dbname={$data['db_database']};charset=utf8",
                $data['db_username'],
                $data['db_password'],
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );

            // 如果没有抛出异常，说明连接成功
            return json(['success' => true]);

        } catch (\PDOException $e) {
            // 连接失败，返回错误信息
            return json(['success' => false, 'message' => $e->getMessage()]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return json(['success' => false, 'message' => '未知错误，请检查日志！']);
        }
    }

    public function performInstall(Request $request)
    {
        try {
            // 获取前端传递的数据
            $data = $request->post();

            // 检查必要字段是否存在并且密码匹配
            if (!isset($data['admin_name']) || !isset($data['admin_qq']) || !isset($data['admin_email']) ||
                !isset($data['admin_username']) || !isset($data['admin_password']) ||
                !isset($data['admin_password_confirm']) || $data['admin_password'] !== $data['admin_password_confirm']) {
                return json(['success' => false, 'message' => '请提供所有必要的管理员配置信息，并确保两次输入的密码相同！']);
            }

            // 开启事务
            Db::startTrans();

            try {
                // 读取SQL文件内容
                $sqlFilePath = app_path() . 'helper/tool/install.sql';
                if (!file_exists($sqlFilePath)) {
                    throw new \Exception("SQL file not found at: {$sqlFilePath}");
                }

                $sqlContent = file_get_contents($sqlFilePath);
                if ($sqlContent === false) {
                    throw new \Exception("Failed to read the SQL file.");
                }

                // 将SQL内容分割成单个语句
                $sqlStatements = array_filter(array_map('trim', explode(';', $sqlContent)));

                // 执行SQL语句
                foreach ($sqlStatements as $sql) {
                    if (empty($sql)) {
                        continue; // 跳过空语句
                    }
                    try {
                        Db::execute($sql . ';'); // 添加分号确保语句完整
                    } catch (\PDOException $e) {
                        // 如果表已存在，则忽略错误并继续执行
                        if (strpos($e->getMessage(), 'Table already exists') === false) {
                            throw $e; // 重新抛出其他类型的异常
                        }
                    }
                }

                // 使用MD5加密密码
                $hashedPassword = md5($data['admin_password']);
                $hashedPassword = strtoupper($hashedPassword);

                // 插入管理员信息
                Db::table('users')->insert([
                    'username' => $data['admin_username'],
                    'password' => $hashedPassword,
                    'qq' => $data['admin_qq'],
                    'email' => $data['admin_email'],
                    'name' => $data['admin_name']
                ]);

                // 提交事务
                Db::commit();

                // 创建 lock.lock 文件到项目根目录
                $lockFilePath = app()->getRootPath() . 'lock.lock';
                file_put_contents($lockFilePath, 'Installation completed.');

                // 返回成功响应给前端
                return json(['success' => true]);

            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                // 抛出异常或者返回错误信息给前端
                throw $e;
            }

        } catch (\PDOException $e) {
            Log::error($e->getMessage());
            return json(['success' => false, 'message' => '数据库操作失败，请检查日志！']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return json(['success' => false, 'message' => '未知错误，请检查日志！']);
        }
    }
}