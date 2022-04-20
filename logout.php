<?php
session_start();
$_SESSION['is_logout'] = 'true';
$_SESSION['show_out'] = 0;
unset($_SESSION['is_login']);
unset($_SESSION['show_in']);
unset($_SESSION['name']);
setcookie('uname','',time()-360000);
setcookie('head','',time()-360000);
setcookie('uid','',time()-360000);
unset($_COOKIE['uname']);