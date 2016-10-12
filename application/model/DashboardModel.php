<?php


class DashboardModel
{
    public static function listblogs()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM Blog WHERE user_id = :id");
        $query->execute(array(
            ':id' => Session::get('user_id')
        ));

        $listblog = $query->fetchAll();

        return $listblog;
    }

    public static function delete($slug){
        $database = DatabaseFactory::getFactory()->getConnection();

        $q = $database->prepare('DELETE FROM Blog WHERE slug = :slug AND user_id = :user_id');
        $q->execute(array(
            ':slug' => $slug,
            ':user_id' => Session::get('user_id')
        ));
        if($q){
            return true;
        }
        return false;
    }


}