<?php
include "conn.php";
if(($_SESSION['adminLog'] == 0)){
    header("location:Index.php");
}
?>
<div class="col-md-4">
    <div class="col-md-6"></div>
    <div class="col-md-2">
        <a href="Quitlog.php" class="btn btn-default" style="margin-right: 20px;">退出登录</a>
    </div>
    <div class="col-md-4">
        <div class="list-group btn-group">
            <a class="list-group-item" href="Voteset.php">投票设置</a>
            <a class="list-group-item" href="Showdata.php">投票数据查看</a>
            <button type="button" class="btn btn-default dropdown-toggle list-group-item" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">投票管理 <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="Addsubject.php">添加投票题目</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="Addvoteoption.php">添加投票选项</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="Managesubject.php">管理投票题目</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="Manageoption.php">管理投票选项</a></li>
            </ul>
        </div>
    </div>
</div>