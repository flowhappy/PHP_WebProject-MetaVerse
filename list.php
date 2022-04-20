<?php
include 'header.php';
include_once 'CRUD/games_CRUD.php';
if (isset($_GET['search'])) $_POST['search'] = $_GET['search'];
$title = "有关 “" . $_POST['search'] . "” 的搜索结果";
$res = findGame_inf($_POST['search']);
if (!$_POST['search']) $title = '全部内容';
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Title</title>
  </head>

  <style>
    * {
      transition: all 300ms;
    }

    .thumbnail {
      transition: 300ms;
      border: none;
      margin-top: 20px;
      opacity: 0.9;
    }

    .row {
      margin-top: 30px;
    }

    .scroll_show {
      opacity: 0;
      transform: translateY(200px);
      transition: 1000ms;
    }

    .show {
      opacity: 1;
      transform: translateY(0px);
    }

  </style>
  <body>
  <div class="behind_wrap  fade-in-top">
    <div class="container" style="width: 100%; margin-top: 10px;">
      <div class="jumbotron">
        <h1
          style="background-color: white;opacity: 0.6;border-radius: 20px;padding: 20px;font-weight: bolder"><?php echo $title; ?></h1>
        <p style="height: 50px"></p>
        <p><a class="btn btn-primary btn-lg head_cur" onclick="get_more()" role="button">Let's start</a></p>
      </div>
    </div>
    <div id="hot"></div>
    <div class="container">
      <h3 style="font-weight: bolder;margin-top: 5%;">
        <span style="background-color: white;opacity: 0.68;padding: 10px;border-radius: 10px">仓库</span>
        <span class="label label-default" style="margin-left: 10px;background-color: rgba(255,0,13,0.78)">Store</span>
      </h3>
      <div style="height: 10px"></div>
      <div class="row" style="margin-top: 20px">
        <?php if ($res[0]) {
          foreach ($res as $item) {
            if ($item == null) continue ?>
            <div class="col-lg-4 col-md-6 col-sm-6 scroll_show"
                 onclick="window.open('detail.php?game_id=<?php echo $item['game_id'] ?>');">
              <div class="thumbnail chang_hover">
                <img class="poster_img vivify" data-src="image/<?php echo $item['game_poster']; ?>" alt="...">
                <div class="caption">
                  <h3 class="text-center"><?php echo $item['game_name']; ?></h3>
                  <p style="padding: 10px;line-height: 25px;"><?php echo $item['game_inf1']; ?></div>
              </div>
            </div>
          <?php }
        } else { ?>
          <h1>暂无结果，搜搜别的？</h1>
          <form style="height: 66px" class="navbar-form navbar-left" action="list.php" method="post">
            <div class="form-group">
              <input type="text" name="search" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        <?php } ?>
      </div>
    </div>
  </div>
  </body>
  <script>
    let box = $('.scroll_show');
    let images = $('.poster_img');
    box.each(function (index, item) {
      if (item.getBoundingClientRect().top < window.innerHeight) {
        $(this).addClass('show');
        images.each(function (index, item) {
          if (item.getBoundingClientRect().top < window.innerHeight){
            item.src = item.getAttribute('data-src');
          }
        });
      }
    });
    $(window).scroll(() => {
      box.each(function (index, item) {
        if (item.getBoundingClientRect().top < window.innerHeight) {
          $(this).addClass('show');
          images.each(function (index, item) {
            if (item.getBoundingClientRect().top < window.innerHeight){
              item.src = item.getAttribute('data-src');
            }
          });
        }
      });
    });
  </script>
  </html>
<?php require_once 'footer.php'; ?>