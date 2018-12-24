<?php
  include ('config/init.php');
  include ('database/missions.php');

if(isset($_POST['tasks'])) //Did he submit any task?
{   
    $tasks_selected = $_POST['tasks'];
    
    foreach($tasks_selected as $task_selected)
       {  try {updateTask($task_selected, $_SESSION['name']);}
         catch(PDOException $e )
         {
          die(header('Location: homepage.php'));
         }
        }
header('Location: homepage.php');

}

  ?>
