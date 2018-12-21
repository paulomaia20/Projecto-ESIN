<?php
  include ('config/init.php');
  include ('database/event.php');


  $event_id=$_POST['eventID'];
  $user_name=$_SESSION['name'];
  try {
  addParticipantToEvent($event_id, $user_name);
  }
  catch (PDOException $e ) {
    $_SESSION['error_message'] = 'An unknown error ocurred!';
    die(header('Location: event_page.php?id='.$event_id));
  }

  header('Location: event_page.php?id='.$event_id);
  
  ?> 