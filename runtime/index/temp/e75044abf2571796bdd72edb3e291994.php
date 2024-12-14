<?php /*a:1:{s:56:"D:\Desktop\x\php\ThinkPHP\app\index\view\index\head.html";i:1732365124;}*/ ?>
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
                <img alt="" class="img-avatar img-avatar32" src="//q2.qlogo.cn/g?b=qq&nk=3057054240&s=100">
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
                    <a class="nav-main-link" data-pjax="" href="<?php echo url('/index/'); ?>">
                        <i class="nav-main-link-icon si si-user-follow"></i>
                        <span class="nav-main-link-name">账号管理</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" data-pjax="" href="<?php echo url('/index/set'); ?>">
                        <i class="nav-main-link-icon si si-settings"></i>
                        <span class="nav-main-link-name">程序设置</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" data-pjax="" href="<?php echo url('/index/log'); ?>">
                        <i class="nav-main-link-icon si si-clock"></i>
                        <span class="nav-main-link-name">查看日志</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" data-pjax="" href="<?php echo url('/index/updata'); ?>">
                    <i class="nav-main-link-icon si si-magic-wand"></i>
                        <span class="nav-main-link-name">程序更新</span>
                    </a>
                </li>
                <li class="nav-main-heading text-center">- 更多功能敬请期待 -</li>
                <li class="nav-main-heading">其他</li>
                <li class="nav-main-item">
                    <a class="nav-main-link" data-pjax href="<?php echo url('/index/users'); ?>">
                        <i class="nav-main-link-icon si si-user"></i>
                        <span class="nav-main-link-name">个人资料</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" data-pjax href="<?php echo url('/index/console/user/faq'); ?>">
                        <i class="nav-main-link-icon si si-info"></i>
                        <span class="nav-main-link-name">帮助中心</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" data-pjax href="<?php echo url('/index/console/user/uplog'); ?>">
                        <i class="nav-main-link-icon si si-clock"></i>
                        <span class="nav-main-link-name">更新日志</span>
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
                        <a href="<?php echo url('/index/console/user/profile'); ?>" data-pjax class="dropdown-item d-flex align-items-center justify-content-between space-x-1">
                            <span>个人资料</span>
                            <i class="fa fa-fw fa-user opacity-25"></i>
                            <form action="/index/index/logout" method="post" id="logout-form">
                                <a href="javascript:;" onclick="document.getElementById('logout-form').submit();" class="dropdown-item d-flex align-items-center justify-content-between space-x-1">
                                    <span>注销登录</span>
                                    <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
                                </a>
                            </form>
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