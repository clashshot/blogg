<?php

class CategoryModel
{
    public static function showCategory($blogid, $exclude)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = $database->prepare('SELECT * FROM Category WHERE id != :exclude AND blog_id = :blogid');
        $sql->execute(array(
            ':blogid' => $blogid,
            ':exclude' => $exclude
        ));

        return $sql->fetchAll();
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

    public static function getnamebyid($tablename, $columnname, $value){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT * FROM $tablename WHERE $columnname = $value");
        $query->execute();

        return $query->fetchObject();
    }
}
