<?php
  include ('config/init.php');
  include ('database/event.php');

  var_dump($_GET);

  if(isset($_GET)){
  $id=$_GET['id'];
  $event_id=$_GET['event_id'];
  $event_creator_name=$_GET['creator_name'];
  $user_name=$_GET['user_name'];
  $logged_user_name=$_SESSION['name'];
  deleteComment($id, $event_creator_name, $user_name, $logged_user_name);
  header('Location: event_page.php?id='.$event_id);
}

  ?> 