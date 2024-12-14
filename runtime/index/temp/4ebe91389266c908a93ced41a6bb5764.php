<?php /*a:1:{s:56:"D:\Desktop\x\php\ThinkPHP\app\index\view\index\docx.html";i:1732791324;}*/ ?>
<!DOCTYPE html>
<html><head><meta charset="utf-8">

    <title>小乐- User Group</title>
    <meta name="keywords" content="小乐- User Group">
    <meta name="description" content="小乐- User Group 致力于为用户提供稳定、高效、免费的QQ机器人接口调用平台">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.xiaole.work/group/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.xiaole.work/group/css/main.css">
    <link rel="shortcut icon" href="https://cdn.xiaole.work/group/favicon.ico">
</head>
<body>
<div class="navbar custom-navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <div class="navbar-brand">
                <img class="img-l" src="https://cdn.xiaole.work/group/favicon.ico" alt="LOGO" style="display:inline-block;margin-right: 10px;width:32px;height:32px;">
                小乐- User Group
            </div>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a target="_blank" href="https://doc.xiaole.work/#/doc/up" class="smoothScroll">下载</a></li>
                <li><a target="_blank" href="https://api.xiaole.work" class="smoothScroll">接口</a></li>
            </ul>
        </div>
    </div>
</div>
<section id="home" class="parallax-section" style="position: absolute;overflow: hidden;height: 100%;width: 100%;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <h2> 小乐综合 </h2>
                <!--空格占位-->
                <p id="RainbowWord">&nbsp;</p>
                <p style="display: flex;">
                    <a href="https://doc.xiaole.work/" target="_blank" class="btn-a" title="使用手册">使用手册</a>
                    <a href="/public" target="_blank" class="btn-b" title="Home">&lt;/&gt;</a>
                </p>
            </div>
        </div>
    </div>
</section>
<div id="footer" class="noselect">
    <span style="display:inline-block;">? 2024 小乐 All Rights Reserved</span>
    <span style="display:inline-block;">Designed by 小乐</span>
    <div style="display:none;">

    </div>
</div>
<script src="https://cdn.xiaole.work/group/js/jquery.js"></script>
<script src="https://cdn.xiaole.work/group/js/bootstrap.min.js"></script>
<script>
    $(function() {
        $('#RainbowWord').load('https://api.lewz.cn/api/wrwa');
        document.getElementById("home").style.background = 'url("https://cdn.xiaole.work/group/img/background.jpg") center 0px / cover no-repeat';
    });
</script>

</body></html>