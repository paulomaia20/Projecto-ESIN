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

    //Vai buscar a missão atual de um dado utilizador, dà tabela user mission. 
    $stmt = $conn->prepare('SELECT task.id, task.description
                           FROM task
                           JOIN mission ON task.id_mission=mission.id
                           WHERE mission.id = ?
                           ');
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

  function getCompletedTasks($username, $completed) {
    global $conn;

    //Vai buscar as tarefas atuais de um dado utilizador 
    $stmt = $conn->prepare('SELECT task.description, task.id, user_tasks.completed
                           FROM user_tasks
                           JOIN users ON user_tasks.name_user=users.name
                           JOIN task ON user_tasks.id_task=task.id
                           WHERE users.name = ?
                           AND user_tasks.completed=?
                    
                          ');
    $stmt->execute(array($username,$completed));
    return $stmt->fetchAll();
  }

  

  function updateTask($task_id, $username) {
    global $conn;

    //UPDATE - Atualiza a lista de tarefas ao pressionar o botão submit.
    //Se o user tiver terminado todas as tarefas, insere na base de dados a 
    //próxima missão (id da última +1) e atualiza a sua pontuação. 

    //Vai buscar a missão atual de um dado utilizador, à tabela user mission. 
   
      $stmt = $conn->prepare('UPDATE user_tasks
                           SET completed=true
                           WHERE user_tasks.id_task = ?
                           AND user_tasks.name_user = ?');
    
     $stmt->execute(array($task_id, $username));

    return $stmt->fetchAll();  
  }

  function checkAllTasksCompleted($username, $id_mission) {
    global $conn;
 
   
      $stmt = $conn->prepare('SELECT *
      FROM user_tasks'); //INCOMPLETO
    

     $stmt->execute(array($task_id, $username));

    return $stmt->fetchAll();  
  }


?> 