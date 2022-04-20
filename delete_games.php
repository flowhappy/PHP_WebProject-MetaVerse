<?php
session_start();
include_once 'CRUD/user_CRUD.php';
include_once 'CRUD/games_CRUD.php';
include_once 'CRUD/games_back_CRUD.php';
$game_id = $_GET['game_id'];
$game = findGame_ID($game_id);
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
  <script  src="select_script.js"></script>
  <link rel="stylesheet" href="vivify.min.css">
</head>
<body>
<div class="col-xs-12"
     style="z-index: 999999;position: fixed;background-color: #4485bc;color: white;height: 50px;display: flex;justify-content: center;align-items: center">
  <div class="navbar-header" style="cursor: pointer">
    <img alt="Brand" src="image/Yd's_Base.gif" style="width: 40px;height: 40px;float: left">
  </div>
  <span style="font-weight: bolder;font-size: xx-large">文章删除</span>
</div>
<div style="height: 50px"></div>
<ul class="nav nav-tabs" style="position: fixed;">
  <li style="cursor: pointer" role="presentation" id="ma"><a onclick="get_inf();$('#modify_article').css('display','inherit');
    $('#ma').addClass('active');">删除文章</a></li>
</ul>
<div class="container">
  <div class="row" style="margin-top: 50px">
    <div class="col-xs-3"></div>
    <div class="col-xs-6" style="border:none;border-radius: 20px;box-shadow: 0 0 30px #4485bc;padding: 30px">
      <div style="height: 100%;width: 100%;" id="modify_article">
        <form action="update_games.php?game_id=<?php echo $game_id ?>" method="post">
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">文章名</span>
            <input  type="text" class="form-control" name="game_name" readonly
                   value="<?php echo $game['game_name'] ?>"
                   placeholder="<?php echo $game['game_name'] ?>"
                   aria-describedby="basic-addon1">
          </div>
          <div style="margin-top: 10px">
            <div class="selected-item">
              <p>The Class of Games : <span><?php echo $game['class'] ?></span></p>
            </div>
          </div>
          <div style="height: 15px"></div>
          <label for="inf1" style="margin-top: 10px;">文章简介</label>
          <p name="game_inf1" id="inf1" cols="66" rows="2" placeholder="简单介绍一下你的文章吧"
                    style="border-radius: 5px;padding: 15px;border-color: #999999;outline: none"><?php echo $game['game_inf1'] ?></p><br>
          <label for="inf2" style="margin-top: 10px;">文章内容</label>
          <p><?php echo $game['game_inf2'] ?></p><br>
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">出版公司</span>
            <input type="text" class="form-control" name="company" readonly
                   placeholder="<?php echo $game['company'] ?>"
                   value="<?php echo $game['company'] ?>"
                   aria-describedby="basic-addon1">
          </div>
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">发行公司</span>
            <input type="text" class="form-control" name="writer" readonly
                   placeholder="<?php echo $game['writer'] ?>"
                   value="<?php echo $game['writer'] ?>"
                   aria-describedby="basic-addon1">
          </div>
          <div class="row">
            <div class="col-xs-5"></div>
            <button type="button" data-loading-text="Loading..." id="delete_article"
                    style="margin-top: 15px;background-color: red"
                    class="btn btn-primary col-xs-2">
              删除文章
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="alert alert-danger vivify popInTop" role="alert" id="confirm_delete"
     style="position: fixed;top: 0;z-index: 999999;width: 100%;text-align: center;display: none">
  <strong>Warning! </strong>Are you sure to delete the article?<br/>
  The operation is <strong>irreversible!</strong><br/>
    <button type="button" data-loading-text="Loading..." id="close_confirm"
            style="margin-top: 15px;"
            class="btn btn-primary">
      取消
    </button>
    <button type="button" data-loading-text="Loading..."
            onclick="window.location.assign('delete_game.php?game_id=<?php echo $game_id?>')"
            style="margin-top: 15px;background-color: red;margin-left: 50px"
            class="btn btn-primary">
      确认删除
    </button>
</div>
<script>
  $('#myButton').on('click', function () {
    let $btn = $(this).button('loading')
    $btn.button('reset')
  })
  $("#delete_article").click(function () {
    $("#confirm_delete").removeClass('popOutTop');
    $("#confirm_delete").css('display','inherit');
  })
  $("#close_confirm").click(function () {
    $("#confirm_delete").addClass('popOutTop');
  })
</script>
</body>
<?php include_once 'back-footer.php' ?>
</html>
