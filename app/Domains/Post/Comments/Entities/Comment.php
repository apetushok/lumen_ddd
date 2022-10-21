<?php


namespace App\Domains\Post\Comments\Entities;



use App\Domains\Post\Users\Entities\Interfaces\UserInterface;

class Comment
{
    private $id;
    private $text;
    private $user;

    public function __construct($id, string $text, UserInterface $user)
    {
        $this->id = $id;
        $this->text = $text;
        $this->user = $user;
    }

    public function getAPIData(): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'author' => $this->user->getName(),
        ];
    }
}
