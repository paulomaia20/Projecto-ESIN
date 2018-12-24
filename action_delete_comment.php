<?php
  include ('config/init.php');
  include ('database/event.php');

  if(isset($_GET)){
  $id=$_GET['id'];
  $event_id=$_GET['event_id'];
  $event_creator_name=$_GET['creator_name'];
  $user_name=$_GET['user_name'];
  $logged_user_name=$_SESSION['name'];

  try {
  deleteComment($id, $event_creator_name, $user_name, $logged_user_name); //Checks if user can delete comment
}
  catch (PDOException $e ) {
    $_SESSION['error_message'] = 'An unknown error ocurred!';
    die(header('Location: event_page.php?id='.$event_id));
  }

  header('Location: event_page.php?id='.$event_id);

}

  ?> 