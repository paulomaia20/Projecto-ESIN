<?php
  include ('config/init.php');
  include ('database/event.php');

  $title = $_POST['title'];
  $date = $_POST['date']; 
  $body = $_POST['body']; 
  $place = $_POST['place']; 
  $type = $_POST['type']; 
  $name_creator= $_SESSION['name']; 

  if (!$title || !$place || !$type) {
    $_SESSION['error_message'] = 'You did not fill all mandatory fields!';
    die(header('Location: create_event.php'));
  }

  $now = new DateTime();
  $present_date = $now->format('Y-m-d');
  $event_date = strtotime($date);
  if($event_date < $now) { //Verificar se a data é anterior à de hoje!!!
    $_SESSION['error_message'] = 'Date of the event is in the past';
    die(header('Location: create_event.php'));

  }
  
  try {
    $id=createEvent($title, $date, $body, $place, $type, $name_creator);
    $_SESSION['success_message'] = 'Created event!';

  } catch (PDOException $e ) {
    $_SESSION['error_message'] = 'An error ocurred!';
    die(header('Location: create_event.php'));

  }

  header('Location: event_page.php?id='.$id);
?>
