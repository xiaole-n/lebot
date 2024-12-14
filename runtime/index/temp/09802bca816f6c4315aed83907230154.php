<?php /*a:1:{s:58:"D:\Desktop\x\php\ThinkPHP\app\index\view\index\layout.html";i:1731324275;}*/ ?>
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