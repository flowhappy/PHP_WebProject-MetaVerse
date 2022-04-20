<?php
include_once 'connectSQL.php';


function update_head($head,$id){
  $link = get_connect();
  $sql = "update users set heading = '$head' where uid = '$id'";
  CRUD($link,$sql);
}

function update_name($name,$id){
  $link = get_connect();
  $sql = "update users set uname = '$name' where uid = '$id'";
  CRUD($link,$sql);
}

function update_pwd($pwd,$id){
  $link = get_connect();
  $sql = "update users set upassword = '$pwd',auto_reg = 0 where uid = '$id'";
  CRUD($link,$sql);
}