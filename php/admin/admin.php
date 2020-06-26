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

function FetchMessage($mysql){
    $query="SELECT id,user_id,nickname,message,topic FROM message";
    $statement=$mysql->query($query);
    $result=$statement->fetchAll();
    return $result;
}

function FetchUser($mysql){
        $query="SELECT id,username,nickname,avatar FROM user";
        $statement=$mysql->query($query);
        $result=$statement->fetchAll();
        return $result;
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理员</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        h1{
            text-align: center;
            color: lightslategray;
        }

        .header{
            display: flex;
        }

        .wad{
            width: 150px;
        }

        .wad:hover{
            opacity: 0.5;
            cursor: pointer;
        }

        .distance{
            margin-top: 56px;
        }

        .table-limit{
            max-width: 400px;
            word-break: break-all;
        }

        .none{
            display: none;
        }

        img.avatar{
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <div class="fixed-top">
        <div class="collapse" id="header">
            <div class="bg-dark p-4">
                <h3 class="text-white h4">你好，管理员！</h3>
                <h5 class="text-white h4 header">
                    <span class="wad" id="user">用户</span>
                    <span class="wad" id="message">留言</span>
                    <span class="wad" id="comment">评论</span>
                </h5>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>

    <div class="container distance none" id="message-content">
        <h1>管理员</h1>
        <h2>你好，管理员！</h2>
        <div class="row" >
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">用户ID</th>
                        <th scope="col">昵称</th>
                        <th scope="col">留言ID</th>
                        <th scope="col">标题</th>
                        <th scope="col">留言</th>
                        <th scope="col">删除</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mysql=Connect();
                        $result=FetchMessage($mysql);
                        $j=1;
                        for($i=0;$i<count($result);$i++){
                            echo '<tr>';
                            echo '<th scope="row">'.$j.'</th>';
                            echo '<td>'.$result[$i]["user_id"].'</td>';
                            echo '<td>'.$result[$i]["nickname"].'</td>';
                            echo '<td>'.$result[$i]["id"].'</td>';
                            echo '<td class="table-limit">'.$result[$i]["topic"].'</td>';
                            echo '<td class="table-limit">'.$result[$i]["message"].'</td>';
                            echo '<td><button class="btn btn-primary" onclick="RemoveMessage('?><?php echo $result[$i]["id"] ?><?php echo ')">删除</button></td>';
                            echo '</tr>';
                            $j++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
<div class="container distance" id="user-content">
    <h1>管理员</h1>
    <h2>你好，管理员！</h2>
    <div class="row" >
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">用户ID</th>
                        <th scope="col">用户名</th>
                        <th scope="col">昵称</th>
                        <th scope="col">头像</th>
                        <th scope="col">禁言</th>
                        <th scope="col">封号</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $mysql=Connect();
                        $result2=FetchUser($mysql);
                        $j=1;
                        for($i=0;$i<count($result2);$i++){
                            echo '<tr>';
                            echo '<th scope="row">'.$j.'</th>';
                            echo '<td>'.$result2[$i]["id"].'</td>';
                            echo '<td>'.$result2[$i]["username"].'</td>';
                            echo '<td>'.$result2[$i]["nickname"].'</td>';
                            echo '<td>'?> <img class="avatar" src="<?php
                            $url="../".$result2[$i]["avatar"];
                            if($result2[$i]["avatar"]){
                                echo $url;
                            }else{
                                $url="../../avatar/default.jpg";
                                echo $url;
                            }
                            ?>"> <?php echo '</td>';
                            echo '<td><button class="btn btn-primary">禁言</button></td>';
                            echo '<td><button class="btn btn-primary"onclick="DeleteUser('?> <?php echo $result2[$i]["id"] ?> <?php echo')">封号</button></td>';
                            echo '</tr>';
                            $j++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="../../js/jquery-3.5.1.js"></script>
<script>
    var user=$("#user");
    var message=$("#message");
    var comment=$("#comment");
    user.click(function () {
        $("#message-content").hide();
        $("#user-content").show();
    });

    message.click(function () {
        $("#user-content").hide();
        $("#message-content").show();
    });



    function RemoveMessage(id=0) {
        $.ajax({
            url:"RemoveMessage.php",
            type:"post",
            data:{
                id: id
            },
            error: function () {
                alert("失败")
            },

            success: function () {
                alert("成功");
                document.body.style.opacity=0;
                setTimeout(function () {
                    location.reload();
                },500);
            }
        })
    }

    function DeleteUser(id=0) {
        $.ajax({

        })
    }

</script>

</body>
</body>
</html>
