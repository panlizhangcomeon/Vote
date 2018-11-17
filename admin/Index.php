<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function reImg() {
            var img = document.getElementById('Img');
            img.src = "../public/captcha.php?rnd=" + Math.random();
        }
        function checkform(form) {
            var sid = document.getElementById("exampleInputText");
            var password = document.getElementById("exampleInputPassword1");
            var yzm = document.getElementById("exampleInputyzm");
            if(sid.value==""){
                alert('请输入学号');
                sid.focus();
                return false;
            }
            if(password.value==""){
                alert('请输入密码');
                password.focus();
                return false;
            }
            if(yzm.value==""){
                alert('请输入验证码');
                yzm.focus();
                return false;
            }
        }
    </script>
</head>
<body>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h1>投票管理系统---后台登录</h1>
        <form action="Chklogin.php" method="post" onsubmit="return checkform();">
            <div class="form-group">
                <label for="exampleInputText">用户名</label>
                <input type="text" class="form-control" id="exampleInputText" placeholder="请输入用户名" name="username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密码</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码" name="password">
            </div>
            <div class="form-group">
                <label for="exampleInputyzm">验证码 <img src="../public/captcha.php" alt="" onclick="reImg()" id="Img"></label>
                <input type="text" class="form-control" id="exampleInputyzm" placeholder="请输入验证码" name="YZM">
            </div>
            <button type="submit" class="btn btn-default">登录</button>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>
</body>
</html>