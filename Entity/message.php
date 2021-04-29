<?php

namespace MinichatProjet\Entity;

use MinichatProjet\Entity\user;

class message {

    private ?int $id;
    private ?string $message;
    private ?string $date;
    private ?user $user;

    public function __construct(int $id = null, string $message = null, string $date = null, user $user = null) {
        $this->id = $id;
        $this->message = $message;
        $this->date = $date;
        $this->user = $user;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getmessage(): ?string {
        return $this->message;
    }

    /**
     * @param string|null $message
     */
    public function setmessage(?string $message): void {
        $this->message = $message;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void {
        $this->date = $date;
    }

    /**
     * @return \MinichatProjet\Entity\user|null
     */
    public function getuser(): ?\MinichatProjet\Entity\user {
        return $this->user;
    }

    /**
     * @param \MinichatProjet\Entity\user|null $user
     */
    public function setuser(?\MinichatProjet\Entity\user $user): void {
        $this->user = $user;
    }
}
