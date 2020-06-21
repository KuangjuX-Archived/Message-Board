<?php

session_start();
header("Content-Type: text/html;charset=utf-8");
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

function SendMessage($user_id,$username,$message,$topic,$mysql){
    $query="INSERT INTO message(user_id,nickname,topic,message) VALUES (:user_id,:nickname,:topic,:message)";
    $stmt=$mysql->prepare($query);
    //绑定参数
    $stmt->bindParam(":user_id",$user_id);
    $stmt->bindParam(":nickname",$username);
    $stmt->bindParam(":topic",$topic);
    $stmt->bindParam(":message",$message);
    if($stmt->execute()){
        return true;
    }else{
        var_dump($stmt->execute());
        return false;
    }
}


$message=$_POST["message"];
$topic=$_POST["topic"];
$user_id=intval($_SESSION["user_id"]);
$nickname=$_SESSION["nickname"];

if(Judge()){
    $mysql=Connect();
    $flag=SendMessage($user_id,$nickname,$message,$topic,$mysql);
    if($flag){
        echo "<script>setTimeout(function(){
        window.location.href='../MessageBoard.html';
    },500);</script>";
        echo "<script>alert(`留言成功！`)</script>";
    }else{
        echo "<script>alert(`留言失败！`)</script>";
        echo "<script>setTimeout(function () {
        window.location.href='../MessageBoard.html';
    },500);</script>";
    }
}else{

    echo "<script>alert(`您没有登录`)</script>";
    echo "<script>setTimeout(function () {
        window.location.href='../index.html';
    },500);</script>";
}