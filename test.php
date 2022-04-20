<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src='css-doodle.min.js'></script>
</head>
<body>
<css-doodle>
  :doodle {
  @grid: 20 / 100vmax;
  background: #0a0c27;
  font-family: sans-serif;
  overflow: hidden;
  }
  :after {
  content: \@hex.@r(0x2500, 0x257f);
  color: hsla(@r360, 70%, 70%, @r.9);
  font-size: 8vmin;
  }
</css-doodle>
</body>
</html>