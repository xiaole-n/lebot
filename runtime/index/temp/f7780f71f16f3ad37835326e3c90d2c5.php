<?php /*a:1:{s:56:"D:\Desktop\x\php\ThinkPHP\app\index\view\home\index.html";i:1731248611;}*/ ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="referrer" content="no-referrer">
    <meta content="width=device-width,initial-scale=1.0" name="viewport">
    <title>乐助手 - 全网最稳定的挂机平台</title>
    <meta content="乐助手" name="keywords">
    <meta content="乐助手" name="description">
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="/static/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="/static/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="/css/nprogress.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/js/plugins/flatpickr/flatpickr.min.css">
    <link href="/css/codebase.min-5.0.css" id="css-main" rel="stylesheet">
    <link id="css-theme" rel="stylesheet" href="/css/themes/elegance.min-5.0.css">
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
            <span class="fs-5 text-dual">乐助手</span>
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
                    <a class="img-link" href="/index/console/user/profile.html">
                        <img alt="" class="img-avatar" src="//q2.qlogo.cn/g?b=qq&nk=3057054240&s=100">
                    </a>
                    <ul class="list-inline mt-3 mb-0">
                        <li class="list-inline-item">
                            <a class="link-fx text-dual fs-sm fw-semibold text-uppercase"
                               data-pjax href="/index/console/user/profile.html">樂                        </a>
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
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/admin/system/index.html">
                            <i class="nav-main-link-icon si si-speedometer"></i>
                            <span class="nav-main-link-name">站长后台</span>
                        </a>
                    </li>
                    <li class="nav-main-heading">控制台</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax href="/index/console/index.html">
                            <i class="nav-main-link-icon fa fa-house-user"></i>
                            <span class="nav-main-link-name">用户中心</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax href="/index/console/agent.html">
                            <i class="nav-main-link-icon fa fa-award"></i>
                            <span class="nav-main-link-name">代理中心</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu"
                           data-toggle="submenu" href="#">
                            <i class="nav-main-link-icon si si-basket-loaded"></i>
                            <span class="nav-main-link-name">自助商店</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/shop/quota.html">
                                    <span class="nav-main-link-name">购买配额</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/shop/vip.html">
                                    <span class="nav-main-link-name">购买会员</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/shop/agent.html">
                                    <span class="nav-main-link-name">购买代理</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/shop/money.html">
                                    <span class="nav-main-link-name">充值余额</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/shop/card.html">
                                    <span class="nav-main-link-name">卡密激活</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/shop/site.html">
                                    <span class="nav-main-link-name">开通分站</span>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-main-heading">免费功能</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax="" href="/index/tool/pvp.html">
                            <i class="nav-main-link-icon si si-magnifier"></i>
                            <span class="nav-main-link-name">王者战力查询</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax="" href="/index/tool/baidu.html">
                            <i class="nav-main-link-icon si si-magnifier"></i>
                            <span class="nav-main-link-name">你不会百度吗</span>
                        </a>
                    </li>
                    <li class="nav-main-heading text-success">AIGC</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax="" href="/index/aigc/chat.html">
                            <i class="nav-main-link-icon mb-1">
                                <svg t="1702818769870" class="icon" viewBox="0 0 1231 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4353" width="16" height="16"><path d="M1177.738445 663.954058a51.073389 51.073389 0 0 1-36.262107-14.811283l-123.086867-123.086868a51.073389 51.073389 0 0 0-36.262107-14.811282H462.710998A153.220167 153.220167 0 0 1 309.49083 357.513723V153.220167a153.220167 153.220167 0 0 1 153.220168-153.220167h612.880668a153.220167 153.220167 0 0 1 153.220168 153.220167v204.293556a51.073389 51.073389 0 0 1-102.146778 0V153.220167a51.073389 51.073389 0 0 0-51.07339-51.073389H462.710998a51.073389 51.073389 0 0 0-51.073389 51.073389v204.293556a51.073389 51.073389 0 0 0 51.073389 51.07339h519.416366a153.220167 153.220167 0 0 1 108.275585 44.944582l123.086868 123.086868A51.073389 51.073389 0 0 1 1177.738445 663.954058zM105.197274 715.027447v-204.293556a51.073389 51.073389 0 0 1 51.073389-51.073389 51.073389 51.073389 0 0 0 0-102.146779 153.220167 153.220167 0 0 0-153.220167 153.220168v204.293556a51.073389 51.073389 0 0 0 102.146778 0z m-14.811283 291.629052l123.086868-123.086868a51.073389 51.073389 0 0 1 36.262106-15.322017H769.151332a153.220167 153.220167 0 0 0 153.220167-153.220167v-51.073389a51.073389 51.073389 0 0 0-102.146778 0v51.073389a51.073389 51.073389 0 0 1-51.073389 51.073389H249.734965a153.220167 153.220167 0 0 0-108.275585 44.944582L17.861779 934.132286A51.073389 51.073389 0 1 0 89.875257 1006.145765z" fill="#1296db" p-id="4354"></path></svg>
                            </i>
                            <span class="nav-main-link-name">AI对话</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax="" href="/index/aigc/draw.html">
                            <i class="nav-main-link-icon mb-1">
                                <svg t="1702818878040" class="icon" viewBox="0 0 1028 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6482" width="16" height="16"><path d="M1027.917334 133.791944c-0.328727-6.647593-9.058259-9.642663-16.509408-11.688076-6.538017-1.826262-16.18068-0.474828-7.305047-14.208317s22.828273-37.401843 9.642663-49.783899c-8.619956-8.254704-22.718698-1.387959-33.274491-10.555793s-6.538017-32.580512-32.872714-44.962567-48.980343 23.412677-49.783898 29.22019a30.206371 30.206371 0 0 0 21.915142 25.932918c16.071104 5.734462 15.596276 8.619956 22.609122 23.303101a63.152135 63.152135 0 0 0 23.412677 32.580512c10.665369 5.150058 12.856883 20.527183 25.823343 13.770014s16.18068 4.456079 24.325808 13.87959 12.235954-0.84008 12.016803-7.487673z m-71.224213-9.533087a76.045544 76.045544 0 0 0-2.410666-1.497535 63.152135 63.152135 0 0 1-23.412677-32.580511c-7.012846-14.610095-6.538017-17.568639-22.609121-23.303102a35.319904 35.319904 0 0 1-19.614053-16.509407l-67.571689 92.554951 59.755288 52.888544zM302.233921 221.087261c-251.111006 128.934087-326.243419 376.209943-295.854421 537.43234 12.856883 67.462113 70.311082 138.467174 138.357598 107.932076 57.709875-25.932918 92.116648-98.289413 162.756457-121.263788 43.830285-14.354418 91.093942 22.937849 130.212471 82.583561 63.919165 97.230181 203.409046 215.316273 422.158691 101.978463 199.46432-103.256846 205.454459-419.382773 56.431492-599.233042A499.080841 499.080841 0 0 0 302.233921 221.087261z m-7.305047 182.151358a58.44038 58.44038 0 1 1 58.440379-58.44038 58.44038 58.44038 0 0 1-58.330804 58.44038z m233.761518-42.223175a75.241989 75.241989 0 1 1 75.241988-75.241988 75.278514 75.278514 0 0 1-75.132413 75.241988z m208.193852 522.310892a135.399054 135.399054 0 1 1 135.362529-135.472105 135.50863 135.50863 0 0 1-135.143378 135.326004z m40.177761-366.165503a99.677372 99.677372 0 1 1 100.006099-99.859998 99.640847 99.640847 0 0 1-99.677372 99.713897z m88.318023-304.401326l-59.316985-52.523291-25.129363 28.891462a521.580387 521.580387 0 0 1 68.484819 41.310043z" p-id="6483" fill="#1296db"></path><path d="M316.369188 771.924363a220.101079 220.101079 0 0 0-82.583561 60.12054 412.260352 412.260352 0 0 1-47.848061 42.661477l-81.451279 93.833335c-13.87959 16.071104-17.093811 36.707863-6.757169 45.656546l6.063189 5.515311c10.227066 8.948683 30.279422 3.433372 44.378164-12.27248l205.67361-228.063581a55.554886 55.554886 0 0 0-27.284352-9.167834 40.433438 40.433438 0 0 0-10.190541 1.716686z" p-id="6484" fill="#1296db"></path></svg>
                            </i>
                            <span class="nav-main-link-name">AI绘画</span>
                        </a>
                    </li>
                    <li class="nav-main-heading">会员功能</li>
                    <li class="nav-main-item">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu"
                           data-toggle="submenu" href="#">
                            <i class="nav-main-link-icon si si-music-tone"></i>
                            <span class="nav-main-link-name">网易云音乐</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/netease/add.html">
                                    <span class="nav-main-link-name">添加账号</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/netease/list.html">
                                    <span class="nav-main-link-name">管理账号</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu"
                           data-toggle="submenu" href="#">
                            <i class="nav-main-link-icon si si-camcorder"></i>
                            <span class="nav-main-link-name">哔哩哔哩</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/bilibili/add.html">
                                    <span class="nav-main-link-name">添加账号</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/bilibili/list.html">
                                    <span class="nav-main-link-name">管理账号</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu"
                           data-toggle="submenu" href="#">
                            <i class="nav-main-link-icon si si-rocket"></i>
                            <span class="nav-main-link-name">步数助手</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/sport/add.html">
                                    <span class="nav-main-link-name">添加账号</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/sport/list.html">
                                    <span class="nav-main-link-name">管理账号</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu"
                           data-toggle="submenu" href="#">
                            <i class="nav-main-link-icon si si-book-open"></i>
                            <span class="nav-main-link-name">百度贴吧</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/tieba/add.html">
                                    <span class="nav-main-link-name">添加账号</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/tieba/list.html">
                                    <span class="nav-main-link-name">管理账号</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu"
                           data-toggle="submenu" href="#">
                            <i class="nav-main-link-icon si si-globe-alt"></i>
                            <span class="nav-main-link-name">米游社</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/mihoyo/add.html">
                                    <span class="nav-main-link-name">添加账号</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/mihoyo/list.html">
                                    <span class="nav-main-link-name">管理账号</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu"
                           data-toggle="submenu" href="#">
                            <i class="nav-main-link-icon si si-screen-desktop"></i>
                            <span class="nav-main-link-name">爱奇艺</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/iqiyi/add.html">
                                    <span class="nav-main-link-name">添加账号</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/iqiyi/list.html">
                                    <span class="nav-main-link-name">管理账号</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu"
                           data-toggle="submenu" href="#">
                            <i class="nav-main-link-icon si si-graduation"></i>
                            <span class="nav-main-link-name">扣扣星</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/qq/add.html">
                                    <span class="nav-main-link-name">添加账号</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/qq/list.html">
                                    <span class="nav-main-link-name">管理账号</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu" data-toggle="submenu" href="#">
                            <i class="nav-main-link-icon si si-social-dropbox"></i>
                            <span class="nav-main-link-name">小黑盒</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax="" href="/index/console/heybox/add.html">
                                    <span class="nav-main-link-name">添加账号</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax="" href="/index/console/heybox/list.html">
                                    <span class="nav-main-link-name">管理账号</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu"
                           data-toggle="submenu" href="#">
                            <i class="nav-main-link-icon fa fa-qrcode"></i>
                            <span class="nav-main-link-name">收款码合一</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/qrcode/create.html">
                                    <span class="nav-main-link-name">生成收款码</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" data-pjax href="/index/console/qrcode/list.html">
                                    <span class="nav-main-link-name">管理收款码</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax="" href="/index/tool/analyse.html">
                            <i class="nav-main-link-icon si si-social-youtube"></i>
                            <span class="nav-main-link-name">视频解析</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax="" href="/index/tool/soundPower.html">
                            <i class="nav-main-link-icon si si-earphones"></i>
                            <span class="nav-main-link-name">企鹅音乐</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax href="/index/console/epic/act/weeklygame.html">
                            <i class="nav-main-link-icon si si-game-controller"></i>
                            <span class="nav-main-link-name">Epic商城</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax="" href="/index/tool/music.html">
                            <i class="nav-main-link-icon si si-social-youtube"></i>
                            <span class="nav-main-link-name">音乐解析</span>
                        </a>
                    </li>
                    <li class="nav-main-heading text-center">- 更多功能敬请期待 -</li>
                    <li class="nav-main-heading">其他</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax href="/index/console/user/profile.html">
                            <i class="nav-main-link-icon si si-user"></i>
                            <span class="nav-main-link-name">个人资料</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax href="/index/console/user/faq.html">
                            <i class="nav-main-link-icon si si-info"></i>
                            <span class="nav-main-link-name">帮助中心</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-pjax href="/index/console/user/uplog.html">
                            <i class="nav-main-link-icon si si-clock"></i>
                            <span class="nav-main-link-name">更新日志</span>
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
                        <span class="d-none d-sm-inline-block fw-semibold">樂</span>
                        <i class="fa fa-angle-down opacity-50 ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                        <div class="px-2 py-3 bg-body-light rounded-top">
                            <h5 class="h6 text-center mb-0">
                                樂                        </h5>
                        </div>
                        <div class="p-2">
                            <a href="/index/console/user/profile.html" data-pjax class="dropdown-item d-flex align-items-center justify-content-between space-x-1">
                                <span>个人资料</span>
                                <i class="fa fa-fw fa-user opacity-25"></i>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:;" onclick="logout();" class="dropdown-item d-flex align-items-center justify-content-between space-x-1">
                                <span>注销登录</span>
                                <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
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

            <style>
                #notice p {
                    display:inline;
                }
            </style>
            <div class="block block-rounded bg-image mb-2" style="background-image: url('/imgm/onem1.png');">
                <div class="block-content bg-white-5">
                    <div class="py-4 text-center">
                        <h1 class="h2 fw-bold text-primary mb-2">乐助手</h1>
                        <h2 class="h5 fw-bold text-pulse">全网最稳定的挂机平台</h2>
                    </div>
                </div>
            </div>
            <div class="row g-sm mb-1">
                <div class="col-4 col-md-4 col-xl-2">
                    <a class="block block-rounded block-link-shadow text-center" href="/index/console/shop/vip.html">
                        <div class="block-content ribbon ribbon-bookmark ribbon-danger ribbon-left">
                            <div class="ribbon-box opacity-75">Hot !</div>
                            <p class="my-3">
                                <i class="fa fa-chess-queen fa-2x"></i>
                            </p>
                            <p class="fw-semibold fs-sm">会员开通</p>
                        </div>
                    </a>
                </div>
                <div class="col-4 col-md-4 col-xl-2">
                    <a class="block block-rounded block-link-shadow text-center" href="/index/console/shop/agent.html">
                        <div class="block-content">
                            <p class="my-3">
                                <i class="fa fa-graduation-cap fa-2x"></i>
                            </p>
                            <p class="fw-semibold fs-sm">代理开通</p>
                        </div>
                    </a>
                </div>
                <div class="col-4 col-md-4 col-xl-2">
                    <a class="block block-rounded block-link-shadow text-center" href="/index/console/shop/money.html">
                        <div class="block-content ribbon ribbon-bookmark ribbon-primary ribbon-left">
                            <p class="my-3">
                                <i class="fa fa-wallet fa-2x"></i>
                            </p>
                            <p class="fw-semibold fs-sm">充值余额</p>
                        </div>
                    </a>
                </div>
                <div class="col-4 col-md-4 col-xl-2">
                    <a class="block block-rounded block-link-shadow text-center" href="tencent://ContactInfo/?subcmd=ViewInfo&amp;puin=0&amp;uin=3057054240">
                        <div class="block-content">
                            <p class="my-3">
                                <i class="fab fa-github-alt fa-2x"></i>
                            </p>
                            <p class="fw-semibold fs-sm">联系客服</p>
                        </div>
                    </a>
                </div>
                <div class="col-4 col-md-4 col-xl-2">
                    <a class="block block-rounded block-link-shadow text-center" href="/index/console/user/faq.html">
                        <div class="block-content">
                            <p class="my-3">
                                <i class="fa fa-hands-helping fa-2x"></i>
                            </p>
                            <p class="fw-semibold fs-sm">帮助中心</p>
                        </div>
                    </a>
                </div>
                <div class="col-4 col-md-4 col-xl-2">
                    <a class="block block-rounded block-link-shadow text-center" href="/index/console/user/profile.html">
                        <div class="block-content">
                            <p class="my-3">
                                <i class="fa fa-id-card fa-2x"></i>
                            </p>
                            <p class="fw-semibold fs-sm">个人资料</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mb-2">
                    <div class="block block-rounded mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">公告通知</h3>
                        </div>
                        <div class="block-content block-content-full" data-toggle="slimscroll" data-height="259px">
                            <div class="fw-medium fs-sm">
                                <div class="border-start border-4 rounded-2 border-primary mb-2">
                                    <div class="rounded p-2 text-pulse-light" id="notice">
                                        <p class="m-1"><p>视频解析功能恢复正常，支持快手抖音，无需去文案，解析失败可以去文案试试，长期无法使用请联系站长</p></p>
                                        <br/>
                                        <p class="m-2 text-muted">2023-12-07 22:32</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                        <div class="block-content bg-image" style="background-image: url('/imgm/onem1.png');">
                            <div class="push">
                                <img class="img-avatar img-avatar-thumb" src="//q2.qlogo.cn/g?b=qq&nk=3057054240&s=100" alt="">
                            </div>
                            <div class="pull-x pull-b py-2 bg-black-25">
                                <div class="fw-semibold mb-1 text-white">
                                    <i class="fa fa-star text-white-75 ms-1"></i> 樂                        <span class="fs-xs">UID: 1</span>
                                </div>
                                <div class="fs-sm text-white-75">VIP会员 - 2099-05-01</div>
                                <div class="fs-sm text-white-75">共有 105 个配额 | 已使用 ： 6 个</div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row items-push text-center">
                                <div class="col-6">
                                    <div class="mb-1"><i class="si si-user fa-2x"></i></div>
                                    <div class="fs-sm fw-medium text-muted">钻石代理</div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1"><i class="si si-wallet fa-2x"></i></div>
                                    <div class="fs-sm fw-medium text-muted">98.20 元</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row g-sm mt-2">
                <div class="col-6 col-xl-3">
                    <a class="block block-rounded block-link-pop text-end" href="javascript:void(0)">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center border-black-op-b border-3">
                            <div class="d-none d-sm-block">
                                <i class="si si-star fa-2x text-primary-light"></i>
                            </div>
                            <div class="text-end">
                                <div class="fs-3 fw-semibold text-primary">40</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">用户数量</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-3">
                    <a class="block block-rounded block-link-pop text-end" href="javascript:void(0)">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center border-black-op-b border-3">
                            <div class="d-none d-sm-block">
                                <i class="si si-cup fa-2x text-earth-light"></i>
                            </div>
                            <div class="text-end">
                                <div class="fs-3 fw-semibold text-earth">32</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">托管账号</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-3">
                    <a class="block block-rounded block-link-pop text-end" href="javascript:void(0)">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center border-black-op-b border-3">
                            <div class="d-none d-sm-block">
                                <i class="si si-support fa-2x text-elegance-light"></i>
                            </div>
                            <div class="text-end">
                                <div class="fs-3 fw-semibold text-elegance">220</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">添加任务</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-3">
                    <a class="block block-rounded block-link-pop text-end" href="javascript:void(0)">
                        <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center border-black-op-b border-3">
                            <div class="d-none d-sm-block">
                                <i class="si si-fire fa-2x text-corporate-light"></i>
                            </div>
                            <div class="text-end">
                                <div class="fs-3 fw-semibold text-pulse">32636</div>
                                <div class="fs-sm fw-semibold text-uppercase text-muted">运行次数</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </main>
    <footer id="page-footer">
        <div class="content py-3">
            <div class="row fs-sm">
                <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                    <a href="https://beian.miit.gov.cn/" target="_blank" class="text-muted fw-semibold"></a>
                </div>
                <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                    &copy; <span data-toggle="year-copy"></span>   <a class="fw-semibold" href="#" target="_blank">乐助手</a>
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
    $(function () {
        jQuery(function(){Codebase.helpers('jq-slimscroll');});
    })
</script>

