<?php
/**
 * Created by PhpStorm.
 * User: yixue
 * Date: 2018-11-13
 * Time: 11:39
 */
include "../conn.php";
if($_SESSION['userLog'] == 0){
    header("location:../index.php");
}
$topicSql = "select * from sysconfig";
$topicRes = $pdo->prepare($topicSql);
$topicRes->execute();
$topicResult = $topicRes->fetch(PDO::FETCH_ASSOC);
$arr = [];
$voteSql = "select * from votename";
$voteRes = $pdo->prepare($voteSql);
$voteRes->execute();
while($voteResult = $voteRes->fetch(PDO::FETCH_ASSOC))
{
    array_push($arr,$voteResult['cid']);
}
if(!isset($_GET['cid']))
{
    $cid = $arr[0];
}else{
    $cid = $_GET['cid'];
}
$i = isset($_SESSION['i'])? $_SESSION['i'] : 0;
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
    <script>
        function change() {
            var img = document.getElementById('Img');
            img.src = "../public/captcha.php?rnd=" + Math.random();
        }
        function chkform() {
            var YZM = document.getElementById('yzm');
            if(YZM.value == '')
            {
                alert('请输入验证码');
                YZM.focus();
                return false;
            }
            var node = document.getElementsByName('optionname');
            var sum = 0;
            for(var i = 0;i<node.length;i++)
            {
                if(node[i].checked == true)
                {
                    sum++;
                }
            }
            if(sum == 0)
            {
                alert('请选择一项');
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h2><?php echo $topicResult['vote_name']; ?></h2>
            <p style="margin-top: 20px;color: gray;"><?php echo $topicResult['description']; ?></p>
            <form action="addVote.php?cid=<?php echo $cid; ?>" method="post" onsubmit="return chkform();">
            <p style="margin-top: 80px;font-size: 1.5em;">
                <?php
                $quesSql = "select * from votename where cid = ?";
                $quesRes = $pdo->prepare($quesSql);
                $quesRes->execute(array($cid));
                $quesResult = $quesRes->fetch(PDO::FETCH_ASSOC);
                    echo $quesResult['question_name'] . "<br>";
                    $opSql = "select * from voteoption where upid = ?";
                    $opRes = $pdo->prepare($opSql);
                    $opRes->execute(array($cid));
                    while($opResult = $opRes->fetch(PDO::FETCH_ASSOC))
                    {
                        ?>
                        <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <?php echo "<input type='radio' name='optionname' value='{$opResult['optionname']}'/>" . $opResult['optionname']; ?>
                </div>
            </div>
                <?php
                    }
                ?>
            </p>
            <p>
                <input type="text" name="vscode" placeholder="请输入验证码" id="yzm">
                <img src="../public/captcha.php" alt="" onclick="change()" id="Img">
                <input class="btn btn-default" value="确定投票" type="submit" />
            </p>
            </form>
            <p style="margin-top: 100px;">
                <a href="index.php?cid=<?php
                if($_SESSION['i']<count($arr)-1){
                    $_SESSION['i']++;
                    echo $arr[$i];
                }else{
                    $_SESSION['i'] = 0;
                    echo $arr[$i];
                }
                ?>" class="btn btn-default">换一个</a>
            </p>
            <p>
                <a href="showIndexMsg.php?cid=<?php echo $cid; ?>" class="btn btn-default">查看投票数据 </a>
            </p>
        </div>
        <div class="col-md-4">
            <a href="quitUsrLog.php" class="btn btn-default" style="margin-top: 20px;">注销登录 </a>
            <a href="../index.php" class="btn btn-default" style="margin-top: 20px;">管理员登录 </a>
        </div>
    </div>
</body>
</html>