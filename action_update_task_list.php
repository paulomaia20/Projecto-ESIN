<?php
  include ('config/init.php');
  include ('database/missions.php');

if(isset($_POST['tasks'])) //Did he submit any task?
{   
    $tasks_selected = $_POST['tasks'];
    
    $mission=getMissionByUser($_SESSION['name']);
    $all_tasks=getTasksByMission($mission['id']);

    //Convert into same format
    $all_tasks_id=array();
    foreach($all_tasks as $task)
      array_push($all_tasks_id,$task['id']);
     
    $not_selected_tasks=array_diff($all_tasks_id,$tasks_selected);


    foreach($not_selected_tasks as $not_selected_task)
       {  try {
        deleteTask($not_selected_task, $_SESSION['name']);
      
        }
         catch(PDOException $e )
         {
         //  die($e);
          die(header('Location: homepage.php'));
         }
        }
    
    foreach($tasks_selected as $task_selected)
       {  try {
         updateTask($task_selected, $_SESSION['name']);
       
        }
         catch(PDOException $e )
         {
          die(header('Location: homepage.php'));
         }
        }

}
header('Location: homepage.php');

  ?>
