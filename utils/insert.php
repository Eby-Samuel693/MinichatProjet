<?php

function issetPostParams(string ...$params): bool {
    foreach ($params as $param){
        if(!isset($_POST[$param])) {
            return false;
        }
    }
    return true;
}

if(issetPostParams('pseudo', 'email', 'password')) {

    if(empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['password'])) {
        return false;
    }

    try {
        $server = 'localhost';
        $db = 'mini_chat';
        $user = 'root';
        $pass = '';

        $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pass);


        $sql = $bdd->prepare("INSERT INTO user (pseudo,email,password)
                                       VALUES ( ?, ?, ?)");

        $sql->execute([$_POST['pseudo'], $_POST['email'], $_POST['password']]);
        session_start();
        header('location: ../chat.php');

    }
    catch (PDOException$exception) {
        echo $exception->getMessage();
    }
}
else {
    header('location: ../inscription.php');
    echo "Les champs ne sont pas tous remplie";
}

