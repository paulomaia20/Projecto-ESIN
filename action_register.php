<?php
  include ('config/init.php');
  include ('database/user.php');

  $username = strip_tags($_POST['name']); //Removes HTML from a string
  $password = $_POST['password'];
  $email = $_POST['email']; //Tentar com o strip_tags

  if (!$username || !$password || !$email) {
    $_SESSION['error_message'] = 'All fields are mandatory!';
    $_SESSION['form_values'] = $_POST;
    die(header('Location: register.php?msg='.$_SESSION['error_message']));
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
      $_SESSION['error_message'] = 'FAILED!';

    $_SESSION['form_values'] = $_POST;
   // echo $e; para debugging 
     

    die(header('Location: register.php?msg='.$_SESSION['error_message']));
  }

  header('Location: templates/header.php');
?>
