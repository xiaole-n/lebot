<?php /*a:3:{s:57:"D:\Desktop\x\php\ThinkPHP\app\index\view\index\users.html";i:1732413718;s:58:"D:\Desktop\x\php\ThinkPHP\app\index\view\index\layout.html";i:1731324274;s:56:"D:\Desktop\x\php\ThinkPHP\app\index\view\index\head.html";i:1733022813;}*/ ?>
<?php 
// 检查是否存在 PJAX 请求头
$hasPjaxHeader = isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] === 'true';

// 使用三元运算符定义 PJAX 常量
defined('PJAX') or define('PJAX', $hasPjaxHeader);
 if(PJAX): ?>

<div class="row">
    <div class="col-12">
        <div class="content">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-user-circle me-1 text-muted"></i> 个人资料
                    </h3>
                </div>
                <div class="block-content">
                    <form id="edit-profile" onsubmit="return false;">
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="text-muted">
                                    你可以在这里修改你的用户信息
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="mb-4">
                                    <label class="form-label">用户名</label>
                                    <input class="form-control form-control-lg" id="username" name="username"
                                           placeholder="Enter your username.."
                                           type="text" value="<?php echo session('user_data.username'); ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">昵称</label>
                                    <input class="form-control form-control-lg" id="nickname" name="nickname"
                                           placeholder="Enter your NICKNAME.." type="text"
                                           value="<?php echo session('user_data.name'); ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">QQ</label>
                                    <input class="form-control form-control-lg" id="qq" name="qq"
                                           placeholder="Enter your QQ.." type="number"
                                           value="<?php echo session('user_data.qq'); ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">邮箱</label>
                                    <input class="form-control form-control-lg" id="mail" name="mail"
                                           placeholder="Enter your mail.." type="email"
                                           value="<?php echo session('user_data.email'); ?>">
                                </div>
                                <div class="mb-4">
                                    <button class="btn btn-alt-primary" onclick="ajax_edit_profile();" type="submit">
                                        更新
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-asterisk me-1 text-muted"></i> 修改密码
                    </h3>
                </div>
                <div class="block-content">
                    <form id="change_PassWord" onsubmit="return false;">
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="text-muted">
                                    你可以在这里修改登录密码
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="mb-4">
                                    <label class="form-label">当前密码</label>
                                    <input class="form-control form-control-lg" id="outpass" name="outpass"
                                           type="password">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">新密码</label>
                                    <input class="form-control form-control-lg" id="password" name="password"
                                           type="password">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">确认新密码</label>
                                    <input class="form-control form-control-lg" id="repass" name="repass"
                                           type="password">
                                </div>
                                <div class="mb-4">
                                    <button class="btn btn-alt-primary" onclick="ajax_change_PassWord();" type="submit">
                                        修改
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function ajax_edit_profile() {
        var username = x.getval('#username', '请先输入用户名！');
        if (!username) return;
        var nickname = x.getval('#nickname', '请先输入昵称！');
        if (!nickname) return;
        var qq = x.getval('#qq', '请先输入QQ！');
        if (!qq) return;
        var mail = x.getval('#mail', '请先输入邮箱！');
        if (!mail) return;
        x.ajax('/index/ajax/user/profile', {
            username: username,
            nickname: nickname,
            qq: qq,
            mail: mail,
        }, function (data) {
            if (data.code == 1) {
                x.notify(data.message, 'success');
            } else {
                x.notify(data.message, 'warning');
            }
        })
    }

    function ajax_change_PassWord() {
        var outpass = x.getval('#outpass', '请输入旧登录密码!');
        if (!outpass) return;
        var password = x.getval('#password', '请设置新的登录密码!');
        if (!password) return;
        var repass = x.getval('#repass', '请再输入一次新密码!');
        if (!repass) return;
        if (password != repass) {
            x.notify("两次新密码输入不一致!", 'warning');
            return false;
        }
        x.ajax('/index/ajax/user/passWord', {
            outpass: outpass,
            password: password,
            repass: repass,
        }, function (data) {
            if (data.code == 1) {
                x.notify(data.message, 'success');
            } else {
                x.notify(data.message, 'warning');
            }
        })
    }
</script>

<script>
    document.title = '<?php echo config("web.webname") ?: "3057054240"; ?> - <?php echo config("web.title") ?: "3057054240"; ?>';
</script>
<?php else: ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="referrer" content="no-referrer">
    <meta content="width=device-width,initial-scale=1.0" name="viewport">
    <title><?php echo config('web.webname') ?: '3057054240'; ?> - <?php echo config('web.title') ?: '3057054240'; ?></title>
    <meta content="<?php echo config('web.keywords') ?: 3057054240; ?>" name="keywords">
    <meta content="<?php echo config('web.description') ?: 3057054240; ?>" name="description">
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="/static/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="/static/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="/static/css/nprogress.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/js/plugins/flatpickr/flatpickr.min.css">
    <link href="/static/css/codebase.min-5.0.css" id="css-main" rel="stylesheet">
    <link id="css-theme" rel="stylesheet" href="/static/css/themes/elegance.min-5.0.css">
    <style>
        body {
            background-image: url('/imgm/onem4.png');
            background-position-x: center;
            background-position-y: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        #page-header {
            position:relative;
            background-image:url('/imgm/onem2.png');
            background-position:center right;
            background-size:auto 100%;
        }

        #sidebar {
            background-image:url('/imgm/onem3.png');
        }
    </style>
</head>
<body>
<div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed main-content-boxed remember-theme">
     <nav id="sidebar">
    <div class="sidebar-content">
        <div class="content-header justify-content-lg-center">
            <div>
                <a class="link-fx fw-bold tracking-wide mx-auto" href="#">
          <span class="smini-hidden">
            <i class="fa fa-fire text-primary"></i>
            <span class="fs-5 text-dual">LeBot</span>
          </span>
                </a>
            </div>
            <div>
                <button class="btn btn-sm btn-alt-danger d-lg-none" data-action="sidebar_close" data-toggle="layout"
                        type="button">
                    <i class="fa fa-fw fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="js-sidebar-scroll">
        <div class="content-side content-side-user px-0 py-0">
            <div class="smini-visible-block animated fadeIn px-2">
                <img alt="" class="img-avatar img-avatar32" src="//q2.qlogo.cn/g?b=qq&nk=<?php echo session('user_data.qq'); ?>&s=100">
            </div>
            <div class="smini-hidden text-center mx-auto">
                <a class="img-link" href="<?php echo url('/index/users'); ?>">
                    <img alt="" class="img-avatar" src="//q2.qlogo.cn/g?b=qq&nk=<?php echo session('user_data.qq'); ?>&s=100">
                </a>
                <ul class="list-inline mt-3 mb-0">
                    <li class="list-inline-item">
                        <a class="link-fx text-dual fs-sm fw-semibold text-uppercase"
                           data-pjax href="<?php echo url('/index/users'); ?>"><?php echo session('user_data.name'); ?>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-fx text-dual" data-action="dark_mode_toggle" data-toggle="layout"
                           href="javascript:void(0)">
                            <i class="fa fa-burn"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript:;" onclick="logout();"  class="link-fx text-dual">
                            <i class="fa fa-sign-out-alt"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-side content-side-full" id="nav-main">
            <ul class="nav-main">
                <li class="nav-main-heading">控制台</li>
                <li class="nav-main-item">
                    <a id="load-users" class="nav-main-link" href="<?php echo url('/index'); ?>">
                        <i class="nav-main-link-icon fa fa-house-user"></i>
                        <span class="nav-main-link-name">用户中心</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a id="load-users-bot" class="nav-main-link" href="<?php echo url('/index/usersbot'); ?>">
                        <i class="nav-main-link-icon si si-user-follow"></i>
                        <span class="nav-main-link-name">账号管理</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a id="load-logs-set" class="nav-main-link" href="<?php echo url('/index/set'); ?>">
                        <i class="nav-main-link-icon si si-settings"></i>
                        <span class="nav-main-link-name">程序设置</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a id="load-logs-btn" class="nav-main-link" href="<?php echo url('/index/log'); ?>">
                        <i class="nav-main-link-icon si si-clock"></i>
                        <span class="nav-main-link-name">消息日志</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a id="load-logs-up" class="nav-main-link" href="<?php echo url('/index/updata'); ?>">
                    <i class="nav-main-link-icon si si-magic-wand"></i>
                        <span class="nav-main-link-name">程序更新</span>
                    </a>
                </li>
                <li class="nav-main-heading">功能</li>
                <li class="nav-main-item">
                    <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu"
                       data-toggle="submenu" href="#">
                        <i class="nav-main-link-icon si si-music-tone"></i>
                        <span class="nav-main-link-name">基本功能</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-pjax href="<?php echo url('/index/console/netease/add'); ?>">
                                <span class="nav-main-link-name">用户管理</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-pjax href="<?php echo url('/index/console/netease/add'); ?>">
                                <span class="nav-main-link-name">用户管理</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-pjax href="<?php echo url('/index/console/netease/add'); ?>">
                                <span class="nav-main-link-name">用户管理</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading text-center">- 更多功能敬请期待 -</li>
                <li class="nav-main-heading">其他</li>
                <li class="nav-main-item">
                    <a id="load-users-btn" class="nav-main-link" href="<?php echo url('/index/users'); ?>">
                        <i class="nav-main-link-icon si si-user"></i>
                        <span class="nav-main-link-name">个人资料</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a id="load-users-help" class="nav-main-link" href="<?php echo url('/index/help'); ?>">
                        <i class="nav-main-link-icon si si-info"></i>
                        <span class="nav-main-link-name">帮助中心</span>
                    </a>
                </li>
                <?php if(function_exists('opcache_reset')): ?>
                <li class="nav-main-item mt-1">
                    <a class="nav-main-link" data-pjax href="javascript:clearCache();">
                        <i class="nav-main-link-icon si si-refresh"></i>
                        <span class="nav-main-link-name">清理缓存</span>
                    </a>
                </li>
                <?php endif; ?>
                </li>
            </ul>
        </div>

    </div>
</nav>

<header id="page-header">
    <div class="content-header">
        <div class="space-x-1">
            <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-themes-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-paint-brush"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg p-0" aria-labelledby="page-header-themes-dropdown">
                    <div class="p-3 bg-body-light rounded-top">
                        <h5 class="h6 text-center mb-0">
                            界面颜色
                        </h5>
                    </div>
                    <div class="p-3">
                        <div class="row g-0 text-center">
                            <div class="col-2">
                                <a class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-2">
                                <a class="text-elegance" data-toggle="theme" data-theme="/static/css/themes/elegance.min-5.0.css" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-2">
                                <a class="text-pulse" data-toggle="theme" data-theme="/static/css/themes/pulse.min-5.0.css" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-2">
                                <a class="text-flat" data-toggle="theme" data-theme="/static/css/themes/flat.min-5.0.css" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-2">
                                <a class="text-corporate" data-toggle="theme" data-theme="/static/css/themes/corporate.min-5.0.css" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-2">
                                <a class="text-earth" data-toggle="theme" data-theme="/static/css/themes/earth.min-5.0.css" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="space-x-1">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user d-sm-none"></i>
                    <span class="d-none d-sm-inline-block fw-semibold"><?php echo session('user_data.name'); ?></span>
                    <i class="fa fa-angle-down opacity-50 ms-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                    <div class="px-2 py-3 bg-body-light rounded-top">
                        <h5 class="h6 text-center mb-0">
                            <?php echo session('user_data.name'); ?>
                        </h5>
                    </div>
                    <div class="p-2">
                        <a href="<?php echo url('/index/users'); ?>" data-pjax class="dropdown-item d-flex align-items-center justify-content-between space-x-1">
                            <span>个人资料</span>
                            <i class="fa fa-fw fa-user opacity-25"></i>
                            <form action="/index/index/logout" method="post" id="logout-form">
                                <a href="javascript:;" onclick="document.getElementById('logout-form').submit();" class="dropdown-item d-flex align-items-center justify-content-between space-x-1">
                                    <span>注销登录</span>
                                    <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
                                </a>
                            </form>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="far fa-sun fa-spin text-white"></i>
            </div>
        </div>
    </div>
</header>
    <main id="main-container">
        <div class="content" id="pjax-container">
            
<div class="row">
    <div class="col-12">
        <div class="content">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-user-circle me-1 text-muted"></i> 个人资料
                    </h3>
                </div>
                <div class="block-content">
                    <form id="edit-profile" onsubmit="return false;">
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="text-muted">
                                    你可以在这里修改你的用户信息
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="mb-4">
                                    <label class="form-label">用户名</label>
                                    <input class="form-control form-control-lg" id="username" name="username"
                                           placeholder="Enter your username.."
                                           type="text" value="<?php echo session('user_data.username'); ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">昵称</label>
                                    <input class="form-control form-control-lg" id="nickname" name="nickname"
                                           placeholder="Enter your NICKNAME.." type="text"
                                           value="<?php echo session('user_data.name'); ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">QQ</label>
                                    <input class="form-control form-control-lg" id="qq" name="qq"
                                           placeholder="Enter your QQ.." type="number"
                                           value="<?php echo session('user_data.qq'); ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">邮箱</label>
                                    <input class="form-control form-control-lg" id="mail" name="mail"
                                           placeholder="Enter your mail.." type="email"
                                           value="<?php echo session('user_data.email'); ?>">
                                </div>
                                <div class="mb-4">
                                    <button class="btn btn-alt-primary" onclick="ajax_edit_profile();" type="submit">
                                        更新
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-asterisk me-1 text-muted"></i> 修改密码
                    </h3>
                </div>
                <div class="block-content">
                    <form id="change_PassWord" onsubmit="return false;">
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="text-muted">
                                    你可以在这里修改登录密码
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="mb-4">
                                    <label class="form-label">当前密码</label>
                                    <input class="form-control form-control-lg" id="outpass" name="outpass"
                                           type="password">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">新密码</label>
                                    <input class="form-control form-control-lg" id="password" name="password"
                                           type="password">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">确认新密码</label>
                                    <input class="form-control form-control-lg" id="repass" name="repass"
                                           type="password">
                                </div>
                                <div class="mb-4">
                                    <button class="btn btn-alt-primary" onclick="ajax_change_PassWord();" type="submit">
                                        修改
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </main>
    <footer id="page-footer">
        <div class="content py-3">
            <div class="row fs-sm">
                <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                    <a href="https://beian.miit.gov.cn/" target="_blank" class="text-muted fw-semibold"><?php echo config('web.icp') ?: "4"; ?></a>
                </div>
                <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                    &copy; <span data-toggle="year-copy"></span>   <a class="fw-semibold" href="#" target="_blank"><?php echo config('web.webname') ?: "LeBot"; ?></a>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
<script src="/static/js/codebase.app.min-5.0.js"></script>
<script src="/static/js/lib/jquery.min.js"></script>
<script src="/static/js/jquery.pjax.js"></script>
<script src="/static/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="/static/js/plugins/flatpickr/flatpickr.min.js"></script>
<script src="/static/js/nprogress.min.js"></script>
<script src="/static/js/jquery.slimscroll.min.js"></script>
<script src="/static/js/clipboard.min.js"></script>
<script src="/static/js/app.min.js"></script>
<script src="/static/js/layer.js"></script>
<script src="/static/js/gt.js"></script>
<script src="/static/js/draw.js"></script>

<script>
    function ajax_edit_profile() {
        var username = x.getval('#username', '请先输入用户名！');
        if (!username) return;
        var nickname = x.getval('#nickname', '请先输入昵称！');
        if (!nickname) return;
        var qq = x.getval('#qq', '请先输入QQ！');
        if (!qq) return;
        var mail = x.getval('#mail', '请先输入邮箱！');
        if (!mail) return;
        x.ajax('/index/ajax/user/profile', {
            username: username,
            nickname: nickname,
            qq: qq,
            mail: mail,
        }, function (data) {
            if (data.code == 1) {
                x.notify(data.message, 'success');
            } else {
                x.notify(data.message, 'warning');
            }
        })
    }

    function ajax_change_PassWord() {
        var outpass = x.getval('#outpass', '请输入旧登录密码!');
        if (!outpass) return;
        var password = x.getval('#password', '请设置新的登录密码!');
        if (!password) return;
        var repass = x.getval('#repass', '请再输入一次新密码!');
        if (!repass) return;
        if (password != repass) {
            x.notify("两次新密码输入不一致!", 'warning');
            return false;
        }
        x.ajax('/index/ajax/user/passWord', {
            outpass: outpass,
            password: password,
            repass: repass,
        }, function (data) {
            if (data.code == 1) {
                x.notify(data.message, 'success');
            } else {
                x.notify(data.message, 'warning');
            }
        })
    }
</script>

<?php endif; ?>