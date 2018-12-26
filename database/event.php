<?php

  function createEvent($title, $date, $body, $place, $type, $name_creator) {
    global $conn;
    $stmt = $conn->prepare('INSERT INTO event (title, date, description, place, id_type, name_creator) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($title, $date, $body, $place, $type, $name_creator));

    return $conn->lastInsertID(); 
  }

  function getAllEventTypes() {
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM event_type');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function getEventById($id) {
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM event WHERE id=?');
    $stmt->execute(array($id));
    return $stmt->fetch();
  }

  function getCommentsByEventId($id, $page) {
    global $conn;
    $limit_per_page=3;
    $stmt = $conn->prepare('SELECT comment.id, comment.description, comment.date, comment.name_user
                            FROM comment
                            JOIN event ON comment.id_event=event.id
                            WHERE event.id=?
                            ORDER BY date ASC
                            LIMIT 3 OFFSET ?');
    $stmt->execute(array($id, ($page-1) * $limit_per_page));
    return $stmt->fetchAll();
  }

  function getNrCommentsInEvent($id_event) {
    global $conn;
    $stmt = $conn->prepare('SELECT COUNT(comment.id) AS cmt_nr
                            FROM comment
                            JOIN event ON comment.id_event=event.id
                            WHERE event.id=?');
    $stmt->execute(array($id_event));
    return $stmt->fetch();
  }

  function getEventParticipants($id) {
    global $conn;
    $stmt = $conn->prepare('');
    $stmt->execute(array($id));
    return $stmt->fetchAll();
  }

  function getAllEvents($page) {
    global $conn;
    $limit_per_page=3; 
    $stmt = $conn->prepare('SELECT * 
                           FROM event 
                           ORDER BY id DESC
                           LIMIT 3 OFFSET ?'); //Dava me erro a colocar aqui o limit per page
    $stmt->execute(array(($page-1) * $limit_per_page));
    return $stmt->fetchAll();
  
  }

  function addComment($description,$name_creator, $id_event) {

  global $conn;

  $stmt = $conn->prepare('INSERT INTO comment(description,name_user, id_event) VALUES (?, ?,?)');
  $stmt->execute(array($description,$name_creator, $id_event));
  }

  function deleteComment($comment_id,$event_creator_name, $user_name, $logged_user_name) {
    global $conn;
    if ($event_creator_name==$user_name || $logged_user_name==$user_name )
         {
        $stmt = $conn->prepare('DELETE FROM comment
                            WHERE comment.id=?');
         $stmt->execute(array($comment_id));

         }
    }

    function selectAllParticipants($id_event) {

      global $conn;
    
      $stmt = $conn->prepare('SELECT *
                              FROM event_participants
                              JOIN users ON event_participants.name_user=users.name
                              WHERE event_participants.id_event=?
                              ');
      $stmt->execute(array($id_event));
      return $stmt->fetchAll();

      }

      function getNrParticipantsInEvent($id_event) {
        global $conn;
        $stmt = $conn->prepare('SELECT COUNT(*) AS part_nr
                                FROM event_participants WHERE event_participants.id_event=?');
                                
        $stmt->execute(array($id_event));
        return $stmt->fetch();
      }

      function addParticipantToEvent($id_event, $name_participant) {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO event_participants(id_event, name_user) VALUES (?, ?)');
                                
        $stmt->execute(array($id_event ,$name_participant));
        return $stmt->fetch();
      }

      function checkIfParticipantInEvent($name, $event_id) {
        global $conn;
        //acabar query 
        $stmt = $conn->prepare('SELECT * FROM event_participants WHERE name_user = ?
        AND id_event=?');
                                
        $stmt->execute(array($name,$event_id));
        return $stmt->fetch();
      }

      function getEventsBySearch($title, $name_creator, $place) {
        global $conn;

        $query = 'SELECT * FROM event WHERE 1=1';
        $params = array();

        if ($title !== '') {
          $query .= ' AND title ILIKE ?';
          $params[] = '%' . $title . '%';
        }

        if ($name_creator !== '') {
          $query .= ' AND name_creator ILIKE ?';
          $params[] = $name_creator;
        }

        if ($place !== '') {
          $query .= ' AND place ILIKE ?';
          $params[] = $place;
        }

        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
      }

    function getEventTypeById( $id) {
      global $conn;
      $stmt = $conn->prepare('SELECT * FROM event_type JOIN event ON event_type.id=event.id_type WHERE event.id=?');
      $stmt->execute(array($id));
      return $stmt->fetch();
    }


?>
