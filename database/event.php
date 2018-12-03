<?php

  function createEvent($temp) {
    global $conn;

    $stmt = $conn->prepare('INSERT INTO users VALUES (?, ?, ?)');
    $stmt->execute(array($username, $email, $hash));
  }

?>
