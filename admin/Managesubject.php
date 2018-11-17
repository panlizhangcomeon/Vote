<?php
/**
 * Created by PhpStorm.
 * User: yixue
 * Date: 2018-11-12
 * Time: 16:57
 */
include "../conn.php";
if(isset($_GET['do']))
{
    if($_GET['do'] == 'change' && $_GET['type'] == 'exec')
    {
        $mid = $_GET['id'];
        $question_name = $_POST['question_name'];
        $msql = "update votename set question_name = '$question_name' where cid = ?";
        $mres = $pdo->prepare($msql);
        if($mres->execute(array($mid)))
        {
            echo "<script>
                    alert('修改成功');
                    location.href = 'Managesubject.php';
                  </script>";
        }else{
            echo "<script>
                    alert('修改失败');
                    location.href = 'Managesubject.php';
                  </script>";
        }
    }

    if($_GET['do'] == 'delete')
    {
        $did = $_GET['id'];
        $dsql = "delete from votename where cid in ($did)";
        $dres = $pdo->prepare($dsql);
        if($dres->execute())
        {
            $opSql = "delete from voteoption where upid in ($did)";
            $opred = $pdo->prepare($opSql);
            $opred->execute();
            echo "<script>
                    alert('删除成功');
                    location.href = 'Managesubject.php';
                  </script>";
        }else{
            echo "<script>
                    alert('删除失败');
                    location.href = 'Managesubject.php';
                  </script>";
        }
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
    <script>
        function selectAll()
        {
            var node = document.getElementsByName('checkboxitem');
            for(var i = 0;i<node.length;i++)
            {
                node[i].checked = true;
            }
        }
        function unSelectAll()
        {
            var node = document.getElementsByName('checkboxitem');
            for(var i = 0;i<node.length;i++)
            {
                node[i].checked = false;
            }
        }
        function deleteSelect()
        {
            var node = document.getElementsByName('checkboxitem');
            var id = '';
            for(var i = 0;i<node.length;i++)
            {
                if(node[i].checked)
                {
                    if(id == '')
                    {
                        id = node[i].value;
                    }else{
                        id = id + ',' + node[i].value;
                    }
                }
            }
            if(id == '')
            {
                alert('请选择删除项');
            }else{
                location.href = 'Managesubject.php?do=delete&id=' + id;
            }
        }
    </script>
</head>
<body>
<div class="row">
    <?php
    include "../common.php";
    ?>
    <div class="col-md-7">
        <div class="border">
            <FORM action="Managesubject.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <h3>管理投票题目</h3>
                <table class="table table-hover" width="800px">
                    <tr>
                        <td>ID</td>
                        <td>投票问题</td>
                        <td>修改</td>
                        <td>删除</td>
                    </tr>
                    <?php
                    $res = $pdo->query("select * from votename");
                    while($result = $res->fetch(PDO::FETCH_ASSOC))
                    {
                        ?>
                        <tr>
                            <td><input type="checkbox" name="checkboxitem" value="<?php echo $result['cid']; ?>"><?php echo $result['cid']; ?></td>
                            <td><?php echo $result['question_name']; ?></td>
                            <td><a href="Managesubject.php?do=change&id=<?php echo $result['cid']; ?>&type=show" class="btn btn-default">修改</a></td>
                            <td><a href="Managesubject.php?do=delete&id=<?php echo $result['cid']; ?>" class="btn btn-default">删除</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td colspan="3">
                            <button class="btn btn-default" onclick="selectAll()" type="button">全选</button>&nbsp;&nbsp;
                            <button class="btn btn-default" onclick="unSelectAll()" type="button">取消全选</button>&nbsp;&nbsp;
                            <button class="btn btn-default" onclick="deleteSelect()" type="button">删除所选</button>
                        </td>
                    </tr>
                </table>
            </FORM>
            <?php
            $id = isset($_GET['id'])? $_GET['id'] : '';
            if(isset($_GET['do']))
            {
            if($_GET['do'] == 'change' && $_GET['type'] == 'show')
            {
                $updSql = "select * from votename where cid = ?";
                $res = $pdo->prepare($updSql);
                $res->execute(array($id));
                $updResult = $res->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="form-group">
                <form action="Managesubject.php?do=change&id=<?php echo $id; ?>&type=exec" method="post">
                <label for="exampleInputQuestion">问题</label>
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="exampleInputQuestion" value="<?php echo $updResult['question_name']; ?>" name="question_name">
                    </div>
                    <div class="col-md-4">
                        <input class="btn btn-default" value="确认修改" type="submit"/>
                    </div>
                </div>
                </form>
            </div>
            <?php }} ?>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
</body>
</html>

