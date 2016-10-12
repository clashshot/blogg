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

    public static function subComment()
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $id = Request::get("id");

        $query = $database->prepare("SELECT `user_id`,`comment` FROM `Comment` WHERE :comment_id = :id");
        $query->execute;
    }

    public static function getComment($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $resultSet = $database->prepare("SELECT * FROM `Comment` where id=$id");

        $row = $resultSet->fetch();
        echo $row[0];
        echo $row[1];
        echo $row[2];
        echo $row[3];
        echo $row[4];
        echo $row[5];
        echo $row[6];
        echo $row[7];

        /*if($resultSet->num_rows > 0) {
            while($rows = $resultSet->fetch_assoc()) {

            }
        } else
            echo "Inga resultat!";*/
    }
}
