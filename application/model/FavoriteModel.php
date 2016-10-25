<?php


class FavoriteModel
{
    public static function addfavorite()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("INSERT INTO Favorite(user_id, post_id) VALUES (:id, :postid)");
        return $query->execute(array(
            ':id' => Session::get('user_id'),
            ':postid' => Request::post('postid')
        ));
    }

    public static function removefavorite()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("DELETE FROM Favorite WHERE user_id = :id AND post_id = :postid");
        return $query->execute(array(
            ':id' => Session::get('user_id'),
            ':postid' => Request::post('postid')
        ));
    }
    public static function favoritelist($page = 0, $post_per_page = 10){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT * FROM Favorite LEFT JOIN Post ON Favorite.post_id = Post.id WHERE Favorite.user_id = :userid LIMIT " . ($page * $post_per_page) . "," . $post_per_page);
        $query->execute(array(
            ':userid' => Session::get('user_id')
        ));
        if ($query->rowCount() > 0){
            $posts = array();
            while($post = $query->fetchObject()){
                $post->comments = CommentModel::getCommentAmount($post->id);
                $post->likes = BlogModel::getPostLikes($post->id);
                $posts[] = $post;
            }
            return $posts;
        }
    }
    //kollar om du har favoritmarkerat
    public static function checkfavorite ($post_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM Favorite WHERE post_id = :postid AND user_id = :userid");
        $query->execute(array(
            ':postid' => $post_id,
            ':userid' => Session::get('user_id')
        ));
        if($query->rowCount() > 0){
            return true;
        }
        else {
            return false;
        }

    }
}