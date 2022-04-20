<?php
include_once 'back_header.php';
session_start();
include_once 'CRUD/user_CRUD.php';
include_once 'CRUD/games_CRUD.php';
include_once 'CRUD/games_back_CRUD.php';
$uid = $_SESSION['uid'];
$uname = $_SESSION['name'];
if ($uname === 'admin'){
  $_SESSION['PASSKEY'] = 'admin is Lloydyide.cn';
  echo "<script>window.location.assign('admin_operate.php')</script>";
}
$head = $_SESSION['head'];
$games = findGame_uid($uid);
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
  <li style="cursor: pointer" role="presentation" class="active" id="uf"><a onclick="get_inf();$('#uinf').css('display','inherit');
    $('#uf').addClass('active');">用户基本信息</a></li>
  <li style="cursor: pointer" role="presentation" id="ud"><a onclick="get_inf();$('#upwd').css('display','inherit');
    $('#ud').addClass('active');">修改密码</a></li>
  <li style="cursor: pointer" role="presentation" id="ca"><a onclick="get_inf();$('#create_article').css('display','inherit');
    $('#ca').addClass('active');">发布文章</a></li>
  <li style="cursor: pointer" role="presentation" id="ma"><a onclick="get_inf();$('#modify_article').css('display','inherit');
    $('#ma').addClass('active');">修改文章</a></li>
</ul>
<div class="container">
  <div class="row" style="margin-top: 50px">
    <div class="col-xs-3"></div>
    <div class="col-xs-6" style="border:none;border-radius: 20px;box-shadow: 0 0 30px #4485bc;padding: 30px">
      <div style="height: 100%;width: 100%" id="uinf">
        <form action="getfile.php" method="post" enctype="multipart/form-data">
          <img src="heads/<?php echo $head ?>" style="border-radius: 50%;width: 100px;height: 100px">
          <span style="font-size: xx-large;color: #4485bc;margin-left: 40px"><?php echo $uname ?></span>
          <div style="margin-top: 20px"><input type="file" id="head" name="head" value="def.png"></div>

          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">输入新的用户名</span>
            <input type="text" class="form-control" name="new_name" value="<?php echo $uname ?>"
                   placeholder="<?php echo $uname ?>"
                   aria-describedby="basic-addon1">
            <span class="input-group-addon" style="cursor: pointer;" id="basic-addon1"
                  onclick="$('#sum_but').click()">确认修改</span>
            <input type="submit" id="sum_but" style="display: none">
          </div>
        </form>
      </div>
      <div style="height: 100%;width: 100%;display: none" id="upwd">
        <form action="change_pwd.php" method="post">
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">输入原密码</span>
            <input type="password" class="form-control" name="old_pwd"
                   placeholder="输入原密码"
                   aria-describedby="basic-addon1">
          </div>
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">输入新密码</span>
            <input type="password" class="form-control" name="new_pwd"
                   placeholder="输入新密码"
                   aria-describedby="basic-addon1">
          </div>
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">确认新密码</span>
            <input type="password" class="form-control" name="confirm_pwd"
                   placeholder="确认新密码"
                   aria-describedby="basic-addon1">
            <span class="input-group-addon" style="cursor: pointer;" id="basic-addon1"
                  onclick="$('#sum_but2').click()">确认修改</span>
            <input type="submit" id="sum_but2" style="display: none">
          </div>
        </form>
      </div>
      <div style="height: 100%;width: 100%;display: none" id="create_article">
        <form action="get_games.php" method="post" enctype="multipart/form-data">
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">文章名</span>
            <input type="text" class="form-control" name="game_name"
                   placeholder="文章名"
                   aria-describedby="basic-addon1">
          </div>
          <div style="margin-top: 10px">
            <div class="selected-item">
              <p>The Class of Games : <span>Please Select</span></p>
            </div>
            <select name="class" id="cusSelectbox">
              <option value="null" selected>Please Select</option>
              <option value="RPG">RPG</option>
              <option value="FPS">FPS</option>
              <option value="SLG">SLG</option>
              <option value="RAC">RAC</option>
              <option value="SPG">SPG</option>
            </select>
          </div>
          <div style="height: 15px"></div>
          <p style="width: 200px;display: inline">The media1 of Games : </p>
          <input type="file" style="display: inline;width: 180px" name="game_poster"><strong style="color: dodgerblue">choose
            the poster</strong>
          <div style="height: 15px"></div>
          <p style="width: 200px;display: inline">The media2 of Games : </p>
          <input type="file" style="display: inline;width: 180px" name="game_video"><strong style="color: dodgerblue">choose
            the video</strong>
          <div style="height: 15px"></div>
          <p style="width: 200px;display: inline">The media3 of Games : </p>
          <input type="file" style="display: inline;width: 180px" name="game_img1"><strong style="color: dodgerblue">choose
            the img1</strong>
          <div style="height: 15px"></div>
          <p style="width: 200px;display: inline">The media4 of Games : </p>
          <input type="file" style="display: inline;width: 180px" name="game_img2"><strong style="color: dodgerblue">choose
            the img2</strong> <br/>
          <label for="inf1" style="margin-top: 10px;">文章简介</label>
          <textarea name="game_inf1" id="inf1" cols="66" rows="2" placeholder="简单介绍一下你的文章吧"
                    style="border-radius: 5px;padding: 15px;border-color: #999999;outline: none"></textarea><br>
          <label for="inf2" style="margin-top: 10px;">文章内容</label>
          <textarea name="game_inf2" id="inf2" cols="66" rows="5" placeholder="这里是你文章的全部内容哦~"
                    style="border-radius: 5px;padding: 15px;border-color: #999999;outline: none"></textarea><br>
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">出版公司</span>
            <input type="text" class="form-control" name="company"
                   placeholder="出版公司"
                   aria-describedby="basic-addon1">
          </div>
          <div class="input-group" style="margin-top: 20px">
            <span class="input-group-addon" id="basic-addon1">发行公司</span>
            <input type="text" class="form-control" name="writer"
                   placeholder="发行公司"
                   aria-describedby="basic-addon1">
          </div>
          <div class="row">
            <div class="col-xs-5"></div>
            <button type="submit" id="myButton" data-loading-text="Loading..." style="margin-top: 15px;"
                    class="btn btn-primary">
              发布文章
            </button>
          </div>

        </form>
      </div>
      <div style="height: 100%;width: 100%;display: none" id="modify_article">
        <h3>选择需要修改的文章</h3><br/>
        <?php
        echo "<table class='table table-hover table-bordered'>";
        echo "<tr><th>ID</th><th>标题</th><th>作者ID</th><th>预览</th><th>直接删除</th></tr>";
        foreach ($games as $game) {
          if ($game == null) continue;
          echo "<tr>";
          echo "<td>" . $game['game_id'] . "</td>";
          echo "<td>" . $game['game_name'] . "</td>";
          echo "<td>" . $game['uid'] . "</td>";
          echo "<td><a href='change_games.php?game_id=". $game['game_id']."'>修改</a></td>";
          echo "<td><a href='delete_game.php?operate=0&game_id=" . $game['game_id'] . "'>立即删除</a></td></tr>";
        }
        ?>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  function get_inf() {
    $("#uinf").css('display', 'none');
    $("#uf").removeClass('active');
    $("#upwd").css('display', 'none');
    $("#ud").removeClass('active');
    $("#create_article").css('display', 'none');
    $("#ca").removeClass('active');
    $("#modify_article").css('display', 'none');
    $("#ma").removeClass('active');
  }

  $('#myButton').on('click', function () {
    let $btn = $(this).button('loading')
    $btn.button('reset')
  })
</script>
</body>
<?php include_once 'back-footer.php' ?>
</html>
