<?php
include_once 'connectSQL.php';
function addUser($name, $pwd) {
  $link = get_connect();
  $sql = "insert into users (uname,upassword) values ('$name','$pwd')";
  $res = CRUD($link, $sql);
  return $res;
}

function findUser($name) {
  $link = get_connect();
  $sql = "select * from users where uname = '$name'";
  $res = CRUD($link, $sql);
  return $res;
}

function findUser_ID($id) {
  $link = get_connect();
  $sql = "select * from users where uid = '$id'";
  $res = CRUD($link, $sql);
  return $res;
}

function add_dUser($name, $pwd) {
  $link = get_connect();
  $sql = "insert into users (uname,upassword,auto_reg) values ('$name','$pwd',1)";
  $res = CRUD($link, $sql);
  return $res;
}