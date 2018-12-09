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

  function getEventById($id) {
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM event WHERE id=?');
    $stmt->execute(array($id));
    return $stmt->fetch();
  }

  function getCommentsByEventId($id) {
    global $conn;
    $stmt = $conn->prepare('SELECT comment.description, comment.date, comment.name_user
                            FROM comment
                            JOIN event ON comment.id_event=event.id
                            WHERE event.id=?');
    $stmt->execute(array($id));
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

?>
