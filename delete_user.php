<?php
include_once 'CRUD/connectSQL.php';
$uid = $_GET['uid'];
function delete_user($uid) {
  $link = get_connect();
  $sql1 = "delete from comment where uid = '$uid'";
  CRUD($link, $sql1);
  $sql = "delete from users where uid = '$uid'";
  CRUD($link, $sql);
}

delete_user($uid);

echo "<script>window.location.assign('user_backstage.php')</script>";
