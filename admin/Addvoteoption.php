<?php
/**
 * Created by PhpStorm.
 * User: yixue
 * Date: 2018-11-12
 * Time: 16:13
 */
include "../conn.php";
if(!empty($_POST))
{
    $optionname = $_POST['voteoption'];
    $upid = $_POST['subject'];
    $sql = "insert into voteoption(optionname,votenum,upid) values('$optionname',0,'$upid')";
    if($pdo->exec($sql))
    {
        echo "<script>
        alert('投票选项添加成功');
        location.href='Addvoteoption.php';
</script>";
    }else{
        echo "<script>
        alert('投票选项添加失败');
        location.href='Addvoteoption.php';
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
            padding: 30px 135px;
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
            <FORM action="Addvoteoption.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <h3>添加投票选项</h3>
                <DIV class="control-group">
                    <label class="laber_from">投票选项</label>
                    <DIV  class="controls" ><INPUT class="username" style="width:300px;" name="voteoption" type=text placeholder=" 请输入投票选项"><P class=help-block>不要超过20个字</P></DIV>
                </DIV>
                <DIV class="control-group">
                    <label class="laber_from">所属问题</label>
                    <DIV  class="controls" ><select style="width:300px;" name="subject">
                            <option value="" checked>请选择问题</option>
                            <?php
                            $quesSql="select * from votename";
                            $red=$pdo->query($quesSql);
                            while($result=$red->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $result['cid']; ?>"><?php echo $result['question_name']; ?></option>
                            <?php } ?>
                        </select>
                        <P class=help-block></P></DIV>
                </DIV>
                <DIV class="control-group">
                    <LABEL class="laber_from" ></LABEL>
                    <DIV class="controls" ><button class="btn btn-success" style="width:120px;" type="submit">添加选项</button></DIV>
                </DIV>
            </FORM>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
</body>
</html>
