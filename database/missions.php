<?php 

function getMissionByUser($name) {
    global $conn;

    //Vai buscar a missão atual de um dado utilizador, à tabela user mission. 
    // Como nesta tabela não removemos as missões à medida que ele a vai completando,
    // ordenamos o id da missão e vamos buscar o primeiro elemento.

    $stmt = $conn->prepare('SELECT mission.id, mission.description, mission.score
                           FROM user_mission
                           JOIN mission ON user_mission.id_mission=mission.id
                           JOIN users ON user_mission.name_user=users.name
                           WHERE users.name=?
                           ORDER BY mission.id DESC;');
    $stmt->execute(array($name));
    return $stmt->fetch();
  
  }

  function getTasksByMission($id_mission) {
    global $conn;

    //Vai buscar a missão atual de um dado utilizador, dà tabela user mission. 
    $stmt = $conn->prepare('SELECT task.id, task.description
                           FROM task
                           JOIN mission ON task.id_mission=mission.id
                           WHERE mission.id = ?
                          ORDER BY task.id ASC;
                           ');
    $stmt->execute(array($id_mission));
    return $stmt->fetchAll();
  }

  function getCompletedTasks($username, $id_mission) {
    global $conn;

    //Vai buscar as tarefas atuais de um dado utilizador 
    $stmt = $conn->prepare('SELECT task.id, task.description
                            FROM user_progress
                            JOIN task ON task.id=user_progress.id_task
                            WHERE user_progress.name_user=?
                            AND task.id_mission=?
                            ORDER BY user_progress.id_task ASC;                 
                          ');

                          //Incomplete! 
    $stmt->execute(array($username, $id_mission));
    return $stmt->fetchAll();
  }

  function arrayRecursiveDiff($aArray1, $aArray2) { 
    $aReturn = array(); 

    foreach ($aArray1 as $mKey => $mValue) { 
        if (array_key_exists($mKey, $aArray2)) { 
            if (is_array($mValue)) { 
                $aRecursiveDiff = arrayRecursiveDiff($mValue, $aArray2[$mKey]); 
                if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; } 
            } else { 
                if ($mValue != $aArray2[$mKey]) { 
                    $aReturn[$mKey] = $mValue; 
                } 
            } 
        } else { 
            $aReturn[$mKey] = $mValue; 
        } 
    } 

    return $aReturn; 
}

function check_diff_multi($array1, $array2){
  $result = array();
  foreach($array1 as $key => $val) {
       if(isset($array2[$key])){
         if(is_array($val) && $array2[$key]){
             $result[$key] = check_diff_multi($val, $array2[$key]);
         }
     } else {
         $result[$key] = $val;
     }
  }

  return $result;
}

  function getIncompleteTasks($username, $id_mission) {
    global $conn;
    $all_tasks=getTasksByMission($id_mission);
    $completed_tasks=getCompletedTasks($username, $id_mission);
    $incomplete_tasks=array_diff(array_column($all_tasks,'id'),array_column($completed_tasks,'id'));
    
    //Get all info
    $incomplete_tasks_array=array();
    foreach($incomplete_tasks as $incomplete_task)
{
    $stmt = $conn->prepare('SELECT task.id, task.description
                            FROM task
                            WHERE task.id=?
                          ');

    $stmt->execute(array($incomplete_task));
    array_push($incomplete_tasks_array,$stmt->fetch());
  }
  
    return $incomplete_tasks_array;
  }

  

  function updateTask($task_id, $username) {
    global $conn;

    //UPDATE - Atualiza a lista de tarefas ao pressionar o botão submit.


    //Vai buscar a missão atual de um dado utilizador, à tabela user mission. 
   
      $stmt = $conn->prepare('INSERT INTO user_progress(name_user,id_task)
                          SELECT ?,?
                          WHERE
                           NOT EXISTS (
                            SELECT id_task FROM user_progress WHERE id_task = ?
                            AND name_user= ?
                              );');
    
     $stmt->execute(array($username,$task_id,$task_id, $username));

    return $stmt->fetchAll();  
  }

  
function deleteTask($task_id, $username) {
    global $conn;

      $stmt = $conn->prepare('DELETE FROM user_progress
                          WHERE name_user=?
                          AND id_task=?
                          ;');
    
     $stmt->execute(array($username,$task_id));

  }

  function checkAllTasksCompleted($completed_tasks, $mission_tasks) {
    global $conn;
 
     if($completed_tasks==$mission_tasks && !empty($mission_tasks) )
        return true; 

  return false; 
  }

  function insertNextMission($username, $id_old_mission) {
    global $conn;
 
      //Insert completed mission
      $stmt = $conn->prepare('INSERT INTO user_mission(id_mission, name_user) VALUES(?,?) '); 
      $stmt->execute(array($id_old_mission+1,$username));
    
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