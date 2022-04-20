<?php
include 'header.php';
include_once 'CRUD/games_CRUD.php';
$game_res = findGame();
$hot_game = find_hotGame();
for ($i = 0; $i < 6; $i++) {
  $res[] = $game_res[$i];
}
$music_id=7238513086;
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Title</title>
  </head>
  <style>
    * {
      transition: all 300ms;
    }

    #log_suc {
      transition: 300ms;
    }


    .thumbnail {
      margin-top: 20px;
      transition: 300ms;
      border: none;
    }

    .row {
      margin-top: 30px;
    }

    .slide-out-top {
      -webkit-animation: slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
      animation: slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
    }

    @-webkit-keyframes slide-out-top {
      0% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        opacity: 1;
      }
      100% {
        -webkit-transform: translateY(-1000px);
        transform: translateY(-1000px);
        opacity: 0;
      }
    }

    @keyframes slide-out-top {
      0% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        opacity: 1;
      }
      100% {
        -webkit-transform: translateY(-1000px);
        transform: translateY(-1000px);
        opacity: 0;
      }
    }

    .thumbnail {
      opacity: 0.9;
    }

    .scroll_show {
      opacity: 0;
      transform: translateY(100px);
      transition: 1200ms;
    }

    .show {
      opacity: 1;
      transform: translateY(0px);
    }
  </style>
  <body>
  <div id="log_suc" class="alert alert-success alert-dismissible navbar-fixed-top" role="alert"
       style="display: none;position: fixed;width: 100%;text-align: center">
    <strong>Congratulations !</strong> You have successfully logged in.
  </div>
  <div id="log_alert" class="alert alert-danger alert-dismissible navbar-fixed-top" role="alert"
       style="display: none;position: fixed;width: 100%;text-align: center">
    <strong>Oops ! Wrong user name or password.</strong>
  </div>
  <div id="out_suc" class="alert alert-success alert-dismissible navbar-fixed-top" role="alert"
       style="display: none;position: fixed;width: 100%;text-align: center">
    <strong> You have successfully logged out.</strong>
  </div>
  <?php
  if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === 'false') {
    $_SESSION['show_in']++;
    if ($_SESSION['show_in'] === 1) {
      echo "<script>$('#log_alert').css('display','inherit');</script>";
    }
  }
  if (isset($_SESSION['show_in'])) {
    $_SESSION['show_in']++;
    if ($_SESSION['show_in'] === 1) {
      echo "<script>$('#log_suc').css('display','inherit');</script>";
    }
  } else {
    echo "<script>$('#log_suc').css('display','none');</script>";
  }

  if (isset($_SESSION['is_logout']) && $_SESSION['is_logout'] === 'true') {
    $_SESSION['show_out']++;
    if ($_SESSION['show_out'] === 1) {
      echo "<script>$('#out_suc').css('display','inherit');</script>";
    }
  } else {
    echo "<script>$('#out_suc').css('display','none');</script>";
  }
  ?>
  <script>
    let show_meg = setInterval(function () {
      $("#log_suc").addClass('slide-out-top');
      $("#out_suc").addClass('slide-out-top');
      $("#log_alert").addClass('slide-out-top');
      clearInterval(show_meg);
    }, 5000);
  </script>
  <div id="music_id" class="input-group"
       style="position: fixed;z-index: 999999999999999;opacity: 0.8;transform: translateX(-200px);width: 220px;
      box-shadow: 0 0 15px white;
">
    <span class="input-group-addon">ID</span>
    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="请输入歌单ID">
    <span class="input-group-addon" style="cursor: pointer" onclick="music_reload(this)">确认</span>
  </div>
  <iframe frameborder="no" style="border: none;box-shadow: none;position: fixed;z-index: 999999999999999;opacity: 0.8;transform: translateX(-82px)"
          marginwidth="0" marginheight="0" width=110 height=100
          src="//music.163.com/outchain/player?type=0&id=<?php echo $music_id;?>&auto=1&height=90"></iframe>
  <script>
    let flag=0;
    let flag1=0;
    let hide;
    let hide1;
    let hide2;
    function music_reload(tag) {
      var music_id = $(tag).parent().children('input').val();
      if (music_id === '') {
        //2399935867
        $(tag).parent().children('input').focus();
        return;
      }
      $.ajax({
        url: 'music_reload.php',
        type: 'POST',
        data: {
          music_id: music_id
        },
        success: function (data) {
          if (data === 'success') {
            clearInterval(hide);
            flag=1;
            $('iframe').attr('src', '//music.163.com/outchain/player?type=0&id=' + music_id + '&auto=1&height=90');
            $('iframe').css({'transform':'translateX(0px)'});
            setTimeout(()=>{
              flag=0;
              if(!flag){
                hide2 = setInterval(()=>{
                  $('iframe').css('transform','translateX(-82px)');
                  clearInterval(hide2)
                },1600)
              }
            },2000)
          } else {
            alert('更新失败');
          }
        }
      });
    }
    $('iframe').css('margin-top',screen.height * 0.73);
    $('#music_id').css('margin-top',screen.height * 0.69);
    $('iframe').mouseleave(function () {
      flag=0;
      $('iframe').css('width','110px');
      if(!flag){
        hide = setInterval(()=>{
          $('iframe').css('transform','translateX(-82px)');
          clearInterval(hide)
        },1600)
      }
    });
    $('iframe').mouseenter(function () {
      clearInterval(hide);
      flag=1;
      $('iframe').css({'transform':'translateX(0px)','width':'330px'});
    });
    $('#music_id').mouseenter(function () {
      clearInterval(hide1);
      flag1=1;
      $('#music_id').css({'transform':'translateX(8px)'});
    });
    $('#music_id').mouseleave(function () {
      flag1=0;
      if(!flag1){
        hide1 = setInterval(()=>{
          $('#music_id').css('transform','translateX(-200px)');
          clearInterval(hide1)
        },1600)
      }

    });
  </script>
  <div class="behind_wrap">
    <div class="container" style="width: 100%; margin-top: 10px;">
      <div class="jumbotron">
        <div style="background-color: white;opacity: 0.6;border-radius: 20px;padding: 20px">
          <h1 style="text-align: center;font-weight: bolder;font-size: 100px;"> Hello! Meta-verse</h1>
          <h4 style="margin-top: 5%;text-align: center">We are Meta-mates!</h4>
        </div>
        <p style="margin-top: 10%;text-align: center;opacity: 0.8;"><span onclick="get_more()" class="btn btn-primary btn-lg hu__hu__ head_cur" role="button">Learn
        more <span class="glyphicon glyphicon-chevron-down"></span></span></p>
        <script>
          $(".jumbotron").css("height", screen.height * 0.9);
          $(".jumbotron>div").css("margin-top", screen.height * 0.2);
        </script>
      </div>
    </div>
    <div id="hot"></div>
    <div class="container">
      <h3 style="font-weight: bolder;margin-top: 5%;">
        <span style="background-color: white;opacity: 0.68;padding: 10px;border-radius: 10px">热门游戏</span>
        <span class="label label-default" style="margin-left: 10px;background-color: rgba(255,0,13,0.78)">HOT</span>
      </h3>
      <div class="row" style="margin-top: 30px;">
        <div class="col-lg-6 col-md-12 col-sm-12 scroll_show">
          <div class="thumbnail">
            <div class="embed-responsive embed-responsive-16by9">
              <video controls poster="image/<?php echo $hot_game[0]['game_poster']; ?>" class="embed-responsive-item">
                <source src="image/<?php echo $hot_game[0]['game_video']; ?>"
                " type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
            <div class="caption"
                 onclick="window.location.assign('detail.php?game_id=<?php echo $hot_game[0]['game_id'] ?>');">
              <h3 class="text-center"><?php echo $hot_game[0]['game_name']; ?></h3>
              <p style="padding: 10px;line-height: 25px;"><?php echo $hot_game[0]['game_inf1']; ?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 scroll_show">
          <div class="thumbnail">
            <div class="embed-responsive embed-responsive-16by9">
              <video controls poster="image/<?php echo $hot_game[1]['game_poster']; ?>" class="embed-responsive-item">
                <source src="image/<?php echo $hot_game[1]['game_video']; ?>"
                " type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
            <div class="caption"
                 onclick="window.location.assign('detail.php?game_id=<?php echo $hot_game[1]['game_id'] ?>');">
              <h3 class="text-center"><?php echo $hot_game[1]['game_name']; ?></h3>
              <p style="padding: 10px;line-height: 25px;">
              <?php echo $hot_game[1]['game_inf1']; ?></div>
          </div>
        </div>

      </div>
      <h3 style="font-weight: bolder;margin-top: 5%;">
        <span style="background-color: white;opacity: 0.68;padding: 10px;border-radius: 10px">新品上架</span>
        <span class="label label-default" style="margin-left: 10px;background-color: rgba(255,0,13,0.78)">Best</span>
      </h3>
      <div class="row" style="margin-top: 20px">
        <?php for ($i = 0; $i < 6; $i++) { ?>
        <div class="col-lg-4 col-md-6 col-sm-6 scroll_show"
             onclick="window.location.assign('detail.php?game_id=<?php echo $res[$i]['game_id'] ?>');">
          <div class="thumbnail chang_hover">
            <img class="poster_img" src="image/<?php echo $res[$i]['game_poster']; ?>" alt="...">
            <div class="caption">
              <h3 class="text-center"><?php echo $res[$i]['game_name']; ?></h3>
              <p style="padding: 10px;line-height: 25px;">
              <?php echo $res[$i]['game_inf1']; ?></div>
          </div>
          </div><?php } ?>
      </div>
    </div>
  </div>
  </body>
  <script>
    let box = $('.scroll_show');
    box.each(function (index, item) {
      if (item.getBoundingClientRect().top < window.innerHeight) {
        $(this).addClass('show');
      }
    });
    $(window).scroll(() => {
      box.each(function (index, item) {
        if (item.getBoundingClientRect().top < window.innerHeight) {
          $(this).addClass('show');
        }
      });
    });
  </script>
  </html>
<?php require_once 'footer.php'; ?>