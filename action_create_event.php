<?php
  include ('config/init.php');
  include ('database/event.php');

  $title = strip_tags($_POST['title']); //Removes HTML from a string
  $date = $_POST['date']; 
  $body = strip_tags($_POST['body']); 
  $place = $_POST['place']; 
  $type = $_POST['type']; 
  $name_creator= $_SESSION['name']; 

  if (!$title || !$place || !$type) {
    $_SESSION['error_message'] = 'You did not fill all mandatory fields!';
    die(header('Location: create_event.php'));
  }

  try {
    createEvent($title, $date, $body, $place, $type, $name_creator);
    $_SESSION['success_message'] = 'Created event!';
  } catch (PDOException $e ) {
    $_SESSION['error_message'] = 'An error ocurred!';
    die(header('Location: create_event.php'));

  }
?>
