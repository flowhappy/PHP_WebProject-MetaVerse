<?php
include_once 'header.php';
include_once 'CRUD/games_CRUD.php';
include_once 'CRUD/comments_CRUD.php';
include_once 'CRUD/user_CRUD.php';
$res = findGame_ID($_GET['game_id']);
if ($res) $comments = get_comments($_GET['game_id']);
$uname = '';
$head = '';
if(isset($_SESSION['uid'])){
  $uname = mysqli_fetch_assoc(findUser_ID($_SESSION['uid']))['uname'];
  $head = mysqli_fetch_assoc(findUser_ID($_SESSION['uid']))['heading'];
}
add_likeCount($_GET['game_id']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<p style="display: none" id="S_uid"><?php if (isset($_SESSION['uid'])) {
    echo $_SESSION['uid'];
  } ?></p>
<p style="display: none" id="S_uname"><?php
    echo $uname;
   ?></p>
<p style="display: none" id="S_head"><?php
  echo $head;
  ?></p>
<style>
  .thumbnail:hover {
    cursor: initial;
    box-shadow: none;
    transform: translateY(0px);
    background-color: white;
  }

  .thumbnail:hover .caption {
    color: black;
    transition: 0ms;
  }

  * {
    transition: 300ms;
  }
  .thumbnail {
    opacity: 0.9;
  }
  .send_cur{
    cursor: url(cursor/send.cur), auto;
  }
</style>
<body>
<div class="alert alert-info vivify shake navbar-fixed-top" role="alert" id="log_comment"
     style="text-align: center;position: sticky;top:0;z-index: 99999;display: none;">
  <strong>Hmm...</strong>You need to login first
</div>
<div class="alert alert-success vivify popInTop navbar-fixed-top" role="alert" id="success_comment"
     style="text-align: center;position: sticky;top:0;z-index: 99999;display: none;">
  <strong>WuuuHu! </strong>Your comment has been sent successfully
</div>
<div class="alert alert-warning vivify popInTop navbar-fixed-top" role="alert" id="alert_comment"
     style="text-align: center;position: sticky;top:0;z-index: 99999;display: none;">
  <strong>I see ... </strong> you cherish words like gold, but please say something
</div>
<div class="behind_wrap fade-in-top">
  <div class="container" style="width: 100%; margin-top: 10px">
    <div class="jumbotron">
      <h1 style="background-color: white;opacity: 0.68;padding: 25px;border-radius: 10px"><?php echo $res['game_name']; ?></h1>
      <div style="height: 50px"></div>
      <p><a class="btn btn-primary btn-lg" onclick="get_more()" role="button">Add to cart</a></p>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div id="detail_inf" class="col-lg-4 col-md-4 col-sm-12">
        <div class="thumbnail">
          <img src="image/<?php echo $res['game_poster']; ?>" alt="...">
          <div class="caption">
            <h3 class="text-center"><?php echo $res['game_name']; ?></h3>
            <p style="padding: 10px;line-height: 25px;"><?php echo $res['game_inf1']; ?></div>
        </div>
      </div>
      <div id="detail_img" class="col-lg-8 col-md-8 col-sm-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators" style="height: 50px">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->

          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <div class="embed-responsive embed-responsive-16by9">
                <script>
                  $('.carousel').carousel({
                    interval: false
                  })
                </script>
                <video controls class="embed-responsive-item" autoplay="autoplay" muted>
                  <source src="image/<?php echo $res['game_video']; ?>"
                          type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              </div>
            </div>
            <div class="item">
              <img src="image/<?php echo $res['game_img1']; ?>" style="width: 100%;height: 100%">
            </div>
            <div class="item">
              <img src="image/<?php echo $res['game_img2']; ?>" style="width: 100%;height: 100%">
            </div>
          </div>

          <!-- Controls -->
          <a style="height: 50px;margin: auto" class="left carousel-control" href="#carousel-example-generic"
             role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a style="height: 50px;margin: auto" class="right carousel-control" href="#carousel-example-generic"
             role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>

    </div>
    <div class="row">
      <div id="detail_inf" class="col-lg-4 col-md-4 col-sm-10" style="margin: auto">
        <div class="thumbnail">
          <div class="caption">
            <h3 class="text-center">由<?php echo $res['company']; ?>公司出品</h3>
            <p style="padding: 10px;line-height: 25px;text-align: center;">
              出版人: <?php echo $res['writer']; ?><br/>
              出版方: <?php echo $res['company']; ?><br/>
              阅读次数: <?php echo $res['read_count'] + 1; ?><br/>
              购买量: <?php echo $res['buy_count']; ?><br/>
          </div>
        </div>
      </div>
      <div id="detail_inf" class="col-lg-8 col-md-8 col-sm-12">
        <div class="thumbnail">
          <div class="caption">
            <h3 class="text-center"> <?php echo $res['game_name']; ?></h3>
            <p style="padding: 10px;line-height: 25px;">
            <?php echo $res['game_inf2']; ?></div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-5"></div>
        <div class="col-xs-7" style="padding-top: 50px;font-weight: bolder;font-size: xx-large;color:whitesmoke">COMMENT</div>
      </div>

      <div class="row" style="margin-top: 30px">
        <div class="col-xs-2 "></div>
        <div class="col-xs-1 "><img src="heads/<?php if (isset($img_inf)) {
            echo $img_inf;
          } else echo 'unlog.png'; ?>" style="width: 60px;border-radius: 50%" alt=""></div>
        <div class="col-xs-6 ">
          <input type="text" style="width: 100%;height: 66px;background-color: rgba(223, 233, 243, .9)"
                 id="comment_holder"
                 class="form-control" placeholder="<?php if (isset($lg_inf)) {
            echo $lg_inf;
          } else {
            echo '您还没有登录';
          } ?>" aria-describedby="basic-addon1">
        </div>
        <div class="col-xs-2 hu__hu__2 "><img src="image/send.png" class="send_cur" onclick="send_comment()"
                                             style="width: 66px" alt=""></div>
      </div>
      <script>
        //获取url中的参数
        function getUrlParam(name) {
          var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
          var r = window.location.search.substr(1).match(reg);  //匹配目标参数
          if (r != null) return unescape(r[2]);
          return null; //返回参数值
        }

        function send_comment() {
          if ($("#comment_holder").attr('placeholder') === '您还没有登录') {
            $("#log_comment").css('display', 'inherit');
          } else {
            if ($("#comment_holder").val() === '') {
              $("#alert_comment").css('display', 'inherit');
            } else {
              $("#success_comment").css('display', 'inherit');
              let game_id = getUrlParam('game_id');
              $.ajax({
                url: "back_end/get_comment.php",
                type: "post",
                data: {
                  "uid": $("#S_uid").text(),
                  "comment": $("#comment_holder").val(),
                  "game_id": game_id
                },
                success: function () {
                  $("#show_comments").prepend("<ul class='media-list' style='padding: 15px;'>" +
                    "<li class='media'>" +
                    "<div class='media-left'>" +
                    "<img class='media-object' src='heads/"+
                    $("#S_head").text()+
                    "' width='50px' style='border-radius: 50%'>" +
                    "</div>" +
                    "<div class='media-body'>" +
                    "<h5 class='media-heading' style='margin-bottom: 16px;color: #f73859'>" + $("#S_uname").text() +
                    "</h5>" + $("#comment_holder").val() +
                    "<br/><br/>" +
                    "<span style='width: 100%;text-align: right;float: right;'>" +
                    "刚刚</span>" + "</div> </li> </ul>" +
                    "<div style='height: 26px;margin-top: 10px;border-top: 1mm solid #edf0f4'></div>"
                  );
                  $("#comment_holder").val('');
                }
              })
            }
          }
          (function () {
            let close_alert = setInterval(function () {
              $("#log_comment").fadeOut(2000);
              $("#success_comment").fadeOut(2000);
              $("#alert_comment").fadeOut(4000);
              clearInterval(close_alert);
            }, 2000)
          })();
        }
      </script>
      <style>
        .hu__hu__2 {
          animation: hu__hu__ infinite 2s ease-in-out
        }

        @keyframes hu__hu__ {
          50% {
            transform: translate(30px, -30px)
          }
        }
      </style>

      <div class="row" style="margin-top: 50px">
        <div class="col-xs-2 "></div>
        <div class="col-xs-8 comment" style="background-color: rgba(223, 233, 243, .9);border-radius: 15px" id="show_comments">
          <?php foreach ($comments as $comment) {
            if ($comment == null) continue; ?>
            <?php
              $u_head = mysqli_fetch_assoc(findUser_ID($comment['uid']))['heading'];
            ?>
            <ul class="media-list" style="padding: 15px;">
              <li class="media">
                <div class="media-left">
                    <img class="media-object" src="heads/<?php echo $u_head?>" width="50px" style="border-radius: 50%">
                </div>
                <div class="media-body">
                  <h5 class="media-heading"
                      style="margin-bottom: 16px;color: #f73859;"><?php echo $comment['uname'] ?></h5>
                  <span style="word-wrap: break-word;word-break: break-all"><?php echo $comment['content'] ?></span>
                  <br/><br/>
                  <span style="width: 100%;text-align: right;float: right;"><?php echo $comment['publishtime'] ?></span>
                </div>
              </li>
            </ul>
            <div style="margin-top: 10px;border-top: 1mm solid #edf0f4"></div>
          <?php } ?>

        </div>
      </div>


    </div>
  </div>

</div>

</body>
<?php include_once 'footer.php' ?>
</html>
