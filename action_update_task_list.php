<?php
  include ('config/init.php');
  include ('database/missions.php');

 // print_r($_POST['tasks']);

if(isset($_POST['tasks'])) //Did he submit any task?
{   
    print_r("post <br>");
    print_r($_POST['tasks']);
    $tasks_selected = $_POST['tasks'];
    $curr_mission=getMissionByUser($_SESSION['name']);    
    $mission_tasks=getTasksByMission($curr_mission['id']);
    echo("mission_tasks <br>");
    print_r($mission_tasks);
    echo("<br>");
    echo("<br>");

   // print_r($tasks_selected);
  //  print_r($mission_tasks);
    $keepGoing=true;
foreach($tasks_selected as $task_selected)
{    //para cada task que o utilizador selecionou verifica se é uma das tarefas 
    // desta missão. Isto porque o POST só faz post do que está checked. 
    foreach ($mission_tasks as $task)
        {
            
            if($task['id_task']==$task_selected)
                 {
                    print_r('aqui crl <br>');
                    print_r($task['id_task']);
                    updateTask($task_selected, $_SESSION['name'],true); //Selecionou
                  }
           /* else 
                 {
                     print_r('no else');
                     updateTask($task_selected, $_SESSION['name'],false); //Não selecionou ou desselecionou
                } */ 
        }
}

header('Location: homepage.php');

}

  ?>
