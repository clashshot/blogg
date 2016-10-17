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
            $comment_id = Request::post("comment_id");
        }
        if ($user != -1 && $comment_id != -1) {
            $query = $database->prepare("INSERT INTO `Comment`(`user_id`, `post_id`, `comment_id`, `comment`) VALUES (:user_id,:post_id,:comment_id,:comment)");
            $query->execute(array(
                "user_id" => $user,
                "post_id" => $post_id,
                "comment_id" => $comment_id,
                "comment" => Filter::XSSFilter($comment)
            ));
        } elseif ($user != -1 && $comment_id === -1) {
            $query = $database->prepare("INSERT INTO `Comment`(`user_id`, `post_id`, `comment`) VALUES (:user_id,:post_id,:comment)");
            $query->execute(array(
                "user_id" => $user,
                "post_id" => $post_id,
                "comment" => Filter::XSSFilter($comment)
            ));
        } elseif ($user === -1 && $comment_id != -1) {
            $query = $database->prepare("INSERT INTO `Comment`(`post_id`, `comment_id`, `comment`) VALUES (:post_id,:comment_id,:comment)");
            $query->execute(array(
                "post_id" => $post_id,
                "comment_id" => $comment_id,
                "comment" => Filter::XSSFilter($comment)
            ));
        } elseif ($user === -1 && $comment_id === -1){
            $query = $database->prepare("INSERT INTO `Comment`(`post_id`, `comment`) VALUES (:post_id,:comment)");
            $query->execute(array(
                "post_id" => $post_id,
                "comment" => Filter::XSSFilter($comment)
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

    public static function addCommentlike(){
        $comment_id = Request::post('comment_id');
        $database = DatabaseFactory::getFactory()->getConnection();
        try{
            $add = $database->prepare('INSERT INTO Comment_like (user_id, comment_id) VALUES (:user_id, :comment_id)');
            return $add->execute(array(
                ':user_id' => Session::get('user_id'),
                ':comment_id' => $comment_id
            ));
        }catch (PDOException $e){
            echo $e;
            return false;
        }

    }

    public static function removeCommentlike(){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("DELETE FROM Comment_like WHERE user_id = :user_id AND comment_id = :comment_id");
        return $query->execute(array(
            ':user_id' => Session::get('user_id'),
            ':comment_id' => Request::post('comment_id')
        ));
    }

    public static function getPostLikes($comment_id){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT COUNT(*) as amount FROM Comment_like WHERE comment_id = :comment");
        $query->execute(array('comment' => $comment_id));
        if ($query->rowCount() > 0)
            return $query->fetchObject()->amount;
        else
            return 0;
    }
}
