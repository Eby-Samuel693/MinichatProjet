<?php
use MinichatProjet\Classes\DB;

require_once "../../assets/php/functions.php";
require_once "../../Classes/DB.php";

if (!empty($_GET['id'])) {
    $bdd = DB::getInstance();

    $id = (int)$_GET['id'];

    $requete = $bdd->prepare("SELECT * FROM message WHERE id > :id  ORDER BY id DESC");
    $requete->execute(array('id' => $id));

    $messages = null;

    while ($donnees = $requete->fetch()) {
        $idUser_fk = $donnees['user_fk'];
        $requete2 = $bdd->prepare("SELECT * FROM user WHERE  id = $idUser_fk");
        $requete2->execute();

        foreach ($requete2->fetchAll() as $donnees2) {
            $messages .= "<div id='" . $donnees['id'] . "' class='flexColumn messages'>
                <div class='flexRow width100'>
                       <p class='width30 colorBlue bold'>" . $donnees2['pseudo'] . "</p>
                       <p class='colorGrey'>" . $donnees['date'] . "</p>
                </div>
                <p class='text'>" . $donnees['message'] . "</p>
            </div>";
        }
        echo $messages;
    }
}