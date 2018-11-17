<?php
/**
 * Created by PhpStorm.
 * User: yixue
 * Date: 2018-11-13
 * Time: 16:45
 */
include "../conn.php";
$username = $_POST['username'];
$password = $_POST['password'];
$admSql = "select * from users where username = ? and password = ?";
$admRes = $pdo->prepare($admSql);
$admRes->execute(array($username,$password));
$admResult = $admRes->fetch(PDO::FETCH_ASSOC);
$row = $admRes->rowCount();
if($_SESSION['yzm'] == $_POST['YZM'])
{
    if($row > 0)
    {
        if($admResult['isadmin'] == 1)
        {
            $_SESSION['adminLog'] = 1;
            echo "<script>
alert('管理员登录成功');
location.href='Voteset.php';
</script>";
        }else{
            $_SESSION['userLog'] = 1;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            echo "<script>
alert('用户登录成功');
location.href='../home/index.php';
</script>";
        }
    }else{
        echo "<script>
alert('登录失败');
history.back(-1);
</script>";
    }

}else{
    echo "<script>
alert('验证码错误');
history.back(-1);
</script>";
}