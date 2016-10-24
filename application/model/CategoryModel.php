<?php

class CategoryModel
{
    public static function showCategory($blogid, $exclude = null)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = 'SELECT * FROM Category WHERE';
        if (isset($exclude)){
            $sql .= ' id != :exclude AND';
        }
        $sql = $database->prepare($sql . ' blog_id = :blogid');
        if (isset($exclude)){
            $sql->execute(array(
                ':blogid' => $blogid,
                ':exclude' => $exclude
            ));
        }else{
            $sql->execute(array(
                ':blogid' => $blogid
            ));
        }

        return $sql->fetchAll();
    }

    public static function showCatexistsinPost($blogid){
        $database = DatabaseFactory::getFactory()->getConnection();
        // Show categories -> if category id exists in post
        $query = $database->prepare('SELECT c.* FROM Category AS c WHERE c.blog_id = :blogid AND EXISTS (SELECT 1 FROM Post AS p WHERE p.category_id = c.id)');
        $query->execute(array(
            ':blogid' => $blogid
        ));
        return $query->fetchAll();
    }

    public static function addCategory($blogid){
        $name = Request::post('name');
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("INSERT INTO Category(blog_id, `name`) VALUES(:blog, :name)");
        return $query->execute(array(
            ':blog' => $blogid,
            ':name' => Filter::XSSFilter($name)
        ));
    }

    public static function removeCategory($blogid){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("DELETE FROM Category WHERE id = :id AND blog_id = :blog");
        return $query->execute(array(
            ':id' => Request::post('category'),
            ':blog' => $blogid
        ));
    }

    public static function editCategory($blogid){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("UPDATE Category SET name = :cate WHERE id = :id AND blog_id = :blog");
        return $query->execute(array(
            ':cate' => Request::post('new_category'),
            ':id' => Request::post('category'),
            ':blog' => $blogid
        ));
    }

    public static function getnamebyid($tablename, $columnname, $value){
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM $tablename WHERE $columnname = '$value'");
        $query->execute();

        return $query->fetchObject();
    }

    public static function catpage($blogid, $catslug){
        $database = DatabaseFactory::getFactory()->getConnection();

        $catid = $database->prepare("SELECT id FROM Category WHERE slug = :catslug");
        $catid->execute(array(':catslug'=>$catslug));
        $cat = $catid->fetchObject();

        $query = $database->prepare("SELECT * FROM Post WHERE blog_id = :blogid AND category_id = :catid");
        $query->execute(array(
            ':blogid' => $blogid,
            ':catid' => $cat->id
        ));
        $postarray = array();
        while ($post = $query->fetchObject()) {
            $post->comments = CommentModel::getCommentAmount($post->id);
            $post->likes = BlogModel::getPostLikes($post->id);
            $postarray[] = $post;
        }
        return $postarray;
    }

}
