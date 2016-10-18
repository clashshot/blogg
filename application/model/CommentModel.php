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
            $query = $database->prepare("INSERT INTO `Comment`(`user_id`, `post_id`, `comment_id`, `comment`,user_agent,ip_adress) VALUES (:user_id,:post_id,:comment_id,:comment,:user_agent,:ip_adress)");
            $query->execute(array(
                "user_id" => $user,
                "post_id" => $post_id,
                "comment_id" => $comment_id,
                "comment" => Filter::XSSFilter($comment),
                "user_agent" => $_SERVER['HTTP_USER_AGENT'],
                "ip_adress" => $_SERVER['REMOTE_ADDR']
            ));
        } elseif ($user != -1 && $comment_id === -1) {
            $query = $database->prepare("INSERT INTO `Comment`(`user_id`, `post_id`, `comment`,user_agent,ip_adress) VALUES (:user_id,:post_id,:comment,:user_agent,:ip_adress)");
            $query->execute(array(
                "user_id" => $user,
                "post_id" => $post_id,
                "comment" => Filter::XSSFilter($comment),
                "user_agent" => $_SERVER['HTTP_USER_AGENT'],
                "ip_adress" => $_SERVER['REMOTE_ADDR']
            ));
        } elseif ($user === -1 && $comment_id != -1) {
            $query = $database->prepare("INSERT INTO `Comment`(`post_id`, `comment_id`, `comment`,user_agent,ip_adress) VALUES (:post_id,:comment_id,:comment,:user_agent,:ip_adress)");
            $query->execute(array(
                "post_id" => $post_id,
                "comment_id" => $comment_id,
                "comment" => Filter::XSSFilter($comment),
                "user_agent" => $_SERVER['HTTP_USER_AGENT'],
                "ip_adress" => $_SERVER['REMOTE_ADDR']
            ));
        } elseif ($user === -1 && $comment_id === -1){
            $query = $database->prepare("INSERT INTO `Comment`(`post_id`, `comment`,user_agent,ip_adress) VALUES (:post_id,:comment,:user_agent,:ip_adress)");
            $query->execute(array(
                "post_id" => $post_id,
                "comment" => Filter::XSSFilter($comment),
                "user_agent" => $_SERVER['HTTP_USER_AGENT'],
                "ip_adress" => $_SERVER['REMOTE_ADDR']
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
                $comment->likes = self::getCommentLikes($comment->id);
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
                $comment->likes = self::getCommentLikes($comment->id);
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
        if (!self::likingcomment($comment_id)){
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

    }

    public static function removeCommentlike(){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("DELETE FROM Comment_like WHERE user_id = :user_id AND comment_id = :comment_id");
        return $query->execute(array(
            ':user_id' => Session::get('user_id'),
            ':comment_id' => Request::post('comment_id')
        ));
    }

    public static function getCommentLikes($comment_id){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT COUNT(*) as amount FROM Comment_like WHERE comment_id = :comment");
        $query->execute(array('comment' => $comment_id));
        if ($query->rowCount() > 0)
            return $query->fetchObject()->amount;
        else
            return 0;
    }

    public static function likingcomment($comment_id){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT *FROM Comment_like WHERE comment_id = :comment AND user_id = :user");
        $query->execute(array('comment' => $comment_id, 'user' => Session::get('user_id')));
        if ($query->rowCount() > 0)
            return true;
        else
            return false;
    }
}
