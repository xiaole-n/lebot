<?php /*a:3:{s:58:"D:\Desktop\x\php\lebot\app\index\view\index\users_bot.html";i:1732800558;s:55:"D:\Desktop\x\php\lebot\app\index\view\index\layout.html";i:1731324274;s:53:"D:\Desktop\x\php\lebot\app\index\view\index\head.html";i:1733290685;}*/ ?>
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
    /* 这里是你的CSS样式 */
    .editable-table-container {
        margin-top: 70px;
        padding: 20px;
        background-color: transparent; /* 设置背景为透明 */
        border-radius: 5px;
    }

    .editable-table-container .table {
        width: 100%;
        max-width: 100%;
        height: auto;
    }

    .editable-table-container .table th,
    .editable-table-container .table td {
        padding: 8px;
        text-align: left;
    }

    .editable-table-container .table td.edit-mode {
        padding: 0;
    }

    .editable-table-container .table input[type="text"] {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .editable-table-container .actions {
        min-width: 100px; /* 根据需要调整宽度 */
        display: flex;
        gap: 20px; /* 增加按钮之间的间隔 */
    }

    .editable-table-container .btn {
        font-size: 12px;
        padding: 5px 10px;
    }

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5); /* 半透明背景色 */
    }

    .modal-content {
        background-color: white;
        padding: 10px; /* 减少内边距 */
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 250px; /* 减小最大宽度 */
        width: 100%; /* 自适应宽度 */
    }

    .modal-content header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-content label {
        display: block;
        margin-bottom: 5px;
        font-size: 12px;
    }

    .modal-content input {
        width: 100%;
        padding: 5px; /* 减少内边距 */
        margin-bottom: 8px;
        box-sizing: border-box;
        font-size: 12px;
    }

    .modal-content button {
        padding: 6px 12px; /* 减少按钮内边距 */
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 12px;
    }

    .modal-content button.close-modal {
        background-color: transparent;
        color: #007bff;
        border: none;
        font-size: 14px; /* 调整关闭按钮字体大小 */
    }

    /* 删除确认模态框 */
    #delete-confirm-modal {
        display: none;
    }

    #delete-confirm-modal .actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
</style>
<div class="editable-table-container">
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">用户机器人信息 <small>可编辑内容</small></h3>
            <button class="btn btn-sm btn-success add-record-btn">新增记录</button>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>QQ</th>
                    <th>AppID</th>
                    <th>Token</th>
                    <th>AppSecret</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($usersBotData) || $usersBotData instanceof \think\Collection || $usersBotData instanceof \think\Paginator): $i = 0; $__LIST__ = $usersBotData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userBot): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td data-field="ID" class="editable"><?php echo htmlentities($userBot['ID']); ?></td>
                    <td data-field="QQ" class="editable"><?php echo htmlentities($userBot['QQ']); ?></td>
                    <td data-field="AppID" class="editable"><?php echo htmlentities($userBot['AppID']); ?></td>
                    <td data-field="Token" class="editable"><?php echo htmlentities($userBot['Token']); ?></td>
                    <td data-field="AppSecret" class="editable"><?php echo htmlentities($userBot['AppSecret']); ?></td>
                    <td class="actions">
                        <button class="btn btn-sm btn-primary edit-btn" data-id="<?php echo htmlentities($userBot['ID']); ?>">编辑</button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="<?php echo htmlentities($userBot['ID']); ?>">删除</button>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- 删除确认模态框 -->
<div id="delete-confirm-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <header>
            <h3>确认删除</h3>
            <button class="close-modal">&times;</button>
        </header>
        <p>确定要删除此记录吗？</p>
        <div class="actions">
            <button class="btn btn-sm btn-danger confirm-delete">确认</button>
            <button class="btn btn-sm btn-secondary cancel-delete">取消</button>
        </div>
    </div>
</div>

<!-- 新增记录模态框 -->
<div id="add-record-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <header>
            <h3>新增记录</h3>
            <button class="close-modal">&times;</button>
        </header>
        <form id="add-record-form">
            <label for="QQ">QQ</label>
            <input type="text" id="QQ" name="QQ" required>
            <label for="AppID">AppID</label>
            <input type="text" id="AppID" name="AppID" required>
            <label for="Token">Token</label>
            <input type="text" id="Token" name="Token" required>
            <label for="AppSecret">AppSecret</label>
            <input type="text" id="AppSecret" name="AppSecret" required>
            <button type="submit">提交</button>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed');

        // 新增按钮点击事件
        const addRecordBtn = document.querySelector('.add-record-btn');
        if (addRecordBtn) {
            addRecordBtn.addEventListener('click', function() {
                console.log('Add record button clicked');
                const addRecordModal = document.getElementById('add-record-modal');
                if (addRecordModal) {
                    addRecordModal.style.display = 'flex';
                } else {
                    console.error('Add record modal not found');
                }
            });
        } else {
            console.error('Add record button not found');
        }

        // 取消按钮点击事件
        document.querySelectorAll('.close-modal').forEach(function(button) {
            button.addEventListener('click', function() {
                console.log('Close modal button clicked');
                const modal = this.closest('.modal');
                if (modal) {
                    modal.style.display = 'none';
                }
            });
        });

        // 表单提交事件
        const addRecordForm = document.getElementById('add-record-form');
        if (addRecordForm) {
            addRecordForm.addEventListener('submit', function(event) {
                event.preventDefault();
                console.log('Add record form submitted');

                const formData = new FormData(this);
                fetch('addRecord', {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('记录已成功添加！');
                            const addRecordModal = document.getElementById('add-record-modal');
                            if (addRecordModal) {
                                addRecordModal.style.display = 'none';
                            }
                            location.reload(); // 刷新页面以显示新的记录
                        } else {
                            alert('添加记录失败，请重试。');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        } else {
            console.error('Add record form not found');
        }

        // 编辑和删除按钮点击事件
        const rows = document.querySelectorAll('.editable-table-container .table tr');
        rows.forEach(function (row) {
            const editBtn = row.querySelector('.edit-btn');
            const deleteBtn = row.querySelector('.delete-btn');

            if (editBtn) {
                editBtn.addEventListener('click', function () {
                    console.log('Edit button clicked');
                    showEditModal(row);
                });
            } else {
                console.error('Edit button not found in row:', row);
            }

            if (deleteBtn) {
                deleteBtn.addEventListener('click', function () {
                    console.log('Delete button clicked');
                    const id = this.getAttribute('data-id');
                    showDeleteConfirmModal(id, row);
                });
            } else {
                console.error('Delete button not found in row:', row);
            }
        });

        function showDeleteConfirmModal(id, row) {
            const modal = document.getElementById('delete-confirm-modal');
            if (!modal) {
                console.error('Delete confirm modal not found!');
                return;
            }

            modal.style.display = 'flex';

            const confirmDeleteBtn = modal.querySelector('.confirm-delete');
            const cancelDeleteBtn = modal.querySelector('.cancel-delete');
            const closeModalBtn = modal.querySelector('.close-modal');

            confirmDeleteBtn.addEventListener('click', function () {
                sendDeleteRequest(id, row);
                modal.style.display = 'none';
            });

            cancelDeleteBtn.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            closeModalBtn.addEventListener('click', function () {
                modal.style.display = 'none';
            });
        }

        function sendDeleteRequest(id, row) {
            fetch('usersdelete', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id: id})
            }).then(response => response.json())
                .then(data => {
                    console.log('Server response:', data);
                    location.reload(); // 刷新页面
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function showEditModal(row) {
            const data = {};
            const id = row.querySelector('.edit-btn').getAttribute('data-id'); // 自动从表格行的编辑按钮获取id

            Array.from(row.cells).slice(0, -1).forEach(cell => {
                data[cell.dataset.field] = cell.textContent.trim();
            });

            const modal = createEditModal(data);

            modal.querySelector('.close-modal').addEventListener('click', () => {
                modal.remove();
            });

            modal.querySelector('.submit-edit').addEventListener('click', (event) => {
                event.preventDefault();
                console.log('Edit form submitted');
                const formData = new FormData(modal.querySelector('form'));
                const updatedData = {};
                formData.forEach((value, key) => {
                    if (key!== 'ID') {
                        updatedData[key] = value;
                    }
                });

                sendEditRequest(id, updatedData, row, modal);
            });

            document.body.appendChild(modal);
        }

        function createEditModal(data) {
            const modalHtml = `
        <div class="modal">
            <div class="modal-content">
                <header>
                    <h3>编辑信息</h3>
                    <button class="close-modal">&times;</button>
                </header>
                <form>
                    <label for="QQ">QQ</label>
                    <input type="text" id="QQ" name="QQ" value="${data.QQ || ''}" required>
                    <label for="AppID">AppID</label>
                    <input type="text" id="AppID" name="AppID" value="${data.AppID || ''}" required>
                    <label for="Token">Token</label>
                    <input type="text" id="Token" name="Token" value="${data.Token || ''}" required>
                    <label for="AppSecret">AppSecret</label>
                    <input type="text" id="AppSecret" name="AppSecret" value="${data.AppSecret || ''}" required>
                    <button type="submit" class="submit-edit">保存</button>
                </form>
            </div>
        </div>
        `;

            const modal = new DOMParser().parseFromString(modalHtml, "text/html").body.firstChild;
            return modal;
        }

        function sendEditRequest(id, updatedData, row, modal) {
            const validData = filterValidFields(updatedData);

            if (Object.keys(validData).length === 0) {
                alert('没有有效的更新数据');
                return;
            }

            fetch('updateUser', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id: id, data: validData})
            }).then(response => response.json())
                .then(data => {
                    console.log('Server response:', data);
                    if (data.code === 0) {
                        updateRowData(row, validData);
                        modal.remove();
                        location.reload(); // 刷新页面
                    } else {
                        alert('编辑失败');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function filterValidFields(data) {
            const allowedFields = ['QQ', 'AppID', 'Token', 'AppSecret'];
            return Object.fromEntries(Object.entries(data).filter(([key]) => allowedFields.includes(key)));
        }

        function updateRowData(row, updatedData) {
            Object.keys(updatedData).forEach(key => {
                row.querySelector(`[data-field="${key}"]`).textContent = updatedData[key];
            });
        }
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