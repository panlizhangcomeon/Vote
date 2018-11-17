<?php
/**
 * Created by PhpStorm.
 * User: yixue
 * Date: 2018-11-12
 * Time: 11:51
 */
include "../conn.php";
if(!empty($_POST)){
    $votename=$_POST['votename'];
    $description=$_POST['description'];
    $dietime=$_POST['dieddate'];
    $method=$_POST['method'];
    $sql="update sysconfig set vote_name='$votename',dietime='$dietime',method='$method',description='$description' where sid='1'";
    if($pdo->exec($sql)){
        echo "<script>
        alert('配置保存成功');
        location.href='Voteset.php';
</script>";
    }else{
        echo "<script>
        alert('配置保存失败');
        location.href='Voteset.php';
</script>";
    }
}
$resultSql="select * from sysconfig where sid='1'";
$result=$pdo->query($resultSql);
$row=$result->fetch(PDO::FETCH_ASSOC);
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
                        <h3>投票主题管理</h3>
                        <form action="Voteset.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                            <div class="control-group">
                                <label class="laber_from">投票主题</label>
                                <div  class="controls" ><input class="username" name="votename" type=text value="<?php echo $row['vote_name']; ?>"><p class=help-block></p></div>
                            </div>

                            <div class="control-group">
                                <label class="laber_from">投票描述</label>
                                <div  class="controls" >
                                    <textarea name="description" cols="" rows="" ><?php echo $row['description'];?></textarea>
<p class=help-block></p>
</div>
</div>
                            <div class="control-group">
                                <label class="laber_from">投票题目类型</label>
                                <div  class="controls" >
                                    <select name="method" id="">
                                        <option value="0">单选题</option>
                                        <option value="1">多选题</option>
                                    </select>
                                    <p class=help-block></p>
                                </div>
                            </div>

<div class="control-group">
    <label class="laber_from">投票终止时间</label>
    <div  class="controls" >
        <input name="dieddate" type="text" value="<?php echo $row['dietime']; ?>" id="control_date" size="10" maxlength="10"/>
        <p class=help-block></p>
    </div>
</div>
<div class="control-group">
    <label class="laber_from" ></label>
    <div class="controls" ><button class="btn btn-success" style="width:80px;" type="submit">保存配置</button>
    </div>
</div>
</form>
</div>
</div>
<div class="col-md-4"></div>
</div>
</body>
</html>
