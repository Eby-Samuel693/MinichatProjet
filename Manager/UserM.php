<?php

namespace MiniChat\Manager;

use MinichatProjet\Classes\DB;
use MinichatProjet\Entity\User;

class UserM {

    /**
     * Return a user based on id.
     * @param int $id
     * @return user
     */
    public function getuser(int $id): user {
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE id=:id");
        $request->bindValue(':id', $id);
        $request->execute();
        $user_data = $request->fetch();
        $user = new user();
        if ($user_data) {
            $user->setId($user_data['id']);
            $user->setPseudo($user_data['pseudo']);
            $user->setEmail($user_data['email']);
            $user->setPassword($user_data['password']);
        }
        return $user;
    }

    /**
     * Return a users list.
     * @return array
     */
    public function getusers(): array {
        $users = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user");
        $request->execute();
        $users_response = $request->fetchAll();

        if($users_response) {
            foreach($users_response as $data) {
                $users[] = new user($data['id'], $data['pseudo'], $data['email'], $data['password']);
            }
        }
        return $users;

    }

}
