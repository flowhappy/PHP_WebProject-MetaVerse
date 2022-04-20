<?php
include_once '../CRUD/connectSQL.php';
session_start();
$link = get_connect();
$name = $_POST['name'];
$sql = "select * from users where uname = '$name'";
$res = CRUD($link,$sql);
if(mysqli_fetch_assoc($res)!=NULL){
  return false;
}else{
  echo 'a';
}?>