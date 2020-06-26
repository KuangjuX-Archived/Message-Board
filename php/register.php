<?php
session_start();
function Connect(){
    $DSN = "mysql:host=127.0.0.1:3306;dbname=message_board";
    $USER_NAME = "root";
    $PASSWORD = "";

    try{
        $conn = new PDO($DSN,$USER_NAME,$PASSWORD);
        return $conn;
    }catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

/*检查是否有相同的用户名*/
function Check($username,$mysql){
    $query="SELECT username FROM user";
    $statement=$mysql->prepare($query);
    $statement->execute();
    $content=$statement->fetchAll();
    for($i=0;$i<count($content);$i++){
        if($content[$i]["username"]==$username){
            return false;
        }
    }
    return true;

}
function Register($username,$password,$mysql){
    $query="INSERT INTO user (username,password,nickname) VALUES (:username,:password,:nickname)";
    $statement=$mysql->prepare($query);
    $statement->bindParam(":username",$username);
    $statement->bindParam(":password",$password);
    $statement->bindParam(":nickname",$username);
    if($statement->execute()){
        return true;
    }else{
        return false;
    }
}

$mysql=Connect();

$check=Check($_POST["username"],$mysql);

//$flag=Register($_POST["username"],$_POST["password"],$mysql);
if($check){
    $flag=Register($_POST["username"],md5($_POST["password"]),$mysql);
}else{
    $flag=0;
    echo "<script>alert(`用户名已存在`)</script>";
}
//跳转
if($flag){
    echo "<script>alert(`注册成功`)</script>";
    echo "<script>setTimeout(function () {
        window.location.href=`../index.html`;},500);</script>";
}else{
    echo "<script>alert(`注册失败`)</script>";
    echo "<script>setTimeout(function () {
        window.location.href=`../register.html`;},500);</script>";
}
