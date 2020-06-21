<?php
/*Some normal function*/
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