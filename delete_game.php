<?php
include_once 'back_header.php';
include_once 'CRUD/connectSQL.php';
$game_id = $_GET['game_id'];
function delete_game($game_id) {
  $link = get_connect();
  $sql1 = "delete from comment where gameid = '$game_id'";
  CRUD($link, $sql1);
  $sql = "delete from games_detail where game_id = '$game_id'";
  CRUD($link, $sql);
}

delete_game($game_id);

if($_GET['operate']==1){
  echo "<script>window.location.assign('admin_operate.php')</script>";
}else{
  echo "<script>window.location.assign('user_backstage.php')</script>";
}