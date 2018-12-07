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
                           WHERE mission.id = ?');
    $stmt->execute(array($id_mission));
    return $stmt->fetchAll();
  }

  function updateTaskList($id_mission) {
    global $conn;

    //UPDATE - Atualiza a lista de tarefas ao pressionar o botão submit.
    //Se o user tiver terminado todas as tarefas, insere na base de dados a 
    //próxima missão (id da última +1) e atualiza a sua pontuação. 

    //Vai buscar a missão atual de um dado utilizador, à tabela user mission. 
   /* $stmt = $conn->prepare('SELECT *
                           FROM tasks_mission
                           JOIN mission ON tasks_mission.id_mission=mission.id
                           JOIN task ON tasks_mission.id_task=task.id
                           WHERE mission.id = ?');
    return $stmt->fetchAll(); */ 
  }


?> 