<?php
header('Content-Type:image.png');
//创建图片资源
$img=imagecreatetruecolor(200,45);
//背景色处理
$bg_color=imagecolorallocate($img,220,220,220);
imagefill($img,0,0,$bg_color);

//生成随机文字 一个汉字占用三个字节
$str='超文本预处理器是在服务器端执行的脚本语言尤其适用于网站开发并可嵌入中语法学习了语言吸纳和多个语言的特色发展出自己的特色语法并根据它们的长项持续改进提升自己例如的面向对象编程该语言当初创建网站同时支持面向对象和面向过程的开发使用上非常灵活';
$len=strlen($str);//字符数*3
$char_len=$len/3;//字符数量
$char[]=substr($str,mt_rand(0,$char_len-1)*3,3);
$char[]=substr($str,mt_rand(0,$char_len-1)*3,3);
$char[]=substr($str,mt_rand(0,$char_len-1)*3,3);
$char[]=substr($str,mt_rand(0,$char_len-1)*3,3);


session_start();
$_SESSION['verify_code']=$char[0].$char[1].$char[2].$char[3];
//写入内容
$str_color[]=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
$str_color[]=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
$str_color[]=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
$str_color[]=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
$font='PingFang_Regular.ttf';
imagettftext($img,mt_rand(20,30),mt_rand(-30,30),30,40,$str_color[0],$font,$char[0]);
imagettftext($img,mt_rand(20,30),mt_rand(-30,30),60,40,$str_color[1],$font,$char[1]);
imagettftext($img,mt_rand(20,30),mt_rand(-30,30),110,40,$str_color[2],$font,$char[2]);
imagettftext($img,mt_rand(20,30),mt_rand(-30,30),150,40,$str_color[3],$font,$char[3]);

//干扰
for($i=0;$i<3000;$i++){
  $color=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
  imagesetpixel($img,mt_rand(0,255),mt_rand(0,255),$color);
}



//输出图片资源
imagepng($img);//png格式图片是透明的，比较小

//销毁图片资源
imagedestroy($img);