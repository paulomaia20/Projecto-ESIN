<?php

  function isValidUser($username, $password) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE name = ?');
    $stmt->execute(array($username));
    
    $user = $stmt->fetch();

    return $user !== false && password_verify($password, $user['password']);
  }

  function userExists($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE name = ?');
    $stmt->execute(array($username));
    
    $user = $stmt->fetch();

    return $user !== false;
  }



  function createUser($username, $password, $email) {
   
    global $conn;

    $options = [
        'cost' => 12
    ];

    $hash = password_hash($password, PASSWORD_DEFAULT, $options);

    $stmt = $conn->prepare('INSERT INTO users VALUES (?, ?, ?)');
    $stmt->execute(array($username, $email, $hash));

    //Add first mission 
    $stmt = $conn->prepare('INSERT INTO user_mission(id_mission, name_user) VALUES (?, ?)');
    $stmt->execute(array(1,$username));

  }

  function getUserInfo($name) {
    //Function for getting info for the user profile
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE name=?');
    $stmt->execute(array($name));
  }

  function getLatestBadges($name) {
    //Function for getting info for the user profile
    global $conn;

    $stmt = $conn->prepare('SELECT badge.name, badge.path_img 
                            FROM user_mission
                            JOIN badge USING(id_mission)
                            WHERE name_user=?
                            ORDER BY id_mission DESC
                            OFFSET 1
                            LIMIT 5
                            '); //Can't count badge of current mission
    $stmt->execute(array($name));
    return $stmt->fetchAll();
  }

  function getLatestMissions($name) {
    //Function for getting info for the user profile
    global $conn;

    $stmt = $conn->prepare('SELECT user_mission.id_mission
                            FROM user_mission
                             WHERE name_user=?
                            ORDER BY id_mission DESC
                            OFFSET 1
                            LIMIT 5
                            '); //Can't count badge of current mission
    $stmt->execute(array($name));
    return $stmt->fetchAll();
  }

  function getLatestEvents($name) {
    //Function for getting info for the user profile
    global $conn;

    $stmt = $conn->prepare('SELECT event.title, event.date, event.id
                            FROM event_participants
                            JOIN event ON event_participants.id_event=event.id
                            WHERE event_participants.name_user=?
                            ORDER BY event.date DESC
                            LIMIT 5
                            '); 
    $stmt->execute(array($name));
    return $stmt->fetchAll();
  }

  function getTotalScore($name) {
    //acabar
    global $conn;

    //Score from missions - Não está a fazer bem o offset 
    $stmt = $conn->prepare('SELECT SUM(score) AS score
                            FROM (
                            SELECT * FROM user_mission
                            JOIN mission ON user_mission.id_mission=mission.id
                            WHERE name_user = ?
                            ORDER BY id_mission DESC
                 
                            OFFSET 1
                            ) AS sbqry                           
                            GROUP BY sbqry.name_user
                            HAVING(sbqry.name_user=?)
                            '); 
    $stmt->execute(array($name,$name));
    $missions_score=$stmt->fetch();

      //Score from events
      $stmt = $conn->prepare('SELECT SUM(sbqry.evt_score) AS score
                            FROM (
                            SELECT event_type.score AS evt_score, name_user FROM event_participants
                            JOIN event ON event_participants.id_event=event.id
                            JOIN event_type ON event.id_type=event_type.id
                            ) AS sbqry                           
                            GROUP BY sbqry.name_user
                            HAVING(sbqry.name_user=?)
      '); 
     $stmt->execute(array($name));
     $events_score=$stmt->fetch();

    return ($missions_score['score'] + $events_score['score']);
  }

  function getLevelFromTotalScore($score) {
    //acabar
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM level'); 
    $stmt->execute();
    $levels = $stmt->fetchAll();

    foreach($levels as $level)
    {
      if($level['min_score'] > $score) 
      { //O score mínimo está acima do score atual, logo ele está no nível anterior
        return (array($level['id_level']-1,$level['min_score']));

      }
    }
  }

?>
