<?php
session_start();
include_once 'CRUD/user_CRUD.php';
if (isset($_COOKIE['uname'])) {
  $_SESSION['name'] = $_COOKIE['uname'];
  $_SESSION['head'] = $_COOKIE['head'];
  $_SESSION['uid'] = $_COOKIE['uid'];
  $_SESSION['is_login'] = 'true';
  $_SESSION['is_logout'] = 'false';
}
$img_inf = 'unlog.png';
$lg_inf = '您还没有登录';
if (isset($_SESSION['is_login']) && $_SESSION['is_logout'] === 'false' && $_SESSION['is_login'] === 'true') {
  $img_inf = $_SESSION['head'];
  $lg_inf = '发一条友善的评论';
}
$auto_reg = 0;
$music_id=7238513086;
?>
<!doctype html>
<html lang="en">
<head id="top">
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="shortcut icon" href="image/yide'sico.ico">
  <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap-3.4.1/css/normalize.css">
  <link rel="stylesheet" href="iconfont/iconfont.css">
  <link rel="stylesheet" href="vivify.min.css">
  <script src='css-doodle.min.js'></script>
  <script src="jquery-3.6.0.js"></script>
  <script src="bootstrap-3.4.1/js/bootstrap.min.js"></script>
  <script src="bootstrap-3.4.1/js/transition.min.js"></script>
  <script src="bootstrap-3.4.1/js/normalize.js"></script>
</head>
<div id="alert_auto_user" class="alert alert-warning navbar-fixed-top vivify text-center" role="alert" style="z-index: 99999999999;display: none">
  <strong>注意! </strong>你的账户为管理员自动注册，请尽快前往用户后台修改密码
  <button class="btn btn-primary" onclick="$('#alert_auto_user').fadeOut(1000);">好的</button>
</div>
<?php
if(isset($_SESSION['is_login'])){
  $auto_reg =mysqli_fetch_assoc(findUser_ID($_SESSION['uid']))['auto_reg'];
  if($auto_reg==1){
    echo "<script>
$('#alert_auto_user').css('display','inherit');
$('#alert_auto_user').addClass('shake-horizontal');
</script>";
  }
}
?>
<style>
  *{
    cursor: url(cursor/normal.cur), auto;
  }
  .head_cur{
    cursor: url(cursor/button.cur), auto;
  }
  button{
    cursor: url(cursor/button.cur), auto;
  }
  a{
    cursor: url(cursor/link.cur), auto;
  }
  input{
    cursor: url(cursor/write.cur), auto;
  }
  p,h5,h6{
    cursor: url(cursor/text.cur), auto;
  }
  .hu__hu__ {
    animation: hu__hu__ infinite 2s ease-in-out
  }

  @keyframes hu__hu__ {
    50% {
      transform: translateY(30px)
    }
  }

  TweenMax.
  to

  (
  ".hu__hu__"
  ,
  1.5
  ,
  {
    y: 30,
    yoyo: true,
    repeat: -1,
    ease: Sine . easeInOut
  }
  )
  ;
  * {
    transition: 300ms;
  }

  .back_top {
    opacity: 0;
    position: fixed;
    margin-top: 46%;
    margin-left: 93%;
    box-shadow: 0 1px 5px #666666;
    border-radius: 50%;
    cursor: url(cursor/normal.cur), auto;
    text-align: center;
    padding-top: 13px;
    color: #337ab7;
    z-index: 99999;
  }

  .back_top:hover {
    box-shadow: 0 2px 8px #666666;
  }

  @media screen and (max-width: 1200px) {
    .back_top {
      display: none;
    }
  }

  .chang_hover:hover {
    box-shadow: 5px 5px 50px #555555;
    transform: translateY(-25px);
    background-color: #f73859;
    opacity: 1;
  }

  .chang_hover:hover .caption {
    color: white;
    transition: 0.5ms;
  }

  .chang_hover:hover .poster_img {
    transform: scale(1.05);
  }


  .thumbnail {
    overflow: hidden;
    cursor: url(cursor/link.cur), auto;
  }
</style>

<body>
<div id="load_body" class="navbar-fixed-top">
  <style>
    css-doodle {
      --color: @p(#9fc5e8, #fffde1, #ff9d76, #93c47d, #ea9999, #f6b26b);
    --rule: (
    :doodle {
      @grid: 30x1 / 18vmin;  /* 30行1列的网格 */
      --deg: @p(-180deg, 240deg);  /* 旋转角度 */
    }
    :container {
      perspective: 30vmin;  /* 当前较小的vw和vh */
    }
    :after, :before {
      content: '';
      background: var(--color);
      @place-cell: @r(100%) @r(100%);  /* 放置相对于网格的单元格 */
      @size: @r(6px);
      @shape: heart;   /* 形状 */
    }
    @place-cell: center;
    @size: 100%;
    box-shadow: @m2(0 0 50px var(--color));
    background: @m100(
    radial-gradient(var(--color) 50%, transparent 0)
    @r(-20%, 120%) @r(-20%, 100%) / 1px 1px
    no-repeat
    );
    will-change: transform, opacity;
    animation: scale-up 28s linear infinite;
    animation-delay: calc(-28s / @size() * @i());
    @keyframes scale-up {
      0%, 95.01%, 100% {
        transform: translateZ(0) rotate(0);
        opacity: 0;
      }
      10% {
        opacity: 1;
      }
      95% {
        transform:
          translateZ(35vmin) rotateZ(@var(--deg));
      }
    }
    )
    }
    #load_body {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
      background: #110f31;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      position: fixed;
      z-index: -99;
    }
  </style>
  <css-doodle use="var(--rule)"></css-doodle>
</div>

<span onclick="back_top()"
      class="back_top glyphicon glyphicon-chevron-up" style="height: 40px;width: 40px;"></span>
<nav id="bar" style="opacity: 0;transition: 300ms;" class="navbar navbar-default navbar-fixed-top">
  <script>
    $("nav").hover(function () {
      $(this).css('opacity', 1);
    }, function () {
      $(this).css('opacity', 0);
    })
  </script>
  <div style="background-color: #eef1f5;" class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
              data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="container-fluid" id="logo" style="margin-left: 15px">
        <div class="navbar-header" onclick="window.location.assign('index.php')" style="cursor: pointer">
          <img class="head_cur" alt="Brand" src="image/Yd's_Base.gif" style="width: 40px;height: 40px;margin-top: 5px;">
        </div>
      </div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">主站</a></li>
        <li><a href="list.php?search=RPG" title="角色扮演游戏">RPG</a></li>
        <li><a href="list.php?search=FPS" title="第一人称射击游戏 ">FPS</a></li>
        <li><a href="list.php?search=SLG" title="策略与战棋类游戏 ">SLG</a></li>
        <li><a href="list.php?search=RAC" title="赛车竞速类游戏 ">RAC</a></li>
        <li><a href="list.php?search=SPG" title="体育类游戏 ">SPG</a></li>

        <form class="navbar-form navbar-left" action="list.php" method="post">
          <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="你想找些什么？">
          </div>
          <button type="submit" class="btn btn-default head_cur">找找看</button>
        </form>
        <div class="navbar-header">
          <img class="vivify" id="user_head" alt="Brand" src="heads/<?php echo $img_inf; ?>"
               style="width: 35px;border-radius: 50%;margin-top: 5px;height: 35px;">
          <script>
            $('#user_head').hover(function () {
              $(this).addClass('spin');
            }, function () {
              $(this).removeClass('spin');
            })
          </script>
        </div>
        <li class="dropdown">
          <a href="#" id="heading" class="dropdown-toggle head_cur" data-toggle="dropdown" role="button"
             aria-haspopup="true" style="font-weight: bolder;"
             aria-expanded="false"><span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li class="logout_op"><a href="user_backstage.php" target="_blank">用户后台</a></li>
            <li class="login_op"><a href="#" onclick="register()">注册</a></li>
            <li class="login_op"><a id="login" href="#" onclick="login()">登录</a></li>
            <li class="logout_op"><a href="#" id="logout" onclick="logout()">退出登录</a></li>
          </ul>
          <script>
            function logout() {
              $.ajax({
                url: "logout.php",
                success: function () {
                  window.location.assign('index.php');
                }
              })
            }
          </script>
          <?php
          if (isset($_SESSION['is_login']) && $_SESSION['is_logout'] === 'false' && $_SESSION['is_login'] === 'true') {
            echo "<script>$('.login_op').css('display','none');</script>";
            echo "<script>$('#heading').css('color','#ffa4db');</script>";
            echo "<script>$('#heading').text('", $_SESSION['name'], "');</script>";
            $img_inf = $_SESSION['head'];
            echo "<script>$('.logout_op').css('display','inherit');</script>";
            echo "<script>$('#log_suc').css('display','inherit');</script>";
          } else {
            echo "<script>$('.logout_op').css('display','none');</script>";
            echo "<script>$('.login_op').css('display','inherit');</script>";
          }
          ?>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<script>
  function register() {
    $("html,body").animate({scrollTop: $("#top").offset().top}, 300);
    $("body").css({'overflow': 'hidden'});
    $(".float-bg").css('display', 'inherit');
    $("#register_wrap").css('display', 'inherit');
    $(".behind_wrap").css('filter', 'blur(5px)');
    $(".login_form").css("margin-top", screen.height * 0.18);
    $("#reg_alert").css('display', 'none');
  }

  function login() {
    $("html,body").animate({scrollTop: $("#top").offset().top}, 300);
    $("body").css({'overflow': 'hidden'});
    $(".float-bg").css('display', 'inherit');
    $("#login_wrap").css('display', 'inherit');
    $(".behind_wrap").css('filter', 'blur(5px)');
    $("#reg_alert").css('display', 'none');
  }

  function close_alert() {
    $("#login_wrap").css('display', 'none');
    $("#register_wrap").css('display', 'none');
    $(".float-bg").css('display', 'none');
    $("body").css({'overflow': 'auto'});
    $(".behind_wrap").css('filter', 'none');
    $(".login_form").css("margin-top", screen.height * 0.25);
    $("#reg_suc").css('display', 'none');
    $("#reg_alert").css('display', 'none');
    $("#uname").val('');
    $("#upwd").val('');
    $("#repwd").val('');
  }
</script>
<div class="float-bg bounce-in-top" id="float-bg">
  <div id="reg_suc" class="alert alert-success alert-dismissible" role="alert"
       style="display: none;position: fixed;width: 100%;text-align: center">
    <strong>Congratulations !</strong> You have successfully registered. Now login?
  </div>
  <div id="name_alert" class="alert alert-warning alert-dismissible vivify popInTop" role="alert"
       style="display: none;position: fixed;width: 100%;text-align: center;z-index: 99999999999999999">
    <strong>来晚一步!</strong> 你的名字被别人先注册啦，换一个吧~
  </div>
  <div id="verify_alert" class="alert alert-danger alert-dismissible vivify popInTop" role="alert"
       style="display: none;position: fixed;width: 100%;text-align: center;z-index: 99999999999999999">
    <strong>验证码错误~</strong> 再试一次吧
  </div>
  <div id="reg_alert" class="shake-horizontal alert alert-danger alert-dismissible" role="alert" style="display: none;
  position: fixed;width: 100%;text-align: center">
    <strong id="alert_inf"></strong>
  </div>
  <div class="container">
    <div class="row login_form">
      <div class="col-lg-4 col-md-3 col-sm-2"></div>
      <div class="log_box col-lg-4 col-md-6 col-sm-8" id="login_wrap">
        <h2 style="font-weight: bolder">Login</h2>
        <!--        <form action="_login.php" method="post">-->
        <div class="input-group input-group-lg input_form">
          <span class="input-group-addon  iconfont" id="sizing-addon1">&#xe617;</span>
          <input type="text" id="uname_lg" name="uname_lg" class="form-control " placeholder="Username"
                 aria-describedby="sizing-addon1">
        </div>
        <div class="input-group input-group-lg input_form">
          <span class="input-group-addon iconfont" id="sizing-addon1">&#xe620;</span>
          <input type="password" id="upwd_lg" name="upwd_lg" class="form-control " placeholder="Password"
                 aria-describedby="sizing-addon1">
        </div>
        <div class="checkbox" style="margin-top: 20px">
          <label>
            <input type="checkbox" id="auto_login"> auto login
          </label>
        </div>
        <button id="log" class="btn btn-primary" style="margin-top: 30px;font-size: medium">Login</button>
        <!--        </form>-->
      </div>
      <div class="log_box col-lg-4 col-md-6 col-sm-8" id="register_wrap" style="height: 500px">
        <h2 style="font-weight: bolder">Register</h2>
        <!--        <form action="" method="post">-->
        <div class="input-group input-group-lg input_form">
          <span class="input-group-addon  iconfont" id="sizing-addon1">&#xe617;</span>
          <input id="uname" name="uname" type="text" class="form-control " placeholder="Username"
                 aria-describedby="sizing-addon1">
        </div>
        <script>
          function check_name() {
            let name = $("#uname").val();
            $.ajax({
              url: "back_end/check_name.php",
              type: "post",
              async: false,
              data: {
                "name": name
              },
              success: function (res) {
                if (res == false) {
                  $("#name_alert").removeClass('popOutTop');
                  $("#name_alert").css('display', 'inherit');
                  $("#uname").focus();
                  $("#reg").attr('disabled', 'true')
                } else {
                  $("#name_alert").addClass('popOutTop');
                  $("#reg").removeAttr('disabled');
                }
              }
            })
          }
        </script>
        <div class="input-group input-group-lg input_form">
          <span class="input-group-addon iconfont" id="sizing-addon1">&#xe620;</span>
          <input id="upwd" name="upass" type="password" class="form-control " placeholder="Password"
                 aria-describedby="sizing-addon1" onfocus="check_name()">
        </div>
        <div class="input-group input-group-lg input_form">
          <span class="input-group-addon iconfont" id="sizing-addon1">&#xe620;</span>
          <input id="repwd" type="password" class="form-control " placeholder="rePassword"
                 aria-describedby="sizing-addon1" onfocus="check_name()">
        </div>
        <div class="input-group input-group-lg input_form">
          <span class="input-group-addon iconfont" id="sizing-addon1">&#xe620;</span>
          <input id="verify" type="text" class="form-control " placeholder="Verification Code"
                 aria-describedby="sizing-addon1" onfocus="check_name()">
        </div>
        <div style="margin-top: 20px">
          <img src="code.php" alt="" id="change" style="cursor: pointer;opacity: 1;border-radius: 20px;">
        </div>
        <button id="reg" class="btn btn-primary" style="margin-top: 30px;font-size: medium">Register</button>
        <!--        </form>-->
      </div>
      <script>
        /*Ajax提交数据*/
        $("#reg").click(function () {
          $("#reg_alert").css('display', 'none');
          let name = $("#uname").val();
          let pwd = $("#upwd").val();
          let repwd = $("#repwd").val();
          if (name.length < 3 || name.length > 15) {
            //姓名提示框
            $("#reg_alert").css('display', 'inherit');
            $("#alert_inf").text(' The user name cannot be empty and its length is 3 ~ 15 ');
            return 0;
          }
          if (pwd.length < 8) {
            //密码提示框
            $("#reg_alert").css('display', 'inherit');
            $("#alert_inf").text('The password cannot be empty and its length is not less than 8');
            return 0;
          }
          if (repwd !== pwd) {
            //重复密码提示框
            $("#reg_alert").css('display', 'inherit');
            $("#alert_inf").text('Inconsistent passwords');
            return 0;
          }
          $.ajax({
            url: "back_end/_register.php",
            type: "post",
            data: {
              "uname": $("#uname").val(),
              "upass": $("#upwd").val(),
              "verify": $("#verify").val()
            },
            success: function (data) {
              if (data == false) {
                $("#verify_alert").removeClass('popOutTop');
                $("#verify_alert").css('display', 'inherit');
                $("#verify").val('');
              } else {
                close_alert();
                login();
                $("#reg_suc").css('display', 'inherit');
                $("#uname").val('');
                $("#upwd").val('');
                $("#repwd").val('');
                $("#verify").val('');
              }
              $("#change").click();
              setTimeout(() => {
                $("#verify_alert").addClass('popOutTop');
              }, 2000)
            }
          })
        })
        $("#log").click(function () {
          $("#reg_alert").css('display', 'none');
          let name = $("#uname_lg").val();
          let pwd = $("#upwd_lg").val();
          let auto_login = 0;
          /*
          * 类似于$("...").attr("checked");返回的是checked或者undefined
          * 类似于$("...").prop("checked");返回的是true或者false*/
          if ($("#auto_login").prop("checked")) {
            auto_login = 1;
          }
          if (name.length === 0) {
            //姓名提示框
            $("#reg_alert").css('display', 'inherit');
            $("#alert_inf").text(' The user name cannot be empty');
            return 0;
          }
          if (pwd.length === 0) {
            //密码提示框
            $("#reg_alert").css('display', 'inherit');
            $("#alert_inf").text('The password cannot be empty');
            return 0;
          }

          $.ajax({
            url: "_login.php",
            type: "post",
            data: {
              "uname_lg": $("#uname_lg").val(),
              "upwd_lg": $("#upwd_lg").val(),
              "auto_lg": auto_login
            },
            success: function () {
              window.location.assign('index.php');
            }
          })
        })


      </script>
      <div class="col-lg-1 col-md-1 col-sm-1" onclick="close_alert()">
        <div class="glyphicon rotate-center glyphicon-remove"
             style="color: red;cursor: pointer;font-size: large"></div>
      </div>
    </div>
  </div>
</div>
<script>
  $('#change').click(function () {
    $('#change').attr('src', 'code.php?t=' + Math.random());
    return false;
  })
  $(".login_form").css("margin-top", screen.height * 0.25);
</script>
<style>
  .shake-horizontal {
    -webkit-animation: shake-horizontal 0.8s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
    animation: shake-horizontal 0.8s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
  }

  @-webkit-keyframes shake-horizontal {
    0%,
    100% {
      -webkit-transform: translateX(0);
      transform: translateX(0);
    }
    10%,
    30%,
    50%,
    70% {
      -webkit-transform: translateX(-10px);
      transform: translateX(-10px);
    }
    20%,
    40%,
    60% {
      -webkit-transform: translateX(10px);
      transform: translateX(10px);
    }
    80% {
      -webkit-transform: translateX(8px);
      transform: translateX(8px);
    }
    90% {
      -webkit-transform: translateX(-8px);
      transform: translateX(-8px);
    }
  }

  @keyframes shake-horizontal {
    0%,
    100% {
      -webkit-transform: translateX(0);
      transform: translateX(0);
    }
    10%,
    30%,
    50%,
    70% {
      -webkit-transform: translateX(-10px);
      transform: translateX(-10px);
    }
    20%,
    40%,
    60% {
      -webkit-transform: translateX(10px);
      transform: translateX(10px);
    }
    80% {
      -webkit-transform: translateX(8px);
      transform: translateX(8px);
    }
    90% {
      -webkit-transform: translateX(-8px);
      transform: translateX(-8px);
    }
  }

  .rotate-center:hover {
    -webkit-animation: rotate-center 0.6s ease-in-out both;
    animation: rotate-center 0.6s ease-in-out both;
  }

  @-webkit-keyframes rotate-center {
    0% {
      -webkit-transform: rotate(0);
      transform: rotate(0);
    }
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  @keyframes rotate-center {
    0% {
      -webkit-transform: rotate(0);
      transform: rotate(0);
    }
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  .input_form {
    margin: 30px auto 0;
    width: 80%;
  }

  .log_box {
    display: none;
    text-align: center;
    height: 350px;
    background-color: rgba(245, 245, 245, .9);
    box-shadow: 0 0 20px #f5f5f5;
    border-radius: 20px;
  }

  .bounce-in-top {
    -webkit-animation: bounce-in-top 1s both;
    animation: bounce-in-top 1s both;
  }

  @-webkit-keyframes bounce-in-top {
    0% {
      -webkit-transform: translateY(-500px);
      transform: translateY(-500px);
      -webkit-animation-timing-function: ease-in;
      animation-timing-function: ease-in;
      opacity: 0;
    }
    38% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      -webkit-animation-timing-function: ease-out;
      animation-timing-function: ease-out;
      opacity: 1;
    }
    55% {
      -webkit-transform: translateY(-65px);
      transform: translateY(-65px);
      -webkit-animation-timing-function: ease-in;
      animation-timing-function: ease-in;
    }
    72% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      -webkit-animation-timing-function: ease-out;
      animation-timing-function: ease-out;
    }
    81% {
      -webkit-transform: translateY(-28px);
      transform: translateY(-28px);
      -webkit-animation-timing-function: ease-in;
      animation-timing-function: ease-in;
    }
    90% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      -webkit-animation-timing-function: ease-out;
      animation-timing-function: ease-out;
    }
    95% {
      -webkit-transform: translateY(-8px);
      transform: translateY(-8px);
      -webkit-animation-timing-function: ease-in;
      animation-timing-function: ease-in;
    }
    100% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      -webkit-animation-timing-function: ease-out;
      animation-timing-function: ease-out;
    }
  }

  @keyframes bounce-in-top {
    0% {
      -webkit-transform: translateY(-500px);
      transform: translateY(-500px);
      -webkit-animation-timing-function: ease-in;
      animation-timing-function: ease-in;
      opacity: 0;
    }
    38% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      -webkit-animation-timing-function: ease-out;
      animation-timing-function: ease-out;
      opacity: 1;
    }
    55% {
      -webkit-transform: translateY(-65px);
      transform: translateY(-65px);
      -webkit-animation-timing-function: ease-in;
      animation-timing-function: ease-in;
    }
    72% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      -webkit-animation-timing-function: ease-out;
      animation-timing-function: ease-out;
    }
    81% {
      -webkit-transform: translateY(-28px);
      transform: translateY(-28px);
      -webkit-animation-timing-function: ease-in;
      animation-timing-function: ease-in;
    }
    90% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      -webkit-animation-timing-function: ease-out;
      animation-timing-function: ease-out;
    }
    95% {
      -webkit-transform: translateY(-8px);
      transform: translateY(-8px);
      -webkit-animation-timing-function: ease-in;
      animation-timing-function: ease-in;
    }
    100% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      -webkit-animation-timing-function: ease-out;
      animation-timing-function: ease-out;
    }
  }

  .float-bg {
    display: none;
    width: 100%;
    height: 100%;
    background-color: rgba(223, 233, 243, .6);
    position: absolute;
    left: 0;
    top: 0;
    z-index: 99999;
  }

  .fade-in-top {
    -webkit-animation: fade-in-top 0.38s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
    animation: fade-in-top 0.38s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
  }

  @-webkit-keyframes fade-in-top {
    0% {
      -webkit-transform: translateY(-50px);
      transform: translateY(-50px);
      opacity: 0;
    }
    100% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      opacity: 1;
    }
  }

  @keyframes fade-in-top {
    0% {
      -webkit-transform: translateY(-50px);
      transform: translateY(-50px);
      opacity: 0;
    }
    100% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      opacity: 1;
    }
  }


</style>
</body>
<?php
if (isset($_SESSION['change_pwd']) && $_SESSION['change_pwd'] === 'true') {
  echo "<script>logout()</script>";
  $_SESSION['change_pwd'] = 'false';
}
?>
</html>