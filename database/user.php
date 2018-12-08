<?php

  function isValidUser($username, $password) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE name = ?');
    $stmt->execute(array($username));
    
    $user = $stmt->fetch();

    return $user !== false && password_verify($password, $user['password']);
  }

  function createUser($username, $password, $email) {

    //FALTA ADICIONAR A PRIMEIRA MISSÃO 
    
    global $conn;

    $options = [
        'cost' => 12
    ];

    $hash = password_hash($password, PASSWORD_DEFAULT, $options);

    $stmt = $conn->prepare('INSERT INTO users VALUES (?, ?, ?)');
    $stmt->execute(array($username, $email, $hash));
  }

?>
