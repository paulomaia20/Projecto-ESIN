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

?>
