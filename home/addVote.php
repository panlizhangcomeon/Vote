<?php
/**
 * Created by PhpStorm.
 * User: yixue
 * Date: 2018-11-13
 * Time: 19:21
 */
include "../conn.php";
$id = $_GET['cid'];
$optionname = $_POST['optionname'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
if($_SESSION['yzm'] == $_POST['vscode'])
{
    $sql = "select * from users where cid = ? and username = ? and password = ? and isvote = 1";
    $res = $pdo->prepare($sql);
    $res->execute(array($id,$username,$password));
    $row = $res->rowCount();
    $tSql = "select * from sysconfig where sid = 1";
    $tRes = $pdo->prepare($tSql);
    $tRes->execute();
    $tResult = $tRes->fetch(PDO::FETCH_ASSOC);
    $time = date("Y-m-d",time());
    if($time >= $tResult['dietime'])
    {
        echo "<script>
alert('投票时间已过');
location.href='index.php?cid=$id';
</script>";
    }else{
        if($row > 0)
        {
            echo "<script>
alert('该问题您已经投过票了');
location.href='index.php?cid=$id';
</script>";
        }else{
            $voteSql = "update voteoption set votenum = votenum + 1 where upid = ? and optionname = ?";
            $voteRes = $pdo->prepare($voteSql);
            $n = $voteRes->execute(array($id,$optionname));
            if($n > 0)
            {
                $sumSql = "update votename set sumvotenum = sumvotenum + 1 where cid = ?";
                $sumRes = $pdo->prepare($sumSql);
                $sumRes->execute(array($id));
                $userSql = "insert into users(cid,username,password,isvote) values(?,?,?,1)";
                $userRes = $pdo->prepare($userSql);
                $userRes->execute(array($id,$username,$password));
                echo "<script>
alert('投票成功');
location.href='index.php?cid=$id';
</script>";
            }else{
                echo "<script>
alert('投票失败');
location.href='index.php?cid=$id';
</script>";
            }
        }
    }
}else{
    echo "<script>
alert('验证码错误');
location.href='index.php?cid=$id';
</script>";
}
?>