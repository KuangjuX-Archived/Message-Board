<?php
session_start();
function Connect(){
    $DSN = "mysql:host=127.0.0.1:3306;dbname=message_board";
    $USER_NAME = "root";
    $PASSWORD = "";

    try{
        $conn = new PDO($DSN,$USER_NAME,$PASSWORD);
        $conn->query("set names utf8");
        return $conn;
    }catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function GetMaxID($mysql){
    $sql="SELECT MAX(id) FROM message";
    $num=$mysql->query($sql)->fetch()[0];
    return $num;
}

//获取留言
function FetchMessage($mysql,$num){
    $query="SELECT * FROM message WHERE id=$num";
    $statement=$mysql->query($query);
    $result=$statement->fetchAll();
    return $result;
}

//获取评论
function FetchComment($mysql,$num){
    $query="SELECT * FROM comment WHERE to_message_id=$num";
    $statement=$mysql->query($query);
    $result=$statement->fetchAll();
    return $result;
}
$mysql=Connect();
$num=GetMaxID($mysql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
<div class="lampshade" id="lampshade"></div>
<div class="comment" id="comment">
    <div class="header">
        <div class="fork" onclick="fade()"></div>
    </div>
    <form method="post" action="SendComment.php">
        <p class="innerBox"><strong>留言ID:</strong>&emsp;&emsp;<input class="block" type="text" id="message_id" name="message_id"></p>
        <p class="innerBox AddHeight"><strong class="float">评论：</strong>&emsp;&emsp;<textarea class="comment" id="comment" name="comment" rows="5" ></textarea> </p>
        <p class="center"><input type="submit" value="评论"></p>
    </form>
</div>
<h1 style="text-align: center">评论</h1>
<div class="container" id="container">
    <div class="row">
        <div class="col-2">
            <div class="list-group">
                <a class="list-group-item list-group-item-action list-group-item-primary" onclick="change(`index.php`)">主页</a>
                <a class="list-group-item list-group-item-action list-group-item-secondary" onclick="change(`../MessageBoard.html`)">留言</a>
                <a class="list-group-item list-group-item-action list-group-item-success" onclick="change(`comment.php`)">评论</a>
                <a class="list-group-item list-group-item-action list-group-item-danger" onclick="change(`LogOut.php`)">登出</a>
                <a class="list-group-item list-group-item-action list-group-item-warning" onclick="alert(`该功能尚未开发`)">更多</a>
            </div>
        </div>
        <div class="col-8">
                <?php
                for ($i=1;$i<=$num;$i++){
                    $result=array();
                    $comment=array();
                    if(!empty(FetchMessage($mysql,$i))){
                        $result=FetchMessage($mysql,$i)[0];
                        $comment=FetchComment($mysql,$i);
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<h2 class='card-title'>"."<strong>留言者：&emsp;</strong>".$result["nickname"]."</h2>";
                        echo "<h3 class='card-title'>"."<strong>主题：&emsp;</strong>".$result["topic"]."</h3>";
                        echo "<p class='card-text'>".$result["message"]."</p>";
                        for($j=0;$j<count($comment);$j++){
                            echo "<div class='card-header'>";
                            echo  "<h5 class='card-text>'"."<strong>评论者:&emsp;</strong>".$comment[$j]["nickname"];
                            echo "<p class='card-text'>".$comment[$j]["comment"]."</p>";
                            echo "</div>";
                            echo "</br>";
                        }
                        echo "</div>";
                        echo "<a href=\"#\" class=\"btn btn-primary\" onclick='comment($i)'>评论</a>";
                        echo "</div>";
                        echo "</br>";
                    }

                }

                ?>
            </div>
        </div>
</div>

</div>
<script src="../js/script.js"></script>
</body>
</html>
