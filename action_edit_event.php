<?php
  include ('config/init.php');
  include ('database/event.php');

  $id = $_GET['id'];
  $title = $_POST['title']; //Removes HTML from a string
  $date = $_POST['date']; 
  $body = $_POST['body']; 
  $place = $_POST['place']; 
  $type = $_POST['type']; 
  $name_creator= $_POST['name_creator'];
  $user_name= $_SESSION['name']; 

  if (!$title || !$place || !$type) {
    $_SESSION['error_message'] = 'You did not fill all mandatory fields!';
    die(header('Location: edit_event.php?id='.$id));
  }

  if($date < $now) {//Verificar se a data é anterior à de hoje!!!
    $_SESSION['error_message'] = 'Date of the event is in the past';
    die(header('Location: edit_event.php?id='.$id));

  }
  
  try {
    editEvent($title, $date, $body, $place, $type, $name_creator, $user_name, $id);
    $_SESSION['success_message'] = 'Edited event!';

  } catch (PDOException $e ) {
    $_SESSION['error_message'] = 'An error ocurred!';
    //die(header('Location: edit_event.php?id='.$id));

  }

  //header('Location: event_page.php?id='.$id);
?>
