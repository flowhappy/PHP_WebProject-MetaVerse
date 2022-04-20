<?php
include_once 'CRUD/user_CRUD.php';
if (isset($_POST['uname_lg']) && isset($_POST['upwd_lg'])) {
  $res = findUser($_POST['uname_lg']);
  $pwd = mysqli_fetch_assoc($res)['upassword'];//123456de
  session_start();
  if ($pwd === $_POST['upwd_lg']) {
    $_SESSION['name'] = $_POST['uname_lg'];
    $_SESSION['head'] = mysqli_fetch_assoc(findUser($_POST['uname_lg']))['heading'];
    $_SESSION['uid'] = mysqli_fetch_assoc(findUser($_POST['uname_lg']))['uid'];
    $_SESSION['is_login'] = 'true';
    if($_POST['auto_lg']==1){
      setcookie('uname',$_SESSION['name'],time()+360000);
      setcookie('head',$_SESSION['head'],time()+360000);
      setcookie('uid',$_SESSION['uid'],time()+360000);
    }
  }else{
    $_SESSION['is_login'] = 'false';
  }
  $_SESSION['is_logout'] = 'false';
  $_SESSION['show_in'] = 0;
}