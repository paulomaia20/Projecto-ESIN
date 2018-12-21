<?php
  include ('config/init.php');
  include ('database/event.php');

  
  $id=$_POST['id'];
  $description = strip_tags($_POST['description']); 
  $name_creator=$_SESSION['name'];

  if (!$description || !$id || !$name_creator) {
    $_SESSION['error_message'] = 'You did not fill all mandatory fields!';
    die(header('Location: event_page.php?id='.$id));
  }
  else{

    try {
    addComment($description, $name_creator, $id);}
    catch (PDOException $e ) {
        die(header('Location: event_page.php?id='.$id));
    }
  }

  header('Location: event_page.php?id='.$id);

  ?>
