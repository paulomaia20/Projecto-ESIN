<?php 

function getMissionByUser($name) {
    global $conn;

    //Vai buscar a missão atual de um dado utilizador, à tabela user mission. 
    //FALTA: Mostrar badge

    $stmt = $conn->prepare('SELECT mission.id, mission.description, mission.score
                           FROM user_mission
                           JOIN mission ON user_mission.id_mission=mission.id
                           JOIN users ON user_mission.name_user=users.name');
    $stmt->execute();
    return $stmt->fetch();
  
  }

  function getTasksByMission($id_mission) {
    global $conn;

    //Vai buscar a missão atual de um dado utilizador, à tabela user mission. 
    $stmt = $conn->prepare('SELECT *
                           FROM tasks_mission
                           JOIN mission ON tasks_mission.id_mission=mission.id
                           JOIN task ON tasks_mission.id_task=task.id
                           WHERE mission.id = ?
                           ORDER BY id_task DESC;');
    $stmt->execute(array($id_mission));
    return $stmt->fetchAll();
  }

  function getTasksByUser($username) {
    global $conn;

    //Vai buscar as tarefas atuais de um dado utilizador 
    $stmt = $conn->prepare('SELECT users.name, user_tasks.completed, user_tasks.id_task
                           FROM user_tasks
                           JOIN users ON user_tasks.name_user=users.name
                           JOIN task ON user_tasks.id_task=task.id
                           WHERE users.name = ?
                           ORDER BY id_task DESC;');
    $stmt->execute(array($username));
    return $stmt->fetchAll();
  }

  function updateTask($task_id, $username, $completed) {
    global $conn;

    //UPDATE - Atualiza a lista de tarefas ao pressionar o botão submit.
    //Se o user tiver terminado todas as tarefas, insere na base de dados a 
    //próxima missão (id da última +1) e atualiza a sua pontuação. 

    //Vai buscar a missão atual de um dado utilizador, à tabela user mission. 
    if($completed===true)
    {
      print_r("completed===true");
      $stmt = $conn->prepare('UPDATE user_tasks
                           SET completed=true
                           WHERE user_tasks.id_task = ?
                           AND user_tasks.name_user = ?');
    }
  /*  else
    {
      print_r("completed===false");
      $stmt = $conn->prepare('UPDATE
      user_tasks
      SET completed=false
      WHERE user_tasks.id_task = ?
      AND user_tasks.name_user = ?');
    } */ 

     $stmt->execute(array($task_id, $username));

    return $stmt->fetchAll();  
  }

  function checkAllTasksCompleted($username) {
    global $conn;
 
   
      $stmt = $conn->prepare('UPDATE user_tasks
                           SET completed=true
                           WHERE user_tasks.id_task = ?
                           AND user_tasks.name_user = ?');
    

     $stmt->execute(array($task_id, $username));

    return $stmt->fetchAll();  
  }


?> 