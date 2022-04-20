<?php
include_once '../CRUD/user_CRUD.php';
session_start();
if ($_POST['verify'] == $_SESSION["verify_code"]) {
  $name = $_POST['uname'];
  $pwd = $_POST['upass'];
  $res = addUser($name, $pwd);
  echo 'a';
} else {
  return false;
}

