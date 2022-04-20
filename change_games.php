<?php
include_once 'back_header.php';
session_start();
include_once 'CRUD/user_CRUD.php';
include_once 'CRUD/games_CRUD.php';
include_once 'CRUD/games_back_CRUD.php';
$uid = $_SESSION['uid'];
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
</head>
<body>
<div style="height: 50px"></div>
<ul class="nav nav-tabs" style="position: fixed;">
  <li style="cursor: pointer" role="presentation" id="ma"><a onclick="get_inf();$('#modify_article').css('display','inherit');
    $('#ma').addClass('active');">修改文章</a></li>
</ul>
<div class="container">
  <div class="row" style="margin-top: 50px">
    <div class="col-xs-3"></div>
    <div class="col-xs-6" style="border:none;border-radius: 20px;box-shadow: 0 0 30px #4485bc;padding: 30px">
      <div style="height: 100%;width: 100%;" id="modify_article">
        <form action="update_games.php?game_id=<?php echo $game_id ?>" method="post">
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">文章名</span>
            <input type="text" class="form-control" name="game_name"
                   value="<?php echo $game['game_name'] ?>"
                   placeholder="<?php echo $game['game_name'] ?>"
                   aria-describedby="basic-addon1">
          </div>
          <div style="margin-top: 10px">
            <div class="selected-item">
              <p>The Class of Games : <span><?php echo $game['class'] ?></span></p>
            </div>
            <select name="class" id="cusSelectbox">
              <option value="null"><?php echo $game['class'] ?></option>
              <option value="RPG" <?php if ($game['class'] === 'RPG') echo "selected" ?> >RPG</option>
              <option value="FPS" <?php if ($game['class'] === 'FPS') echo "selected" ?> >FPS</option>
              <option value="SLG" <?php if ($game['class'] === 'SLG') echo "selected" ?> >SLG</option>
              <option value="RAC" <?php if ($game['class'] === 'RAC') echo "selected" ?> >RAC</option>
              <option value="SPG" <?php if ($game['class'] === 'SPG') echo "selected" ?> >SPG</option>
            </select>
          </div>
          <div style="height: 15px"></div>
          <label for="inf1" style="margin-top: 10px;">文章简介</label>
          <textarea name="game_inf1" id="inf1" cols="66" rows="2" placeholder="简单介绍一下你的文章吧"
                    style="border-radius: 5px;padding: 15px;border-color: #999999;outline: none"><?php echo $game['game_inf1'] ?></textarea><br>
          <label for="inf2" style="margin-top: 10px;">文章内容</label>
          <textarea name="game_inf2" id="inf2" cols="66" rows="5" placeholder="这里是你文章的全部内容哦~"
                    style="border-radius: 5px;padding: 15px;border-color: #999999;outline: none"><?php echo $game['game_inf2'] ?></textarea><br>
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">出版公司</span>
            <input type="text" class="form-control" name="company"
                   placeholder="<?php echo $game['company'] ?>"
                   value="<?php echo $game['company'] ?>"
                   aria-describedby="basic-addon1">
          </div>
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">发行公司</span>
            <input type="text" class="form-control" name="writer"
                   placeholder="<?php echo $game['writer'] ?>"
                   value="<?php echo $game['writer'] ?>"
                   aria-describedby="basic-addon1">
          </div>
          <div class="row">
            <div class="col-xs-3"></div>
            <button type="submit" id="myButton" data-loading-text="Loading..." style="margin-top: 15px;"
                    class="btn btn-primary col-xs-2">
              确认修改
            </button>
            <div class="col-xs-2"></div>
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
