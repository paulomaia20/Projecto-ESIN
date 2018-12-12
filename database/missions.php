<?php 

function getMissionByUser($name) {
    global $conn;

    //Vai buscar a missão atual de um dado utilizador, à tabela user mission. 

    $stmt = $conn->prepare('SELECT mission.id, mission.description, mission.score
                           FROM user_mission
                           JOIN mission ON user_mission.id_mission=mission.id
                           JOIN users ON user_mission.name_user=users.name
                           ORDER BY mission.id DESC;');
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

  function getCompletedTasks($username, $completed, $id_mission) {
    global $conn;

    //Vai buscar as tarefas atuais de um dado utilizador 
    $stmt = $conn->prepare('SELECT task.description, task.id, task.id_mission, user_tasks.completed
                           FROM user_tasks
                           JOIN users ON user_tasks.name_user=users.name
                           JOIN task ON user_tasks.id_task=task.id
                           WHERE users.name = ?
                           AND user_tasks.completed=?
                           AND task.id_mission=?
                           ORDER BY id_task DESC;
                    
                          ');
    $stmt->execute(array($username,$completed, $id_mission));
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
 
    //Get all user tasks
      $stmt = $conn->prepare('SELECT task.description, task.id, user_tasks.completed
      FROM user_tasks
      JOIN users ON user_tasks.name_user=users.name
      JOIN task ON user_tasks.id_task=task.id
      WHERE user_tasks.name_user = ?
      ORDER BY id_task DESC;'); 

     $stmt->execute(array($username));

     $all_tasks=$stmt->fetchAll();
    // print_r($all_tasks);

     $completed_tasks=getCompletedTasks($username, 'TRUE', $id_mission);
    // print_r($completed_tasks);

     if($completed_tasks==$all_tasks)
      return true; 
  return false; 
  }

  function insertNextMission($username, $id_old_mission) {
    global $conn;
 
   
      //Insert completed mission
      $stmt = $conn->prepare('INSERT INTO user_mission(id_mission, name_user) VALUES(?,?) '); 
      $stmt->execute(array($id_old_mission+1,$username));

      //Get new mission's tasks
      //... 

    
  }

  function getBadgesInMission($id_mission) {
    global $conn;
 
      $stmt = $conn->prepare('SELECT *
      FROM badge 
      JOIN mission ON badge.id_mission=mission.id
      WHERE mission.id=?');
  
     $stmt->execute(array($id_mission));

    return $stmt->fetchAll();  
  }


?> 