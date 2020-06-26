<?php
session_start();

function Judge(){
    if(isset($_SESSION["username"])&&isset($_SESSION["user_id"])){
        return true;
    }else{
        return false;
    }
}
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

function SendComment($nickname,$user_id,$to_message_id,$comment,$mysql){
    $sql="INSERT INTO comment(nickname,user_id,to_message_id,comment) VALUES (:nickname,:user_id,:to_message_id,:comment)";
    $statement=$mysql->prepare($sql);
    $content=array(
        ":nickname" => $nickname,
        ":user_id" => $user_id,
        "to_message_id" => $to_message_id,
        ":comment" => $comment
    );
    if($statement->execute($content)){
        return true;
    }else{
        $errorInfo=$statement->errorInfo();
        echo "<script>alert(`error:$errorInfo[2]`)</script>";
        return false;
    }
}

$to_message_id=$_POST["message_id"];
$comment=$_POST["comment_message"];
$nickname=$_SESSION["nickname"];
$user_id=$_SESSION["user_id"];
$mysql=Connect();

if(Judge()){
    $mysql=Connect();
    $flag=SendComment($nickname,$user_id,$to_message_id,$comment,$mysql);
    if($flag){
        echo "<script>alert(`评论成功！`)</script>";
        echo "<script>setTimeout(function () {
        window.location.href='comment.php';
    },500);</script>";
    }else{
        echo "<script>alert(`评论失败！`)</script>";
        echo "<script>setTimeout(function () {
        window.location.href='comment.php';
    },500);</script>";
    }
}else{

    echo "<script>alert(`您没有登录`)</script>";
    echo "<script>setTimeout(function () {
        window.location.href='../index.html';
    },500);</script>";
}