<?php
  include ('config/init.php');
  include ('database/user.php');



  $name = $_GET['name'];
  $email = $_POST ['email'];
  $password = $_POST ['password'];
  $loged_user_name= $_SESSION['name']; 
  $path_img=$_POST['path_img']; 
  
  if(!empty($_FILES['image']['name']))
  {
  include('templates/change_avatar.php');
  }
  
  if (!$email || !$password ) {
    $_SESSION['error_message'] = 'You did not fill all mandatory fields!';
    die(header('Location: edit_profile.php?name='.$name));
  }

  
  
  try {
    editProfile($email, $password, $path_img, $loged_user_name);
    
    $_SESSION['success_message'] = 'Edited profile!';
    
  } catch (PDOException $e ) {
    $_SESSION['error_message'] = 'An error ocurred!';
    die(header('Location: edit_profile.php?name='.$name));
  

  }

  header('Location: user_profile.php?name='.$name);
?>
