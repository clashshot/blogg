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

}
