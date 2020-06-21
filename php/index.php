<?php
session_start();
$user_id=$_SESSION["user_id"];
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

function FetchMessage($user_id,$mysql){
    $query="SELECT * FROM message WHERE user_id=$user_id";
    $statement=$mysql->query($query);
    $result=$statement->fetchAll();
    return $result;
}

$mysql=Connect();
$result=FetchMessage($user_id,$mysql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人信息</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/individual.css">
    <style>
        img.avatar{
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        span.span{
            margin-left: 84px;
            color: rgba(150,18,128,0.5);
            font-size: 0.8rem;
        }
        span.span:hover{
            background-color: burlywood;
            text-decoration: underline rgba(150,18,128,0.5);
            cursor: pointer;
        }
        .hidden{
            display: none;
            z-index: 1500;
        }

        div.LBox{
            width: 600px;
            height: 450px;
            position: absolute;
            z-index: 1500;
            display: none;
            margin-left: 30%;
            margin-top: 8%;
            /*border: black 3px solid;*/
            border-radius: 7%;
        }

        div .box4{
            margin: 10px;
        }

        div.fork{
            width: 35px;
            height: 35px;
            margin-left: 90%;
            background-image: url("../icon/return.png");
            background-repeat: no-repeat;
            background-size: cover;
        }

        div.fork:hover{
            opacity: 0.5;
            border-bottom: cornflowerblue 2px solid;
        }
    </style>
</head>
<body>
<div class="lampshade" id="lampshade"></div>
<div class="LBox hidden" id="LBox">
    <div class="box4">
        <div class="card" id="upload-avatar">
            <form method="post" action="UploadAvatar.php" enctype="multipart/form-data">
                <h2 class="card-header">
                    更改头像
                    <div class="fork" onclick="disappear()"></div>
                </h2>
                <div class="card-body">
                    <div class="card-text">
                        <div class="form-group">
                            <label for="avatar">选择头像</label>
                            <p><input type="file" class="form-control-file" id="avatar" name="avatar"></p>
                            <p><input type="submit" class="btn btn-primary" value="提交"></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<h1 style="text-align: center;color: lightslategray">个人主页</h1>
<div class="container" id="container">
    <div class="row">
        <div class="col-2">
            <div class="list-group">
                <a class="list-group-item list-group-item-action list-group-item-primary" onclick="change(`index.php`)">主页</a>
                <a class="list-group-item list-group-item-action list-group-item-secondary" onclick="change('../MessageBoard.html')">留言</a>
                <a class="list-group-item list-group-item-action list-group-item-success" onclick="change(`comment.php`)">评论</a>
                <a class="list-group-item list-group-item-action list-group-item-danger" onclick="change(`LogOut.php`)">登出</a>
                <a class="list-group-item list-group-item-action list-group-item-warning" onclick="alert(`该功能尚未开发`)">更多</a>
            </div>
        </div>
        <div class="col-8">
            <h2 style="font-size: 25px;"><strong>你好,<?php echo $_SESSION['nickname']; ?></strong></h2>
            <div class="card information" id="information">
                <div class="card-body">
                    <div class="card-text">
                        <p><strong>头像:&emsp;&emsp;<img src=" <?php
                                $mysql=Connect();
                                $user_id=$_SESSION["user_id"];
                                $sql="SELECT avatar FROM user WHERE id=?";
                                $url="";

                                $statement1=$mysql->prepare($sql);
                                $statement1->bindParam(1,$user_id);
                                $result1=$statement1->execute();
                                if($result1){
                                    $url=$statement1->fetchAll()[0]["avatar"];
                                    echo $url;
                                }else{
                                    echo "";
                                }
                                ?> " class="avatar"></strong>
                            <span class="span" onclick="Lampshade()">更改>></span>
                        </p>
                        <p></p>
                        <p><strong>用户名:&emsp;&emsp;</strong><?php echo $_SESSION["username"] ?></p>
                        <p><strong>昵称:</strong>&emsp;&emsp;&emsp;<?php echo $_SESSION["nickname"] ?></p>
                        <p><strong>邮箱:</strong>&emsp;&emsp;&emsp;<?php echo $_SESSION["email"] ?></p>
                    </div>
                </div>
            </div>
            <br/>

            <!--修改密码-->
            <h3 style="color: lightslategray">修改密码</h3>
            <div class="card information">
                <form method="post" action="ChangePassword.php">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-group">
                                <label for="new_password">新密码</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                <small id="passwordHelp" class="form-text text-muted">我们将不会泄露您的密码</small>
                                <div class="invalid-feedback" id="message-invalid">
                                    请填写密码
                                </div>
                                <div class="valid-feedback" id="message-valid">
                                    密码已填写
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ConfirmPassword">确认密码</label>
                                <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" required>
                            </div>
                            <div class="invalid-feedback" id="message-invalid">
                                请确认密码
                            </div>
                            <div class="valid-feedback" id="message-valid">
                                已确认
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">检查</label>
                            </div>
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </div>
                </form>
            </div>
            <br/>
            <h3 style="color: lightslategray">修改邮箱</h3>
            <!-- 修改邮箱-->
            <div class="card information">
                <form action="ChangeEmail.php" method="post">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-group">
                                <label for="new_password">邮箱</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email'] ?>" required readonly>
                                <small id="passwordHelp" class="form-text text-muted">我们将不会泄露您的邮箱</small>
                            </div>
                            <div class="form-group">
                                <label for="ConfirmPassword">新的邮箱</label>
                                <input type="email" class="form-control" id="new_email" name="new_email" required>
                            </div>
                            <div class="invalid-feedback" id="message-invalid">
                                请填写邮箱
                            </div>
                            <div class="valid-feedback" id="message-valid">
                                已填写
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">检查</label>
                            </div>
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </div>
                </form>
            </div>
            <br/>

            <h3 style="color: lightslategray">修改昵称</h3>
            <!-- 修改昵称-->
            <div class="card information">
                <form action="ChangeNickname.php" method="post">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-group">
                                <label for="new_password">昵称</label>
                                <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $_SESSION['nickname'] ?>" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="ConfirmPassword">新的昵称</label>
                                <input type="text" class="form-control" id="new_nickname" name="new_nickname" required>
                            </div>
                            <div class="invalid-feedback" id="message-invalid">
                                请填写昵称
                            </div>
                            <div class="valid-feedback" id="message-valid">
                                已填写
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">检查</label>
                            </div>
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </div>
                </form>
            </div>
            <br/>

                    <?php
                        for($i=0;$i<count($result);$i++){
                            echo '<div class="card information">';
                            if($i==0){echo '<h2 class="card-header">您的留言</h2>';}
                            $id=$result[$i]["id"];
                            echo '<form action="RemoveMessage.php" method="post">';
                            echo '<div class="card-body">';
                            echo "<input type='hidden' value=$id name='id'>";
                            echo "<h5 class='card-title'><strong>主题：</strong>".$result[$i]["topic"]."</h5>";
                            echo '<p class="card-text"><strong>内容：</strong>'.$result[$i]["message"].'</p>';
                            echo '<input type="submit" name="删除" value="删除" class="btn btn-primary">';
                            echo '</div>';
                            echo '</form>';
                            echo '</div>';
                            echo '</br>';
                        }
                    ?>

        </div>
    </div>

</div>

<script>
let container=document.getElementById("container");
let lampshade=document.getElementById("lampshade");
let LBox=document.getElementById("LBox");
function Lampshade() {
    container.style.filter = "blur(5px)";
    /*lampshade.style.display = "block";*/
    LBox.style.display = "block";

}

function disappear() {
    container.style.filter="";
    LBox.style.display="none";
}

function handler(event) {  event.preventDefault();}

</script>

<script src="../js/script.js"></script>
<script src="../js/individual.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>

