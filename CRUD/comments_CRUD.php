<?php
include_once 'connectSQL.php';
include_once 'user_CRUD.php';
function add_comment_ID($uid,$comment,$game_id){
  $link=get_connect();
  $user_res=mysqli_fetch_assoc(findUser_ID($uid));
  $uname=$user_res['uname'];
  $sql="insert into comment(content,uid,gameid,uname) values('$comment','$uid','$game_id','$uname')";
  CRUD($link,$sql);
}

function get_comments($game_id){
  $link=get_connect();
  $sql = "select * from comment where gameid = '$game_id' order by publishtime desc";
  $res = CRUD($link,$sql);
  while($res1[]=mysqli_fetch_assoc($res));
  if(!$res1) return 0;
  return $res1;
}
