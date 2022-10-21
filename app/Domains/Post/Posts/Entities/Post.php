<?php


namespace App\Domains\Post\Posts\Entities;



use App\Domains\Post\Comments\Entities\Comment;
use App\Domains\Post\Users\Entities\Interfaces\UserInterface;

class Post
{
    private $id;
    private $title;
    private $description;
    private $content;
    private $user;
    private $comments = [];

    public function __construct($id, string $title, string $description, string $content, UserInterface $user)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->user = $user;
    }

    public function getAPIData(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'author' => $this->user->getName(),
            'comments' => array_map(function (Comment $comment){
                return $comment->getAPIData();
            }, $this->comments)
        ];
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function setComments(array $comments)
    {
        $this->comments = $comments ?: [];
    }
}
