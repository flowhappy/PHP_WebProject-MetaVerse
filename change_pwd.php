<?php
include_once 'CRUD/user_CRUD.php';
include_once 'CRUD/games_CRUD.php';
include_once 'CRUD/user_back_CRUD.php';
include_once 'back_header.php';
include_once 'back_header.php';
session_start();
$_SESSION['change_pwd'] = 'false';
$uid = $_SESSION['uid'];
$games = findUser_ID($uid);
$upass = mysqli_fetch_assoc(findUser_ID($uid))['upassword'];
$error = [];
if ($_POST['old_pwd'] != $upass) {
  $error[] = 'the origin password is wrong';
} else {
  if (strlen($_POST['new_pwd']) < 8) {
    $error[] = 'The password cannot be empty and its length is not less than 8';
  } elseif ($_POST['new_pwd'] != $_POST['confirm_pwd']) {
    $error[] = 'The new password should be the same';
  } else {
    update_pwd($_POST['confirm_pwd'], $uid);
    $_SESSION['change_pwd'] = 'true';
    echo "<script>window.location.assign('index.php')</script>";
  }
}


?>

<div class="container">
  <div class="row">
    <div class="col-xs-3"></div>
    <div class="col-xs-6" style="padding: 50px;font-size: large;
    box-shadow: 0 0 30px red;border-radius: 20px;margin-top: 50px;line-height: 50px">
      <?php
      foreach ($error as $item) {
        echo $item, '<br/>';
      }
      echo "<a href='user_backstage.php'>返回重新提交</a>";
      ?>
    </div>
  </div>
</div>



