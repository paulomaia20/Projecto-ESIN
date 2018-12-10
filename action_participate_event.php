<?php
  include ('config/init.php');
  include ('database/event.php');


  $event_id=$_POST['eventID'];
  $user_name=$_SESSION['name'];
  addParticipantToEvent($event_id, $user_name);

  header('Location: event_page.php?id='.$id);
  
  ?> 