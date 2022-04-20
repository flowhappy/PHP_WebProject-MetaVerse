<?php
include_once 'CRUD/games_back_CRUD.php';
include_once 'CRUD/games_CRUD.php';
include_once 'back_header.php';
session_start();
$uid = $_SESSION['uid'];
$error = [];
$game_id = $_GET['game_id'];
var_dump($game_id);
$game_name = $_POST['game_name'];
if ($game_name === '') $error[] = '文章名不能为空';

$class = $_POST['class'];
if ($class === '') $error[] = '请选择类型';

$game_inf1 = $_POST['game_inf1'];
if ($game_inf1 === '') $error[] = '文章简介需要大约90字';

$game_inf2 = $_POST['game_inf2'];
if ($game_inf2 === '') $error[] = '文章内容不能为空';

$company = $_POST['company'];
if ($company === '') $error[] = '公司不能为空';

$writer = $_POST['writer'];
if ($writer === '') $error[] = '发行商不能为空';

if (!count($error)) {
  update_games($game_name, $class, $game_inf1,$game_inf2,$company,$writer,$game_id);
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
      <?php if(!$error){ ?>
        <strong style="color: green">更新成功！</strong>
        <a href="detail.php?game_id=<?php echo $game_id ?>">查看更新后的文章</a>
        <br/>
        <br/>
        <a href="user_backstage.php">返回后台管理</a>
      <?php } ?>
    </div>
  </div>
</div>
