<?php
include_once 'back_header.php';
include_once 'CRUD/user_back_CRUD.php';
include_once 'CRUD/connectSQL.php';
session_start();
$link = get_connect();
$name = $_POST['new_name'];
$sql = "select * from users where uname = '$name'";
$res = CRUD($link,$sql);
$error = [];
if ($_POST['new_name']) {
  if (strlen($_POST['new_name']) > 15 || strlen($_POST['new_name']) < 3) {
    $error[] = 'The user name cannot be empty and its length is 3 ~ 15';
  }else if (isset($res)) {
    if(mysqli_fetch_assoc($res)!=NULL){
      if($_SESSION['name']!==$name){
        $error[] = '用户名已占用';
      }
    }else {
      update_name($_POST['new_name'], $_SESSION['uid']);
      $_SESSION['name'] = $_POST['new_name'];
    }
  }
}
if ($_FILES['head']['name'] !== '') {
  $file_name = $_FILES['head']['name'];
  $file_tmpName = $_FILES['head']['tmp_name'];
  $file_size = $_FILES['head']['size'];
  $file_type = explode('.', $file_name);
  $valid_types = ['jpeg', 'jpg', 'png', 'gif'];
  if (!in_array($file_type[1], $valid_types)) {
    $error[] = 'wrong type';
  }
  if ($file_size > 2097152) {
    $error[] = 'file is too big';
  }
  if (empty($error)) {
    $random_inf = date("YmdHis") . rand(100, 999);
    move_uploaded_file($_FILES['head']['tmp_name'], 'heads/' . $random_inf . $_FILES['head']['name']);
    update_head($random_inf . $_FILES['head']['name'], $_SESSION['uid']);
    $_SESSION['head'] = $random_inf . $_FILES['head']['name'];
  } else {
    foreach ($error as $item) {
      echo $item, '<br/>';
    }
    echo "failed to upload!";
    echo "<a href='user_backstage.php'>返回重新上传</a>";
  }
}
if (empty($error)){
  $_SESSION['change_pwd'] = 'true';
  echo "<script>window.location.assign('index.php')</script>";
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

