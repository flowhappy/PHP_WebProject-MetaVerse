<?php
include_once 'connectSQL.php';
function add_games($game_name,$class,$game_poster,$game_video,$game_img1,$game_img2,$game_inf1,$game_inf2,$company,$writer,$uid){
  $link = get_connect();
  $sql = "insert into 
            games_detail 
            (game_name,class,game_poster,game_video,game_img1,game_img2,game_inf1,game_inf2,company,writer,uid)
          values 
            ('$game_name','$class','$game_poster','$game_video','$game_img1','$game_img2','$game_inf1','$game_inf2','$company','$writer','$uid') ";
  CRUD($link,$sql);
}

function findGame_uid($uid){
  $link=get_connect();
  $sql="select * from games_detail where uid like '$uid'";
  $res=CRUD($link,$sql);
  while($res1[]=mysqli_fetch_assoc($res));
  if(!$res1) return 0;
  return $res1;
}

function update_games($game_name,$class,$game_inf1,$game_inf2,$company,$writer,$game_id){
  $link = get_connect();
  $sql = "update games_detail 
            set
            game_name='$game_name',class='$class',game_inf1='$game_inf1',game_inf2='$game_inf2',company='$company',writer='$writer'
          where
            game_id='$game_id'";
  CRUD($link,$sql);
}

