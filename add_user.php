<?php
include_once 'CRUD/connectSQL.php';
include_once 'CRUD/user_CRUD.php';
$name = $_POST['username'];
$pwd = '123456de';
$res = add_dUser($name,$pwd);