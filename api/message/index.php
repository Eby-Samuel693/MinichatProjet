<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Entity/Message.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Manager/UserM.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Manager/MessageM.php';


use MiniChat\Entity\Message;
use MiniChat\Manager\MessageM;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];
$manager = new MessageM();

switch($requestType) {
    case 'GET':
        if(isset($_GET['id']))
            echo getmessage($manager, intval($_GET['id']));
        else
            echo getmessages($manager);
        break;
    case 'POST':
        $response = [
            'error' => 'success',
            'message' => 'Message envoyé avec succès',
        ];

        $data = json_decode(file_get_contents('php://input'));
        if(isset($data->message, $data->date, $data->user)) {
            $user = intval($data->user);
            $result = $manager->addMessage($data->message, $data->date, $user);
            if(!$result) {
                $response = [
                    'error' => 'danger',
                    'message' => 'Une erreur est survenue en envoyant le message',
                ];
            }
        }
        else {
            $response = [
                'error' => 'danger',
                'message' => 'Le message, la date ou l\'id du pseudo est manquant',
            ];
        }
        echo json_encode($response);
        break;
}

/**
 * Return the messages list.
 * @param MessageM $manager
 * @return false|string
 */
function getMessages(MessageM $manager): string {
    $response = [];
    $data = $manager->getMessages();
    foreach($data as $message) {
        /* @var Message $message */
        $response[] = [
            'id' => $message->getId(),
            'message' => $message->getMessage(),
            'date' => $message->getDate(),
            'user' => [
                'id' => $message->getUser()->getId(),
                'pseudo' => $message->getUser()->getPseudo(),
            ],
        ];
    }
    // Send the response (we encode our array in json format).
    return json_encode($response);
}

/**
 * Return only one message.
 * @param MessageM $manager
 * @param int $id
 * @return string
 */
function getMessage(MessageM $manager, int $id): string {
    $message = $manager->getMessage($id);
    $response[] = [
        'id' => $message->getId(),
        'message' => $message->getMessage(),
        'date' => $message->getDate(),
        'user' => [
            'id' => $message->getUser()->getId(),
            'pseudo' => $message->getUser()->getPseudo(),
        ],
    ];
    return json_encode($response);
}

exit;