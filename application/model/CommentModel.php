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

    public static function subComment($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM `Comment` LEFT JOIN users ON Comment.user_id = users.user_id WHERE comment_id = :id");
        $query->execute(array(
            ":id" => $id
        ));

        if($query->rowCount() > 0){
            $comments = array();
            while($comment = $query->fetchObject()){
                $comment->subComments = self::subComment($comment->id);
                $comments[] = $comment;
            }
            return $comments;
        }
    }

    public static function getComments($post_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT * FROM `Comment` LEFT JOIN users ON Comment.user_id = users.user_id WHERE post_id = :post AND comment_id IS NULL");
        $query->execute(array(
            ":post" => $post_id
        ));

        if($query->rowCount() > 0){
            $comments = array();
            while($comment = $query->fetchObject()){
                $comment->subComments = self::subComment($comment->id);
                $comments[] = $comment;
            }
            return $comments;
        }
    }

    public static function getCommentAmount($post_id){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT COUNT(*) as amount FROM `Comment` WHERE post_id = :post");
        $query->execute(array(
            ":post" => $post_id
        ));

        if($query->rowCount() > 0){
            return $query->fetchObject()->amount;
        }else{
            return 0;
        }
    }
}
