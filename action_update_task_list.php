<?php
  include ('config/init.php');
  include ('database/missions.php');

 // print_r($_POST['tasks']);

if(isset($_POST['tasks'])) //Did he submit any task?
{   
    print_r("post <br>");
    print_r($_POST['tasks']);
    $tasks_selected = $_POST['tasks'];
    
    foreach($tasks_selected as $task_selected)
         updateTask($task_selected, $_SESSION['name']); //Não selecionou ou desselecionou

//header('Location: homepage.php');

}

  ?>
