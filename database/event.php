<?php

  function createEvent($title, $date, $body, $place, $type, $name_creator) {
    global $conn;
    $stmt = $conn->prepare('INSERT INTO event (title, date, description, place, type, name_creator) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($title, $date, $body, $place, $type, $name_creator));
  }

  function getAllEventTypes() {
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM event_type');
    $stmt->execute();
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



?>
