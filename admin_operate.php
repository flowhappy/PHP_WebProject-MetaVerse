<?php
include_once 'CRUD/connectSQL.php';
session_start();
if($_SESSION['PASSKEY']!='admin is Lloydyide.cn'||!isset($_SESSION['PASSKEY'])){
    //提示非法
    echo '<script>alert("非法操作！");location.href="../index.php";</script>';
}
function all_users() {
  $link = get_connect();
  $sql = "select * from users";
  $res = mysqli_query($link, $sql);
  while ($users[] = mysqli_fetch_assoc($res)) ;
  return $users;
}

function all_games() {
  $link = get_connect();
  $sql = "select * from games_detail";
  $res = mysqli_query($link, $sql);
  while ($games[] = mysqli_fetch_assoc($res)) ;
  return $games;
}

$users = all_users();

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>user backstage</title>
  <link rel="stylesheet" href="select_style.css">
  <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.min.css">
  <script src="bootstrap-3.4.1/js/bootstrap.min.js"></script>
  <script src="bootstrap-3.4.1/js/transition.min.js"></script>
  <script src="jquery-3.6.0.js"></script>
  <link rel="shortcut icon" href="image/yide'sico.ico">
  <script src="select_script.js"></script>
  <link rel="stylesheet" href="vivify.min.css">
</head>
<body>
<div id="add_user_input" class="alert alert-info navbar-fixed-top vivify" role="alert" style="z-index: 9999999;display: none">
  <span class="input-group" style="width: 50%;margin: auto">
    <span class="input-group-addon">请输入你要填加的用户名</span>
    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
    <span class="input-group-addon">用户初始密码为123456de</span>
    <span id="add_user" class="input-group-addon" style="cursor: pointer;background-color: dodgerblue;color: white">添加</span>
    <span id="cancel_add" class="input-group-addon" style="cursor: pointer;background-color: indianred;color: white">取消</span>
  </span>
  <script>
    $('#cancel_add').click(function () {
      $('#add_user_input').fadeOut(500);
    });
    $("#add_user").click(function () {
      let username = $(".input-group input").val();
      if(!username) {
        $(".input-group input").attr("placeholder","请输入用户名");
        $(".input-group input").css("background-color","#ffcccc");
        $(".input-group input").focus();
        return;
      }
      $.ajax({
        url: "add_user.php",
        type: "post",
        data: {
          username: username
        },
        success: function (data) {
          location.reload();
        }
      })
    })
  </script>
</div>
<div class="col-xs-12"
     style="z-index: 999999;position: fixed;background-color: #4485bc;color: white;height: 50px;display: flex;justify-content: center;align-items: center">
  <div class="navbar-header" style="cursor: pointer">
    <img alt="Brand" src="image/Yd's_Base.gif" style="width: 40px;height: 40px;float: left">
  </div>
  <span style="font-weight: bolder;font-size: xx-large">Admin Backstage</span>
</div>
<div style="height: 50px"></div>
<ul class="nav nav-tabs" style="position: fixed;">
  <li style="cursor: pointer" role="presentation" id="ca" class="active">
    <a onclick="get_inf();$('#create_article').css('display','inherit');
    $('#ca').addClass('active');">删除用户</a></li>
  <li style="cursor: pointer" role="presentation" id="ma">
    <a onclick="get_inf();$('#modify_article').css('display','inherit');
    $('#ma').addClass('active');">删除文章</a></li>
</ul>
<div class="container">
  <div class="row" style="margin-top: 50px">
    <div class="col-xs-3"></div>
    <div class="col-xs-6" style="border:none;border-radius: 20px;box-shadow: 0 0 30px #4485bc;padding: 30px">
      <div style="height: 100%;width: 100%;" id="create_article">
        <h3>选择需要删除的用户
          <button class="btn btn-primary" id="show_add" style="float: right" onclick="add_user()">前往添加用户</button>
          <script>
            function add_user() {
              $('#add_user_input').css('display','inherit');
              $('#add_user_input').addClass('pullDown')
            }
          </script>
        </h3><br/>
        <?php
        echo "<table class='table table-hover table-bordered'>";
        echo "<tr><th>ID</th><th>用户名</th><th>密码</th><th>注册时间</th><th>删除</th></tr>";
        foreach ($users as $user) {
          if ($user == null) {
            continue;
          }
          echo "<tr>";
          echo "<td>" . $user['uid'] . "</td>";
          echo "<td>" . $user['uname'] . "</td>";
          echo "<td>" . $user['upassword'] . "</td>";
          echo "<td>" . $user['regtime'] . "</td>";
          echo "<td><a href='delete_user.php?uid=" . $user['uid'] . "'>删除</a></td>";
          echo "</tr>";
        }
        ?>
        </table>
      </div>
      <div style="height: 100%;width: 100%;display: none" id="modify_article">
        <h3>选择需要删除的文章</h3><br/>
        <?php
        echo "<table class='table table-hover table-bordered'>";
        echo "<tr><th>ID</th><th>标题</th><th>作者ID</th><th>预览</th><th>直接删除</th></tr>";
        $games = all_games();
        foreach ($games as $game) {
          if ($game == null) continue;
          echo "<tr>";
          echo "<td>" . $game['game_id'] . "</td>";
          echo "<td>" . $game['game_name'] . "</td>";
          echo "<td>" . $game['uid'] . "</td>";
          echo "<td><a href='delete_games.php?game_id=" . $game['game_id'] . "'>预览</a></td>";
          echo "<td><a href='delete_game.php?operate=1&game_id=" . $game['game_id'] . "'>立即删除</a></td></tr>";
        }
        ?>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  function get_inf() {
    $("#create_article").css('display', 'none');
    $("#ca").removeClass('active');
    $("#modify_article").css('display', 'none');
    $("#ma").removeClass('active');
  }
</script>
</body>
</html>
