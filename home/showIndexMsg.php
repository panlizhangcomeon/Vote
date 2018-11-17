<?php
/**
 * Created by PhpStorm.
 * User: yixue
 * Date: 2018-11-12
 * Time: 11:51
 */
include "../conn.php";
$cid = $_GET['cid'];
$sql = "select * from votename where cid = ?";
$result = $pdo->prepare($sql);
$result->execute(array($cid));
?>





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
    <style>
        .border{
            margin-left: -60px;
            border: 1px lightgray solid;
            padding: 30px 55px;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="border">
            <h3>投票数据查看</h3>
            <?php
            $row = $result->fetch(PDO::FETCH_ASSOC);
                ?>
                <p>
                <?php echo $row['question_name']; ?><br>
                <?php
                $upid = $row['cid'];
                $upSql = "select * from voteoption where upid = ?";
                $upRes = $pdo->prepare($upSql);
                $upRes->execute(array($upid));
                while($upResult = $upRes->fetch(PDO::FETCH_ASSOC))
                {
                    ?>
                    <div class="row">
                        <div class="col-md-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $upResult['optionname']; ?></div>
                        <div class="col-md-4"><?php echo $upResult['votenum']; ?>票</div>
                        <div class="col-md-4"><?php echo round($upResult['votenum']/$row['sumvotenum']*100,2) . "%"; ?></div>
                    </div>
                    <br />
                    <?php
                }
                ?>
                </p>
            <p>
                <a href="index.php?cid=<?php echo $cid; ?>" class="btn btn-default">返回投票</a>
            </p>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
</body>
</html>
