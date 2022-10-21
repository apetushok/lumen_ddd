<?php


namespace App\Domains\Post\Comments\Repositories\Factories;


use Illuminate\Support\Collection;

class CommentCollectionFactory
{
    public static function create(Collection $comments): array
    {
        $result = [];
        foreach ($comments as $comment){
            $result[] = CommentFactory::create($comment);
        }
        return $result;
    }
}
