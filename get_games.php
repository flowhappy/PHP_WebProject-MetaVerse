<?php
include_once 'CRUD/games_back_CRUD.php';
include_once 'CRUD/games_CRUD.php';
include_once 'back_header.php';
session_start();
$uid = $_SESSION['uid'];
$error = [];
$valid_imgTypes = ['jpeg', 'jpg', 'png', 'gif'];
$valid_videoTypes = ['webm', 'mp4', 'mov', 'rmvb', 'mkv'];

$game_name = $_POST['game_name'];
if ($game_name === '') $error[] = '文章名不能为空';

$class = $_POST['class'];
if ($class === '') $error[] = '请选择类型';

$game_poster = $_FILES['game_poster'];
if ($game_poster['name'] === '') {
  $error[] = '请选择封面';
} else {
  $poster_type = explode('.', $game_poster['name'])[1];
  $poster_name = explode('.', $game_poster['name'])[0];
  if (!in_array($poster_type, $valid_imgTypes)) $error[] = 'wrong type of the poster';
  if ($game_poster['size'] > 512000) $error[] = 'the size of the poster is too big, should be less than 500kb';
}
$game_video = $_FILES['game_video'];
if ($game_video['name'] === '') {
  $error[] = '请选择视频';
} else {
  $video_type = explode('.', $game_video['name'])[1];
  $video_name = explode('.', $game_video['name'])[0];
  if (!in_array($video_type, $valid_videoTypes)) $error[] = 'wrong type of the video';
  if ($game_video['size'] > 41943040) $error[] = 'the size of the video is too big, should be less than 40MB';
  echo '<br/><br/><br/>';
}

$game_img1 = $_FILES['game_img1'];
if ($game_img1['name'] === '') {
  $error[] = '请选择图片1';
} else {
  $img1_type = explode('.', $game_img1['name'])[1];
  $img1_name = explode('.', $game_img1['name'])[0];
  if (!in_array($img1_type, $valid_imgTypes)) $error[] = 'wrong type of the img1';
  if ($game_img1['size'] > 512000) $error[] = 'the size of the img1 is too big, should be less than 500kb';
}

$game_img2 = $_FILES['game_img2'];
if ($game_img2['name'] === '') {
  $error[] = '请选择图片2';
} else {
  $img2_type = explode('.', $game_img2['name'])[1];
  $img2_name = explode('.', $game_img2['name'])[0];
  if (!in_array($img2_type, $valid_imgTypes)) $error[] = 'wrong type of the img2';
  if ($game_img2['size'] > 512000) $error[] = 'the size of the img2 is too big, should be less than 500kb';
}

$game_inf1 = $_POST['game_inf1'];
if ($game_inf1 === '') $error[] = '文章简介需要大约90字';

$game_inf2 = $_POST['game_inf2'];
if ($game_inf2 === '') $error[] = '文章内容不能为空';

$company = $_POST['company'];
if ($company === '') $error[] = '公司不能为空';

$writer = $_POST['writer'];
if ($writer === '') $error[] = '发行商不能为空';

$file_array = [$game_poster, $game_video, $game_img1, $game_img2];

if (!count($error)) {
  foreach ($file_array as $item) {
    $random_inf = date('YmdHis') . rand(100, 999);
    move_uploaded_file($item['tmp_name'], 'image/' . $random_inf . $item['name']);
    $file_name[] = $random_inf . $item['name'];
  }
  add_games($game_name, $class,$file_name[0],$file_name[1],$file_name[2],$file_name[3],
            $game_inf1,$game_inf2,$company,$writer,$uid);
  $game_id = findGame()[0]['game_id'];
}

?>

<div class="container">
  <div class="row" style="margin-top: 50px">
    <div class="col-xs-3"></div>
    <div class="col-xs-6" style="padding: 50px;font-size: large;
    box-shadow: 0 0 30px <?php if ($error){
      echo 'red';
    }else{
      echo 'dodgerblue';
    } ?>;border-radius: 20px;margin-top: 50px;line-height: 50px">
      <?php
      if($error) {
        foreach ($error as $item) {
          echo $item, '<br/>';
        }
        echo "<a href='user_backstage.php'>返回重新提交</a>";
      }?>
      <?php if(isset($game_id)){ ?>
      <strong style="color: green">发布成功！</strong>
      <a href="detail.php?game_id=<?php echo $game_id ?>">查看新发布的文章</a>
        <br/>
        <br/>
        <a href="user_backstage.php">返回后台管理</a>
      <?php } ?>
    </div>
  </div>
</div>
