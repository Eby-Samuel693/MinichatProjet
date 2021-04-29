<?php

namespace MiniChat\Manager;

use MinichatProjet\Classes\DB;
use MinichatProjet\Entity\user;
use MinichatProjet\Entity\message;
use MinichatProjet\Manager\UserM;
use PDO;

class MessageM {

    private UserM $userManager;

    /**
     * UserManager constructor.
     */
    public function __construct() {
        $this->userManager = new UserM();
    }

    /**
     * Return a list of messages.
     * @return array|null
     */
    public function getMessages(): array {
        $messages = [];
        // we retrieve the last 50 messages posted //ORDER BY id DESC LIMIT 0,50
        $request = DB::getInstance()->prepare("SELECT * FROM message ORDER BY id DESC LIMIT 0,50");
        $request->execute();
        $messages_response = $request->fetchAll();

        if($messages_response) {
            foreach($messages_response as $data) {
                $user = $this->userManager->getUser($data['user_fk']);
                $messages[] = new Message($data['id'], $data['message'], $data['date'], $user);
            }
        }

        return $messages;
    }

    /**
     * Fetch provided Message ( id ).
     * @param int $id
     * @return Message
     */
    public function getMessage(int $id): Message {
        $request = DB::getInstance()->prepare("SELECT * FROM message WHERE id = :id");
        $request->bindValue(':id', $id);
        $request->execute();
        $message_data = $request->fetch();
        $message = new message();
        if($message_data) {
            $message->setId($message_data['id']);
            $message->setMessage($message_data['message']);
            $message->setDate($message_data['date']);
            $user = $this->userManager->getUser($message_data['user_fk']);
            $message->setUser($user);
        }
        return $message;
    }

    /**
     * Add a new message into the database.
     * @param $message
     * @param $date
     * @param $user
     * @return bool
     */
    public function addMessage(string $message,string $date,int $user): bool{
        $request = DB::getInstance()->prepare("
            INSERT INTO message (message, date, user_fk)
              VALUES (:message, :date, :user_fk)
        ");
        $request->bindParam(':message', $message);
        $request->bindParam(':date', $date);
        $request->bindParam(':user_fk', $user, PDO::PARAM_INT);
        $request->execute();
        return intval(DB::getInstance()->lastInsertId()) !== 0;
    }
}

