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


function ConfirmPassword($new_password,$ConfirmPassword){
    if($new_password==$ConfirmPassword){
        return true;
    }else{
        return false;
    }
}

function ChangePassword($ConfirmPassword,$user_id,$mysql){
    $sql="UPDATE user SET password=? WHERE id=?";
    $statement=$mysql->prepare($sql);
    $statement->bindParam(1,$ConfirmPassword);
    $statement->bindParam(2,$user_id);
    if($statement->execute()){
        return true;
    }else{
        $errorInfo=$statement->errorInfo()[2];
        echo "<script>alert(`error:$errorInfo`)</script>";
        return false;
    }
}

$new_password=$_POST["new_password"];
$ConfirmPassword=$_POST["ConfirmPassword"];
$user_id=$_SESSION["user_id"];

if(Judge()){
    if(ConfirmPassword($new_password,$ConfirmPassword)){
        $mysql=Connect();
        $flag=ChangePassword($ConfirmPassword,$user_id,$mysql);
        if($flag){
            echo "<script>alert('修改成功')</script>";
            echo '<script>setTimeout(function(){window.location.href="index.php";},500);</script>';
        }else{
            echo "<script>alert('修改失败')</script>";
            echo '<script>setTimeout(function(){window.location.href="index.php";},500);</script>';
        }

    }else{
        echo '<script>alert(`前后密码不一致`)</script>';
        echo '<script>setTimeout(function(){window.location.href="index.php";},500);</script>';
    }
}else{
    echo '<script>alert(`您没有登录`)</script>';
    echo '<script>setTimeout(function () {
        window.location.href=\'../index.html\';
    },500);</script>';
}