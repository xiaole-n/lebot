<?php /*a:1:{s:56:"D:\Desktop\x\php\lebot\app\index\view\index\install.html";i:1733113546;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Lebot-程序安装</title>
    <meta content="<?php echo config('web.description'); ?>" name="description">
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="/static/css/codebase.min-5.0.css" id="css-main" rel="stylesheet">
    <style>
        #environment-warning {
            margin: 40px;
        }
    </style>
</head>
<body>
<div id="environment-warning" class="main-content-boxed">
    <div class="container mt-5">
        <h1 class="h3 fw-bold mt-5 mb-2">欢迎来到LeBot安装界面</h1>
        <h2 class="fs-base fw-medium text-muted mb-0">让我们开始吧，这只需要几秒钟的时间</h2>
        <br>
    </div>

    <div id="installation-steps">
        <?php
        require_once app_path() . 'helper/tool/install.php';
        // 执行环境检查
        $environmentChecks = getEnvironmentChecks();
        ?>
        <div id="step1" class="step active">
            <div class="block block-rounded block-fx-shadow">
                <div class="block-content">
                    <h2 class="content-heading pt-3">环境检测</h2>
                    <ul class="list-group push">
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-semibold">
                            PHP >= 8.0.0
                            <?php echo $environmentChecks['checks']['php']['badge']; ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-semibold">
                            MySQL >= 5.6.0
                            <?php echo $environmentChecks['checks']['mysql']['badge']; ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-semibold">
                            sodium扩展加载
                            <?php echo $environmentChecks['checks']['sodium']['badge']; ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-semibold">
                            SSL环境
                            <?php echo $environmentChecks['checks']['ssl']['badge']; ?>
                        </li>
                    </ul>
                </div>
                <div class="block-content">
                    <div class="row mb-4">
                        <div class="col-lg-6 offset-lg-5">
                            <button type="button" class="btn btn-primary mb-2" onclick="showStep(2);"<?php echo !$environmentChecks['allChecksPass'] ? ' disabled' : ''; ?>>
                            <i class="fa fa-arrow-right opacity-50 me-1"></i>下一步
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 其余HTML代码... -->
        <div id="step2" class="step" style="display:none;">
            <form class="js-validation-installation" onsubmit="return false;" id="install-form-step2">
                <div class="block block-rounded block-fx-shadow">
                    <div class="block-content">
                        <h2 class="content-heading pt-3">数据库配置</h2>
                        <div class="row items-push">
                            <div class="col-lg-4">
                                <p class="text-muted">请正确填写数据库各项配置信息，以确保程序能够成功安装。</p>
                            </div>
                            <div class="col-lg-6 offset-lg-1">
                                <div class="mb-4">
                                    <label class="form-label" for="install-db-hostname">数据库地址</label>
                                    <input type="text" class="form-control form-control-lg" id="install-db-hostname" name="install-db-hostname" placeholder="请输入您的数据库地址" value="127.0.0.1">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="install-db-hostport">数据库端口</label>
                                    <input type="text" class="form-control form-control-lg" id="install-db-hostport" name="install-db-hostport" placeholder="请输入您的数据库端口" value="3306">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="install-db-database">数据库名称</label>
                                    <input type="text" class="form-control form-control-lg" id="install-db-database" name="install-db-database" placeholder="请输入您的数据库名称">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="install-db-username">数据库用户名</label>
                                    <input type="text" class="form-control form-control-lg" id="install-db-username" name="install-db-username" placeholder="请输入您的数据库用户名">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="install-db-password">数据库密码</label>
                                    <input type="password" class="form-control form-control-lg" id="install-db-password" name="install-db-password" placeholder="请输入您的数据库密码">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-lg-6 offset-lg-5">
                                <button type="button" class="btn btn-secondary mb-2" onclick="showStep(1);">
                                    <i class="fa fa-arrow-left opacity-50 me-1"></i>上一步
                                </button>
                                <button type="button" class="btn btn-primary mb-2" onclick="submitForm()">
                                    <i class="fa fa-arrow-right opacity-50 me-1"></i>下一步
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- step3.html -->
        <div id="step3" class="step" style="display:none;">
            <form class="js-validation-installation" onsubmit="return false;" id="install-form-step3">
                <div class="block block-rounded block-fx-shadow">
                    <div class="block-content">
                        <h2 class="content-heading pt-3">管理员账号配置</h2>
                        <div class="row items-push">
                            <div class="col-lg-4">
                                <p class="text-muted">请输入你的联系QQ、邮箱、昵称和账号密码来创建管理员账户。</p>
                            </div>
                            <div class="col-lg-6 offset-lg-1">
                                <div class="mb-4">
                                    <label class="form-label" for="install-admin-name">昵称</label>
                                    <input type="text" class="form-control form-control-lg" id="install-admin-name" name="install-admin-name" placeholder="请输入您的昵称" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="install-admin-qq">联系QQ</label>
                                    <input type="number" class="form-control form-control-lg" id="install-admin-qq" name="install-admin-qq" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="install-admin-email">联系邮箱</label>
                                    <input type="email" class="form-control form-control-lg" id="install-admin-email" name="install-admin-email" placeholder="请输入您的联系邮箱" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="install-admin-username">用户名</label>
                                    <input type="text" class="form-control form-control-lg" id="install-admin-username" name="install-admin-username" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="install-admin-password">密码</label>
                                    <input type="password" class="form-control form-control-lg" id="install-admin-password" name="install-admin-password" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="install-admin-password-confirm">确认密码</label>
                                    <input type="password" class="form-control form-control-lg" id="install-admin-password-confirm" name="install-admin-password-confirm" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-lg-6 offset-lg-5">
                                <button type="button" class="btn btn-secondary mb-2" onclick="showStep(2);">
                                    <i class="fa fa-arrow-left opacity-50 me-1"></i>上一步
                                </button>
                                <button type="button" class="btn btn-primary mb-2" onclick="install();">
                                    <i class="fa fa-arrow-right opacity-50 me-1"></i>安装
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- 加载指示器 -->
            <div id="loading" style="display:none;text-align:center;margin-top:20px;">
                <img src="path/to/loading.gif" alt="Loading..." />
                <p>正在安装中，请稍候...</p>
            </div>
        </div>
    </div>
</div>
<script src="/static/js/codebase.app.min-5.0.js"></script>
<script src="/static/js/lib/jquery.min.js"></script>
<script src="/static/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="/static/js/app.min.js"></script>
<script src="/static/js/layer.js"></script>
<script>
    function showStep(step) {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step' + step).style.display = 'block';
    }

    function install() {
        // 显示加载指示器
        $('#loading').show();

        // 收集表单数据
        var formData = {
            admin_name: $('#install-admin-name').val(),
            admin_qq: $('#install-admin-qq').val(),
            admin_email: $('#install-admin-email').val(),
            admin_username: $('#install-admin-username').val(),
            admin_password: $('#install-admin-password').val(),
            admin_password_confirm: $('#install-admin-password-confirm').val()
        };

        // 简单的前端验证
        if (formData.admin_password !== formData.admin_password_confirm) {
            alert('两次输入的密码不匹配，请重新输入！');
            $('#loading').hide();
            return;
        }

        // 发送AJAX请求
        $.ajax({
            url: 'performInstall', // 后端处理的URL
            type: 'POST',
            data: formData,
            timeout: 30000, // 设置30秒超时
            success: function(response) {
                $('#loading').hide();
                if (response.success) {
                    alert('安装成功！');
                    // showStep(4); // 或者跳转到安装完成页面
                    window.location.replace('/index/login/login');
                } else {
                    alert('安装失败：' + response.message);
                }
            },
            error: function(xhr, status, error) {
                $('#loading').hide();
                if (status === 'timeout') {
                    alert('请求超时，请检查网络连接或稍后再试。');
                } else {
                    alert('请求出错，请稍后再试！' + error);
                }
            }
        });
    }

    function submitForm() {
        var formData = {
            db_hostname: $('#install-db-hostname').val(),
            db_hostport: $('#install-db-hostport').val(),
            db_database: $('#install-db-database').val(),
            db_username: $('#install-db-username').val(),
            db_password: $('#install-db-password').val()
        };

        $.ajax({
            url: 'testdbconnection', // 新增的测试数据库连接的URL
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // 数据库连接成功，保存配置并跳转到下一步
                    saveConfig();
                } else {
                    // 数据库连接失败，显示错误信息并停留在当前页面
                    alert('数据库连接失败，请检查您的配置：' + response.message);
                }
            },
            error: function() {
                alert('请求出错，请稍后再试！');
            }
        });
    }

    function saveConfig() {
        $.ajax({
            url: 'dbconfig', // 后端处理的URL
            type: 'POST',
            data: {
                db_hostname: $('#install-db-hostname').val(),
                db_hostport: $('#install-db-hostport').val(),
                db_database: $('#install-db-database').val(),
                db_username: $('#install-db-username').val(),
                db_password: $('#install-db-password').val()
            },
            success: function(response) {
                if (response.success) {
                    showStep(3); // 跳转到下一步
                } else {
                    alert('保存失败，请检查输入信息是否正确！');
                }
            },
            error: function() {
                alert('请求出错，请稍后再试！');
            }
        });
    }
</script>
</body>
</html>