<?php /*a:3:{s:52:"D:\Desktop\x\php\lebot\app\index\view\index\log.html";i:1732429388;s:55:"D:\Desktop\x\php\lebot\app\index\view\index\layout.html";i:1731324274;s:53:"D:\Desktop\x\php\lebot\app\index\view\index\head.html";i:1733290685;}*/ ?>
<?php 
// 检查是否存在 PJAX 请求头
$hasPjaxHeader = isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] === 'true';

// 使用三元运算符定义 PJAX 常量
defined('PJAX') or define('PJAX', $hasPjaxHeader);
 if(PJAX): ?>


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
                <li class="nav-main-heading">广告</li>
                <li class="nav-main-item">
                    <a id="load-users-help1" class="nav-main-link" href="<?php echo url('/index/help'); ?>">
                        <i class="nav-main-link-icon si si-cup"></i>
                        <span class="nav-main-link-name">开源地址</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a id="load-users-help2" class="nav-main-link" href="<?php echo url('/index/help'); ?>">
                        <i class="nav-main-link-icon si si-doc"></i>
                        <span class="nav-main-link-name">官方文档</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a id="load-users-help3" class="nav-main-link" href="<?php echo url('/index/help'); ?>">
                        <i class="nav-main-link-icon si si-users"></i>
                        <span class="nav-main-link-name">交流群聊</span>
                    </a>
                </li>
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
<style>
    .log-table-container {
        margin-top: 70px; /* 上方外边距，使表格区域向下移动 */
        padding: 20px; /* 内边距，使内容与边缘之间有一些空间 */
        background-color: rgba(255, 255, 255, 0); /* 白色背景，透明度为0.8 */
        border-radius: 5px; /* 边框圆角效果 */
        /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 添加阴影效果 */
    }

    .log-table-container .table {
        width: auto; /* 或者指定具体的宽度 */
        max-width: 100%; /* 确保不会超出容器宽度 */
        height: auto; /* 或者指定具体的高度 */
    }

    /* 为每个列单独设置宽度 */
    .log-table-container .table th:nth-child(1),
    .log-table-container .table td:nth-child(1) {
        width: 195px; /* 时间列的宽度 */
    }

    .log-table-container .table th:nth-child(2),
    .log-table-container .table td:nth-child(2) {
        width: 90px; /* 类型列的宽度 */
    }

    .log-table-container .table th:nth-child(3),
    .log-table-container .table td:nth-child(3) {
        width: 200px; /* Union OpenID 列的宽度 */
    }

    .log-table-container .table th:nth-child(4),
    .log-table-container .table td:nth-child(4) {
        width: 200px; /* Group OpenID 列的宽度 */
    }

    .log-table-container .table th:nth-child(5),
    .log-table-container .table td:nth-child(5) {
        width: 300px; /* 内容列的宽度 */
    }

    /* 控制内容过长时的行为 */
    .log-table-container .table td {
        white-space: nowrap; /* 防止自动换行 */
        overflow: hidden; /* 隐藏多余内容 */
        text-overflow: ellipsis; /* 显示省略号 */
        cursor: pointer; /* 指针变为手形，提示可点击 */
    }

    /* 展开时的样式 */
    .log-table-container .table td.expanded {
        white-space: normal; /* 允许换行 */
        word-wrap: break-word; /* 过长单词换行 */
        overflow: visible; /* 显示所有内容 */
    }
</style>
<div class="log-table-container">
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">任务运行日志 <small>仅展示最新的50条数据</small></h3>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                <thead>
                <tr>
                    <th>时间</th>
                    <th>类型</th>
                    <th>Union OpenID</th>
                    <th>Group OpenID</th>
                    <th>内容</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($logs) || $logs instanceof \think\Collection || $logs instanceof \think\Paginator): $i = 0; $__LIST__ = $logs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo htmlentities($log['time']); ?></td> <!-- 直接显示时间 -->
                    <td><?php echo htmlentities($log['type']); ?></td>
                    <td><?php echo htmlentities($log['union_openid']); ?></td>
                    <td><?php echo htmlentities($log['group_openid']); ?></td>
                    <td class="clickable" data-content="<?php echo htmlentities($log['content']); ?>">
                        <?php if(strlen($log['content']) > 21): ?>
                        <?php echo mb_substr($log['content'], 0, 8, 'UTF-8'); ?>...
                        <?php else: ?>
                        <?php echo htmlentities($log['content']); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.log-table-container .table td.clickable').forEach(function(td) {
        td.addEventListener('click', function() {
            // 切换展开状态
            this.classList.toggle('expanded');
            // 如果已经展开，则设置内容为原始内容
            if (this.classList.contains('expanded')) {
                this.textContent = this.dataset.content;
            } else {
                // 如果折叠，则恢复到省略号显示的状态
                const content = this.dataset.content;
                if (content.length > 21) {
                    this.textContent = content.substring(0, 8) + '...';
                } else {
                    this.textContent = content.length > 10 ? content.substring(0, 8) + '...' : content;
                }
            }
        });
    });
</script>

    <main id="main-container">
        <div class="content" id="pjax-container">
            
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

<?php endif; ?>