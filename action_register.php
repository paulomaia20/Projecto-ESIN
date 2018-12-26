<?php
  include ('config/init.php');
  include ('database/user.php');

  $username = strip_tags($_POST['name']); //Removes HTML from a string
  $password = $_POST['password'];
  $email = strip_tags($_POST['email']); //Tentar com o strip_tags
  $confirm_pw=$_POST['confirm_password'];

  if (!$username || !$password || !$email) {
    $_SESSION['error_message'] = 'All fields are mandatory!';
    die(header('Location: register.php'));
  }

  elseif ($password!==$confirm_pw) {
    $_SESSION['error_message'] = 'Passwords do not match';
    die(header('Location: register.php'));
  }

  try {
    createUser($username, $password, $email);
    $_SESSION['success_message'] = 'User registered with success!';
    
  } catch (PDOException $e ) {

    if (strpos($e->getMessage(), 'users_pkey') !== false)
     {
       $_SESSION['error_message'] = 'Username already exists!';
    } 
    else
      $_SESSION['error_message'] = 'Registration failed for unknown reason!';

      die($e);
    //$_SESSION['form_values'] = $_POST;
    die(header('Location: register.php'));
  }

  header('Location: login.php');
?>
