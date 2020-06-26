<?php
session_start();
require_once ("../normal.php");

function RemoveMessage($id,$mysql){
    $sql="DELETE FROM message WHERE id=$id";
    if($statement=$mysql->exec($sql)){
        return true;
    }else{
        $errorInfo=$statement->errorInfo()[2];
        echo "<script>alert(`error:$errorInfo`)</script>";
        return false;
    }
}

function RemoveComment($id,$mysql){
    $sql="DELETE FROM comment WHERE to_message_id=$id";
    if($statement=$mysql->exec($sql)){
        return true;
    }else{
        $errorInfo=$mysql->errorInfo()[2];
        echo "<script>alert(`error:$errorInfo`)</script>";
        return false;
    }
}


$id=$_POST["id"];
if(Judge()){
    $mysql=Connect();
    $flag=RemoveMessage($id,$mysql);
    $flag_2=RemoveComment($id,$mysql);
    if($flag&&$flag_2){
        echo "<script>alert('删除成功')</script>";
    }else{
        echo "<script>alert('删除失败')</script>";
    }

}else{
    echo '<script>alert(`您没有登录`)</script>';
}


