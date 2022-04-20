<?php
include 'header.php';
include_once 'CRUD/games_CRUD.php';
for($i=1;$i<=6;$i++){
  $res[]=findGame_ID($i);
}
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

    .thumbnail:hover {
      cursor: pointer;
      box-shadow: 0px 5px 10px #666666;
      transform: translateY(-8px);
    }

    .thumbnail {
      transition: 300ms;
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

  </style>
  <body>
  <div id="log_suc" class="alert alert-success alert-dismissible" role="alert"
       style="display: none;position: fixed;width: 100%;text-align: center">
    <strong>Congratulations !</strong> You have successfully logged in.
  </div>
  <div id="log_alert" class="alert alert-danger alert-dismissible" role="alert"
       style="display: none;position: fixed;width: 100%;text-align: center">
    <strong>Oops ! Wrong user name or password.</strong>
  </div>
  <div id="out_suc" class="alert alert-success alert-dismissible" role="alert"
       style="display: none;position: fixed;width: 100%;text-align: center">
    <strong> You have successfully logged out.</strong>
  </div>
  <?php
  if(isset($_SESSION['is_login'])&&$_SESSION['is_login']==='false'){
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

  if(isset($_SESSION['is_logout'])&&$_SESSION['is_logout'] === 'true'){
    $_SESSION['show_out']++;
    if ($_SESSION['show_out'] === 1) {
      echo "<script>$('#out_suc').css('display','inherit');</script>";
    }
  }else{
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
  <div class="behind_wrap">
    <div class="container" style="width: 100%; margin-top: 10px;">
      <div class="jumbotron">
        <h1 style="text-align: center;font-weight: bolder;font-size: 100px"> Open source & Expansion </h1>
        <p style="margin-top: 5%;text-align: center">水不争先，滔滔不绝</p>
        <p style="margin-top: 10%;text-align: center"><span onclick="get_more()"
                                                            class="btn btn-primary btn-lg" role="button">Learn
        more</span></p>
        <script>
          $(".jumbotron").css("height", screen.height * 0.93);
          $(".jumbotron>h1").css("margin-top", screen.height * 0.25);
        </script>
      </div>
    </div>
    <div id="hot"></div>
    <div class="container">
      <h3 style="font-weight: bolder;margin-top: 5%">我的最爱<span class="label label-default"
                                                               style="margin-left: 10px;background-color: rgba(255,0,13,0.78)">Best</span>
      </h3>
      <div class="row" style="margin-top: 30px;">
        <div class="col-lg-6 col-md-12 col-sm-12">
          <div class="thumbnail">
            <div class="embed-responsive embed-responsive-16by9">
              <video controls poster="image/<?php echo $res[0]['game_poster']; ?>" class="embed-responsive-item">
                <source src="image/<?php echo $res[0]['game_video'];?>"
                " type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
            <div class="caption">
              <h3 class="text-center"><?php echo $res[0]['game_name'];?></h3>
              <p style="padding: 10px;line-height: 25px;"><?php echo $res[0]['game_inf1'];?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
          <div class="thumbnail">
            <div class="embed-responsive embed-responsive-16by9">
              <video controls poster="image/<?php echo $res[1]['game_poster']; ?>" class="embed-responsive-item">
                <source src="image/<?php echo $res[1]['game_video'];?>"
                " type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
            <div class="caption">
              <h3 class="text-center"><?php echo $res[1]['game_name'];?></h3>
              <p style="padding: 10px;line-height: 25px;">
              <?php echo $res[1]['game_inf1'];?></div>
          </div>
        </div>

      </div>
      <h3 style="font-weight: bolder">最近常玩<span class="label label-default"
                                                style="margin-left: 10px;background-color: rgba(255,0,13,0.78)">Recent</span>
      </h3>
      <div style="height: 10px"></div>
      <div class="row" style="margin-top: 20px">
        <div class="col-lg-4 col-md-6 col-sm-6"
             onclick="window.location.assign('http://www.20201262324lyd.com/project-games/detail.php?game_id=<?php echo $res[0]['game_id'] ?>');">
          <div class="thumbnail">
            <img src="image/<?php echo $res[0]['game_poster']; ?>" alt="...">
            <div class="caption">
              <h3 class="text-center"><?php echo $res[0]['game_name'];?></h3>
              <p style="padding: 10px;line-height: 25px;">
              <?php echo $res[0]['game_inf1'];?></div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6"
             onclick="window.location.assign('http://www.20201262324lyd.com/project-games/detail.php?game_id=<?php echo $res[1]['game_id'] ?>');">
          <div class="thumbnail">
            <img src="image/<?php echo $res[1]['game_poster']; ?>" alt="...">
            <div class="caption">
              <h3 class="text-center"><?php echo $res[1]['game_name'];?></h3>
              <p style="padding: 10px;line-height: 25px;"><?php echo $res[1]['game_inf1'];?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6"
             onclick="window.location.assign('http://www.20201262324lyd.com/project-games/detail.php?game_id=<?php echo $res[0]['game_id'] ?>');">
          <div class="thumbnail">
            <img src="image/<?php echo $res[0]['game_poster']; ?>" alt="...">
            <div class="caption">
              <h3 class="text-center"><?php echo $res[0]['game_name'];?></h3>
              <p style="padding: 10px;line-height: 25px;">
              <?php echo $res[0]['game_inf1'];?></div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6"
             onclick="window.location.assign('http://www.20201262324lyd.com/project-games/detail.php?game_id=<?php echo $res[1]['game_id'] ?>');">
          <div class="thumbnail">
            <img src="image/<?php echo $res[1]['game_poster']; ?>" alt="...">
            <div class="caption">
              <h3 class="text-center"><?php echo $res[1]['game_name'];?></h3>
              <p style="padding: 10px;line-height: 25px;"><?php echo $res[1]['game_inf1'];?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6"
             onclick="window.location.assign('http://www.20201262324lyd.com/project-games/detail.php?game_id=<?php echo $res[0]['game_id'] ?>');">
          <div class="thumbnail">
            <img src="image/<?php echo $res[0]['game_poster']; ?>" alt="...">
            <div class="caption">
              <h3 class="text-center"><?php echo $res[0]['game_name'];?></h3>
              <p style="padding: 10px;line-height: 25px;">
              <?php echo $res[0]['game_inf1'];?></div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6"
             onclick="window.location.assign('http://www.20201262324lyd.com/project-games/detail.php?game_id=<?php echo $res[1]['game_id'] ?>');">
          <div class="thumbnail">
            <img src="image/<?php echo $res[1]['game_poster']; ?>" alt="...">
            <div class="caption">
              <h3 class="text-center"><?php echo $res[1]['game_name'];?></h3>
              <p style="padding: 10px;line-height: 25px;"><?php echo $res[1]['game_inf1'];?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </body>
  </html>
<?php require_once 'footer.php'; ?>