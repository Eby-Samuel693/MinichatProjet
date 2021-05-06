<?php

    try {

        // connection to the database

        $server = 'localhost';
        $db = 'mini_chat';
        $user = 'root';
        $pass = '';

        // json recovery
        $recup = file_get_contents('php://input');
        $recup = json_decode($recup, true);

        $message = $recup['message'];
        $sam = $recup['user'];

        // send to database
        $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pass);
        $req = $bdd->prepare("INSERT INTO message (user, message)
                                       VALUES ( ?, ?)");
        // execution of the request
        $req->execute([$sam, $message]);

    }
    catch (PDOException $exception) {
        echo $exception->getMessage();
    }




