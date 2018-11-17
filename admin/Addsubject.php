<?php
/**
 * Created by PhpStorm.
 * User: yixue
 * Date: 2018-11-12
 * Time: 15:47
 */
include "../conn.php";
if(!empty($_POST))
{
    $question_name = $_POST['votesubject'];
    $sql = "insert into votename(question_name) values('$question_name')";
    if($pdo->exec($sql))
    {
        echo "<script>
        alert('投票题目添加成功');
        location.href='Addsubject.php';
</script>";
    }else{
        echo "<script>
        alert('投票题目添加失败');
        location.href='Addsubject.php';
</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .border{
            margin-left: -60px;
            border: 1px lightgray solid;
            padding: 30px 165px;
        }
    </style>
</head>
<body>
<div class="row">
    <?php
    include "../common.php";
    ?>
    <div class="col-md-4">
        <div class="border">
            <form action="Addsubject.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <h3>添加投票题目</h3>
                <div class="control-group">
                    <label class="laber_from">投票问题</label>
                    <div  class="controls" ><input class="username" style="width:300px;" name="votesubject" type="text" placeholder="请输入投票问题"><P class=help-block></P></div>
                </div>

                <div class="control-group">
                    <label class="laber_from" ></label>
                    <div class="controls" ><button class="btn btn-success" style="width:120px;" type="submit">添加问题</button></div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
</body>
</html>
