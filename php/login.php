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
        }
    }
    function VerifyPassword($username,$password,$mysql){
        $query="SELECT id,username,password,nickname,email FROM user";
        $statement=$mysql->prepare($query);
        $statement->execute();
        $content=$statement->fetchAll();
        for($i=0;$i<count($content);$i++){
            if($username==$content[$i]["username"]&&md5($password)==$content[$i]["password"]){
                $_SESSION["username"]=$username;
                $_SESSION["nickname"]=$content[$i]["nickname"];
                $_SESSION["email"]=$content[$i]["email"];
                $_SESSION["user_id"]=$content[$i]["id"];
                return true;
            }
        }
        return false;

    }

    $mysql=Connect();
    $flag=VerifyPassword($_POST["username"],$_POST["password"],$mysql);

    if($flag){
        echo "<script>alert(`登录成功`)</script>";
        echo "<script>setTimeout(function () {
        window.location.href=`index.php`;},500);</script>";
    }else{
        echo "<script>alert(`登录失败`)</script>";
        echo "<script>setTimeout(function () {
        window.location.href=`../index.html`;},500);</script>";
    }