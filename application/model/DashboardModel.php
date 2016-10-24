<?php


class DashboardModel
{
    public static function listblogs()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT Blog.*, COUNT(Post.id) as posts FROM Blog LEFT JOIN Post ON Post.blog_id = Blog.id WHERE Blog.user_id = :id GROUP BY Blog.id ");
        $query->execute(array(
            ':id' => Session::get('user_id')
        ));

        $listblog = $query->fetchAll();

        return $listblog;
    }

    public static function listmodblogs()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT Blog.*, COUNT(Post.id) as posts FROM Blog_moderator LEFT JOIN Blog ON Blog.id=Blog_moderator.blog_id LEFT JOIN Post ON Post.blog_id = Blog.id WHERE Blog_moderator.user_id = :id GROUP BY Blog.id");
        $query->execute(array(
            ':id' => Session::get('user_id')
        ));

        $listmodblogs = $query->fetchAll();

        return $listmodblogs;
    }

    public static function listAllVisibleBlogs(){
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM Blog WHERE visible = 1");
        $query->execute();
        $listblogs = $query->fetchAll();

        return $listblogs;

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