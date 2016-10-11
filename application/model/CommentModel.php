<?php

class CommentModel
{
    public static function postComment($post_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $comment = Request::post("comment");
        $user = -1;
        $comment_id = -1;
        if (Session::userIsLoggedIn()) {
            $user = Session::get("user_id");
        }
        if (isset($_POST['comment_id'])) {
            $comment_id = Request::get("comment_id");
        }
        if ($user != -1 && $comment_id != -1) {
            $query = $database->prepare("INSERT INTO `Comment`(`user_id`, `post_id`, `comment_id`, `comment`) VALUES (:user_id,:post_id,:comment_id,:comment)");
            $query->execute(array(
                "user_id" => $user,
                "post_id" => $post_id,
                "comment_id" => $comment_id,
                "comment" => $comment
            ));
        } elseif ($user != -1 && $comment_id === -1) {
            $query = $database->prepare("INSERT INTO `Comment`(`user_id`, `post_id`, `comment`) VALUES (:user_id,:post_id,:comment)");
            $query->execute(array(
                "user_id" => $user,
                "post_id" => $post_id,
                "comment" => $comment
            ));
        } elseif ($user === -1 && $comment_id != -1) {
            $query = $database->prepare("INSERT INTO `Comment`(`post_id`, `comment_id`, `comment`) VALUES (:post_id,:comment_id,:comment)");
            $query->execute(array(
                "post_id" => $post_id,
                "comment_id" => $comment_id,
                "comment" => $comment
            ));
        } elseif ($user === -1 && $comment_id === -1){
            $query = $database->prepare("INSERT INTO `Comment`(`post_id`, `comment`) VALUES (:post_id,:comment)");
            $query->execute(array(
                "post_id" => $post_id,
                "comment" => $comment
            ));
        }
    }

    public static function subComment($post_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();


    }
}
