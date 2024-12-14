<?php /*a:1:{s:63:"D:\Desktop\x\php\ThinkPHP\app\index\view\index\login\login.html";i:1732344192;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录页面</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://t.alcy.cc/moez'); /* 设置背景图片 */
            background-size: cover; /* 图片自适应屏幕大小 */
            background-position: center; /* 图片居中显示 */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-size: 18px;
        }
        .login-form {
            background: rgba(255, 255, 255, 0.8); /* 半透明背景 */
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 400px;
            max-width: 90%; /* 确保在小屏幕上不会超出边界 */
        }
        .login-form h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #666;
            font-size: 16px;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }
        .form-group input:focus {
            border-color: #007BFF;
            outline: none;
        }
        .forget-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px; /* 增加与登录按钮的间距 */
        }
        .forget-account {
            font-size: 14px;
            color: #007BFF;
            text-decoration: none; /* 删除下划线 */
        }
        .form-group button {
            width: 100%;
            padding: 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 20px;
            text-align: center;
            color: red;
            font-size: 16px;
        }
        .success-message {
            color: green;
        }

        /* 媒体查询，针对小屏幕设备 */
        @media (max-width: 600px) {
            body {
                font-size: 16px;
            }
            .login-form {
                padding: 20px;
                width: 100%;
                box-shadow: 0 0 15px rgba(0,0,0,0.1);
            }
            .login-form h2 {
                font-size: 20px;
            }
            .form-group input {
                padding: 10px;
            }
            .form-group button {
                padding: 12px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
<div class="login-form">
    <h2>登录</h2>
    <form id="loginForm" action="<?php echo url('index/handleLogin'); ?>" method="post">
        <div class="form-group">
            <label for="username">账号:</label>
            <input type="text" id="username" name="username" placeholder="请输入账号">
        </div>
        <div class="form-group">
            <label for="password">密码:</label>
            <input type="password" id="password" name="password" placeholder="请输入密码">
        </div>
        <div class="forget-container">
            <div></div> <!-- 空的 div 用于平衡布局 -->
            <a href="#" class="forget-account">忘记密码？</a>
        </div>
        <div class="form-group">
            <button type="submit">登录</button>
        </div>
    </form>
    <div id="message" class="message"></div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // 阻止表单默认提交行为

        const formData = new FormData(this);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', this.action, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const messageDiv = document.getElementById('message');
                messageDiv.textContent = response.msg;

                if (response.code === 0) {
                    messageDiv.classList.add('success-message');
                    setTimeout(function() {
                        window.location.href = '<?php echo url("../"); ?>'; // 跳转到指定页面
                    }, 2000); // 延迟2秒
                } else {
                    messageDiv.classList.remove('success-message');
                }
            }
        };
        xhr.send(formData);
    });
</script>
</body>
</html>