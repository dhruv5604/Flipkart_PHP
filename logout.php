<?php
// require('check_post.php');       

session_start();
session_unset();
session_destroy();

header("Location: index");
