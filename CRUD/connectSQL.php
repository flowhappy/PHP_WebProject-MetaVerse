<?php
function get_connect() {
  $link = mysqli_connect('localhost:3306', 'root', 'password');
  mysqli_query($link, 'use games');
  mysqli_query($link, 'set names utf8');
  return $link;
}

function CRUD($link, $query) {
  $res = mysqli_query($link, $query);
  return $res;
}
