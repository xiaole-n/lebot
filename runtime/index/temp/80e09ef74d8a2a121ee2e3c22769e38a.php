<?php /*a:1:{s:55:"D:\Desktop\x\php\ThinkPHP\app\index\view\index\add.html";i:1731314411;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>默认标题</title>
    <!-- 引入公共CSS和JS文件 -->
    
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function loadContent(contentId) {
            $.ajax({
                url: 'add1.php', // 修改为您的实际路径
                type: 'GET',
                success: function(data) {
                    $('#main-content').html(data);
                },
                error: function() {
                    alert('加载出错，请重试！');
                }
            });
        }
    </script>
    
</head>
<body>
<div class="container">
    <div id="sidebar">
        <button onclick="loadContent('content1')">内容1</button>
        <button onclick="loadContent('content2')">内容2</button>
    </div>
    <div id="main-content">
        
        <a href="add1.html">1</a>
        <a href="add2.html">2</a>
        
    </div>
</div>
</body>
</html>