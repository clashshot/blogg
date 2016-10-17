<?php

class CategoryModel
{
    public static function showCategory($blogid)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = $database->prepare('SELECT id, blog_id, name FROM Category WHERE blog_id = :blogid');
        $sql->execute(array(
            ':blogid' => $blogid
        ));

        return $sql->fetchAll();
    }

    public static function addCategory($blogid){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("INSERT INTO Category(blog_id, `name`) VALUES(:blog, :name)");
        return $query->execute(array(
            ':blog' => $blogid,
            ':name' => Filter::XSSFilter(Request::post('name'))
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
}
