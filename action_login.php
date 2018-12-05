<?php
  include ('config/init.php');
  include ('database/user.php');

  $username = $_POST['name'];
  $password = $_POST['password'];

  if (isValidUser($username, $password)) {
    session_start(); //Não sei se é preciso - aparece no init.php 
    $_SESSION['success_message'] = 'Login successful!';
    $_SESSION['name'] = $username;

  } else {
    $_SESSION['error_message'] = 'Login failed!';
    die(header('Location: login.php'));
  }

  header('Location: homepage.php');
?>
