<?php

class Posts
{
    public object $model;

    public function __construct()
    {
        $database = new Db();
        $this->model = $database->getInstance();
    }

    public function getPosts()
    {
        $sql = "SELECT * FROM posts";

        return $this->model->get($sql);
    }

    public function getComments()
    {
        $sql = "SELECT * FROM comments";

        return $this->model->get($sql);
    }

    public function insertPost(array $post)
    {
        $title = $post['title'];
        $txt = $post['text'];
        $sql = "INSERT INTO `posts` (`title`, `text`) VALUES ('$title', '$txt')";

        return $this->model->send($sql);
    }

    public function getRate($id)
    {
        $sql = "SELECT rate FROM posts WHERE (`idposts` = '$id')";
        return $this->model->get($sql);
    }

    public function getRating()
    {
        $sql = "SELECT rate FROM posts";

        return $this->model->get($sql);
    }

    public function insertRate(array $rating)
    {
        $id = $rating['postId'];
        $rate = $rating['starValue'];

        $currentRate = $this->getRate($id);
        $refreshRate = ($currentRate[0]['rate'] + $rate) / 2;
        $sql = "UPDATE `posts` SET `rate` = '$refreshRate' WHERE (`idposts` = '$id')";

        return $this->model->send($sql);
    }

    public function insertComment(array $comment)
    {
        $id = (int)$comment['id'];
        $user = $comment['name'];
        $txt = $comment['text'];
        $sql = "INSERT INTO `comments` (`user_name`, `comment`, `id_post`) VALUES ('$user', '$txt', '$id')";

        return $this->model->send($sql);
    }
}