<?php


namespace App\Domains\Post\Posts\DTOs;


class PostDTO
{
    public $title;
    public $description;
    public $content;
    public $userId;

    public static function fromArray(array $data): PostDTO
    {
        $self = new self();

        $self->title = $data['title'];
        $self->description = $data['description'];
        $self->content = $data['content'];
        $self->userId = $data['user_id'];

        return $self;
    }

}
