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


}