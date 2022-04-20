<?php
include_once 'connectSQL.php';

function findGame_ID($id){
  $link=get_connect();
  $sql="select * from games_detail where game_id = '$id'";
  $res=CRUD($link,$sql);
  $res=mysqli_fetch_assoc($res);
  return $res;
}

function findGame_inf($inf){
  $link=get_connect();
  $sql="select * from games_detail where game_name like '%$inf%' or class like '%$inf%' or game_inf1 like '%$inf%' or game_inf2 like '%$inf%' ";
  $res=CRUD($link,$sql);
  while($res1[]=mysqli_fetch_assoc($res));
  if(!$res1) return 0;
  return $res1;
}

function add_likeCount($id){
  $link=get_connect();
  $sql="update games_detail set read_count = read_count+1 where game_id = '$id'";
  CRUD($link,$sql);
}

function findGame(){
  $link=get_connect();
  $sql="select * from games_detail order by game_id desc";
  $res=CRUD($link,$sql);
  while($res1[]=mysqli_fetch_assoc($res));
  if(!$res1) return 0;
  return $res1;
}

function findGame_byname($name){
  $link=get_connect();
  $sql="select * from games_detail where writer = '$name' order by game_id desc";
  $res=CRUD($link,$sql);
  while($res1[]=mysqli_fetch_assoc($res));
  if(!$res1) return 0;
  return $res1;
}

function find_hotGame(){
  $link=get_connect();
  $sql="select * from games_detail order by read_count desc";
  $res=CRUD($link,$sql);
  while($res1[]=mysqli_fetch_assoc($res));
  if(!$res1) return 0;
  return $res1;
}
