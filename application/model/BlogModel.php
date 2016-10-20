<?php


class BlogModel
{

    public static function blogexists($slug)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $blog = $database->prepare('SELECT * FROM Blog WHERE slug = :slug');
        $blog->execute(array(
            ':slug' => $slug
        ));
        $blogr = $blog->fetchObject();
        if ($blog->rowCount() > 0) {
            return $blogr->id;
        } else {
            return false;
        }
    }

    public static function getBlog($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $blog = $database->prepare('SELECT * FROM Blog WHERE id = :id');
        $blog->execute(array(
            ':id' => $id
        ));
        $blogr = $blog->fetchObject();
        if ($blog->rowCount() > 0) {
            return $blogr;
        }
    }

    public static function getpost($blogid, $postslug)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $post = $database->prepare('SELECT * FROM Post WHERE slug = :slug AND blog_id = :blog');
        $post->execute(array(
            ':slug' => $postslug,
            ':blog' => $blogid
        ));
        if ($post->rowCount() > 0) {
            $postrow = $post->fetchObject();
            $postrow->likes = self::getPostLikes($postrow->id);
            return $postrow;
        } else {
            return false;
        }
    }

    public static function getpostbyid($postid)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $post = $database->prepare('SELECT * FROM Post WHERE id = :id');
        $post->execute(array(
            ':id' => $postid
        ));
        if ($post->rowCount() > 0) {
            return $post->fetchObject();
        } else {
            return false;
        }
    }

    public static function getPosts($blogid, $page = 0, $posts_per_page = 5)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $posts = $database->prepare('SELECT *FROM Post WHERE blog_id = :blog_id AND visibility <= :permission ORDER BY created DESC LIMIT ' . ($page * $posts_per_page) . ', ' . $posts_per_page);
        $posts->execute(array(':blog_id' => $blogid, ':permission' => UserModel::getPermission($blogid)));
        if ($posts->rowCount() > 0) {
            $postarray = array();
            while ($post = $posts->fetchObject()) {
                $post->comments = CommentModel::getCommentAmount($post->id);
                $post->likes = self::getPostLikes($post->id);
                $postarray[] = $post;
            }
            return $postarray;
        } else {
            return false;
        }
    }

    public static function addpost($blogid)
    {
        $title = Request::post('title');
        $category = Request::post('category');
        $visibility = Request::post('visibility');
        $comment = Request::post('comment');
        $content = Request::post('content');
        $titleslug = self::slugify($title);
        $database = DatabaseFactory::getFactory()->getConnection();
        try {
            $add = $database->prepare('INSERT INTO Post (blog_id, category_id, user_id, slug, title, content, visibility, created, allow_comments)
            VALUES (:blog_id, :category_id, :user_id, :slug, :title, :content, :visibility, :created, :allow_comments)');
            $add->execute(array(
                ':blog_id' => $blogid,
                ':category_id' => $category,
                ':user_id' => Session::get('user_id'),
                ':slug' => $titleslug,
                ':title' => Filter::XSSFilter($title),
                ':content' => Filter::XSSFilter($content),
                ':visibility' => $visibility,
                ':created' => date('Y-m-d H:i:s'),
                ':allow_comments' => $comment
            ));
            if ($add) {
                return true;
            }
        } catch (PDOException $e) {
            echo $e;
            return false;
        }

    }

    public static function blog_create()
    {
        $title = Request::post('title');
        $description = Request::post('description');
        $about = Request::post('about');
        $visibility = Request::post('visibility');
        $facebook = null;
        $twitter = null;
        $google = null;
        if (strlen(Request::post('facebook')) > 10) {
            $facebook = Request::post('facebook');
        }
        if (strlen(Request::post('twitter')) > 10) {
            $twitter = Request::post('twitter');
        }
        if (strlen(Request::post('google')) > 10) {
            $google = Request::post('google');
        }
        $blogname = self::slugify($title);

        $database = DatabaseFactory::getFactory()->getConnection();

        $blog = $database->prepare('INSERT INTO Blog (user_id, slug, title, description, about, visible, facebook, twitter, google_plus) VALUES(:user_id, :slug, :title, :description, :about, :visible, :facebook, :twitter, :google)');
        $success = $blog->execute(array(
            ':user_id' => Session::get("user_id"),
            ':slug' => $blogname,
            ':title' => Filter::XSSFilter($title),
            ':description' => Filter::XSSFilter($description),
            ':about' => $about,
            ':visible' => $visibility,
            'facebook' => Filter::XSSFilter($facebook),
            'twitter' => Filter::XSSFilter($twitter),
            'google' => Filter::XSSFilter($google)
        ));
        if ($success) {
            return self::getBlog($database->lastInsertId());
        } else {
            return false;
        }
    }

    public static function blog_update($blogid)
    {
        $title = Request::post('title');
        $description = Request::post('description');
        $about = Request::post('about');
        $facebook = null;
        $twitter = null;
        $google = null;
        if (strlen(Request::post('facebook')) > 10) {
            $facebook = Request::post('facebook');
        }
        if (strlen(Request::post('twitter')) > 10) {
            $twitter = Request::post('twitter');
        }
        if (strlen(Request::post('google')) > 10) {
            $google = Request::post('google');
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $blog = $database->prepare('UPDATE Blog SET title = :title, description = :description, about = :about, facebook = :facebook, twitter = :twitter, google_plus = :google WHERE id = :blog');
        $success = $blog->execute(array(
            ':title' => Filter::XSSFilter($title),
            ':description' => Filter::XSSFilter($description),
            ':about' => $about,
            'facebook' => Filter::XSSFilter($facebook),
            'twitter' => Filter::XSSFilter($twitter),
            'google' => Filter::XSSFilter($google),
            'blog' => $blogid
        ));
        if ($success) {
            return self::getBlog($database->lastInsertId());
        } else {
            return false;
        }
    }

    public static function slugify($blogname)
    {
        $blogname = str_replace(array('å', 'ä', 'ö'), array('a', 'a', 'o'), $blogname);

        // replace non letter or digits by -
        $blogname = preg_replace('~[^\pL\d]+~u', '-', $blogname);

        // transliterate
        $blogname = iconv('utf-8', 'us-ascii//TRANSLIT', $blogname);

        // remove unwanted characters
        $blogname = preg_replace('~[^-\w]+~', '', $blogname);

        // trim
        $blogname = trim($blogname, '-');

        // remove duplicate -
        $blogname = preg_replace('~-+~', '-', $blogname);

        // lowercase
        $blogname = strtolower($blogname);

        if (Blacklist::contains($blogname)) {
            return 'n-a';
        }

        if (empty($blogname)) {
            return 'n-a';
        }

        return $blogname;
    }

    public static function addMod($blog_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $user = strip_tags(Request::post('user_identity'));

        $query = $database->prepare("SELECT user_id FROM users WHERE user_email = :email");
        $query->execute(array(':email' => $user));
        if($query->rowCount()>=1){
            $user_id = $query->fetchobject()->user_id;
        }else{
            $query = $database->prepare("SELECT user_id FROM users WHERE user_name = :user_name");
            $query->execute(array(':user_name' => $user));
            $user_id = $query->fetchobject()->user_id;
        }


        $query = $database->prepare("SELECT * FROM Blog_moderator WHERE user_id = :user_id AND blog_id = :blog_id");
        $query->execute(array(':user_id' => $user_id, 'blog_id' => $blog_id));
        if (!$query->rowCount() >= 1 and Session::get("user_id")!=$user_id){
            $query = $database->prepare("INSERT INTO Blog_moderator (user_id,blog_id) VALUES (:user_id,:blog_id)");

            if ($query->execute(array(':user_id' => $user_id, 'blog_id' => $blog_id))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function removeMod($blog_id){
        $database = DatabaseFactory::getFactory()->getConnection();

        $user_id = strip_tags(Request::post('user_id'));
        /*
        $query = $database->prepare("SELECT user_id FROM users WHERE user_email = :email");
        $query->execute(array(':email' => $user_email));
        $user_id = $query->fetchobject()->user_id;
        */
        $query = $database->prepare("DELETE FROM Blog_moderator WHERE user_id = :user_id AND blog_id = :blog_id");

        if ($query->execute(array(':user_id' => $user_id, 'blog_id' => $blog_id))) {
            return true;
        } else {
            return false;
        }
    }

    public static function getMods($blog_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT user_email FROM Blog_moderator LEFT JOIN users on users.user_id=Blog_moderator.user_id WHERE blog_id = :blog_id");

        $query = $database->prepare("SELECT users.user_id, users.user_email FROM Blog_moderator  LEFT JOIN users on users.user_id=Blog_moderator.user_id WHERE blog_id = :blog_id");

        $query->execute(array(':blog_id' => $blog_id));

        $mods = array();

        $modNumber = $query->rowCount();

        for ($i = 0; $i < $modNumber; $i++) {
            $modObj = $query->fetchobject();
            array_push($mods, $modObj);
        }

        return $mods;
    }

    public static function completedRemoveMod($blog_id, $user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $mod = $database->prepare("DELETE FROM blog_moderator WHERE user_id = :user_id AND blog_id = :blog_id");
        return $mod->execute(array('blog_id' => $blog_id, 'user_id' => $user_id));
    }

    public static function addPage($blogid){
        $title = Request::post('title');
        $content = Request::post('content');
        $titleslug = self::slugify($title);
        $database = DatabaseFactory::getFactory()->getConnection();
        try {
            $add = $database->prepare("INSERT INTO Pages(user_id,blog_id,title,slug,content,created) 
            VALUES (:user_id,:blog_id,:title,:slug,:content,:created)");
            $add->execute(array(
                ':blog_id' => $blogid,
                ':user_id' => Session::get('user_id'),
                ':slug' => $titleslug,
                ':title' => Filter::XSSFilter($title),
                ':content' => $content,
                ':created' => date('Y-m-d H:i:s'),
            ));
            if($add){
                return true;
            }
        } catch (PDOException $e){
            echo $e;
            return false;
        }

    }

    public static function getPage($blogid, $pageslug){
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = $database->prepare('SELECT * FROM Pages WHERE slug = :slug AND blog_id = :blog_id');
        $sql->execute(array(
            ':slug' => $pageslug,
            ':blog_id' => $blogid
        ));

        return $sql->fetchObject();
    }

    public static function showPages($blogid)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = $database->prepare('SELECT * FROM Pages WHERE blog_id = :blog_id LIMIT 5');
        $sql->execute(array(
            ':blog_id' => $blogid
        ));

        return $sql->fetchAll();
    }

    public static function editPages($blogid, $postslug){
        $title = Request::post('title');
        $content = Request::post('content');

        if(empty($title) && empty($content)){
            return false;
        }
        $database = DatabaseFactory::getFactory()->getConnection();
        $edit = $database->prepare("
          UPDATE Pages SET title = :title, content = :content, updated = :updated WHERE blog_id = :blog_id AND slug = :slug");

        $edit->execute(array(
            ':title' => $title,
            ':content' => $content,
            ':updated' => date('Y-m-d H:i:s'),
            ':blog_id' => $blogid,
            ':slug' => $postslug
        ));
        if($edit){
            return true;
        }

        return false;
    }

    public static function getCategory($id){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT * FROM Category WHERE id = :id");
        $query->execute(array(':id' => $id));
        if ($query->rowCount() == 1) {
            return $query->fetchObject()->name;
        } else {
            return "Ingen kategori";
        }
    }

    public static function Category($blogid)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = $database->prepare('SELECT * FROM Category WHERE blog_id = :blog_id');
        $sql->execute(array(
            ':blog_id' => $blogid
        ));

        return $sql->fetchAll();
    }

    public static function addPostlike()
    {
        $post_id = Request::post('post_id');
        $database = DatabaseFactory::getFactory()->getConnection();
        if (!self::likingpost($post_id)) {
            try {
                $add = $database->prepare('INSERT INTO Post_like (user_id, post_id) VALUES (:user_id, :post_id)');
                return $add->execute(array(
                    ':user_id' => Session::get('user_id'),
                    ':post_id' => $post_id
                ));
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }
    }

    public static function removePostlike()
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("DELETE FROM Post_like WHERE user_id = :user_id AND post_id = :post_id");
        return $query->execute(array(
            ':user_id' => Session::get('user_id'),
            ':post_id' => Request::post('post_id')
        ));
    }

    public static function getPostLikes($post_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT COUNT(*) as amount FROM Post_like WHERE post_id = :post");
        $query->execute(array('post' => $post_id));
        if ($query->rowCount() > 0)
            return $query->fetchObject()->amount;
        else
            return 0;
    }

    public static function deletepost($blogid, $postslug)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("DELETE FROM Post WHERE blog_id = :blog AND slug = :slug");
        return $query->execute(array(':blog' => $blogid, ':slug' => $postslug));
    }

    public static function switchVisible()
    {
        $blog = Request::post('blog_id');
        $visiblity = Request::post('visible');

        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("UPDATE Blog SET visible = :visible WHERE id = :blog");
        $query->execute(array(':blog' => $blog, ':visible' => $visiblity));
        return BlogModel::getBlog($blog)->visible;
    }

    public static function likingpost($post)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT *FROM Post_like WHERE user_id = :user AND post_id = :post");
        $query->execute(array(':user' => Session::get('user_id'), ':post' => $post));
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function editpost($blogid, $postslug)
    {
        $category = Request::post('category');
        $title = Request::post('title');
        $content = Request::post('content');
        $visibility = Request::post('visibility');
        $allowcomments = Request::post('comment');

        if (empty($category) && empty($title) && empty($content) && empty($visibility) && empty($allowcomments)) {
            return false;
        }

        if (self::createposthistory($blogid, $postslug)) {
            $database = DatabaseFactory::getFactory()->getConnection();
            $edit = $database->prepare("UPDATE Post SET category_id = :category_id, title = :title, content = :content, visibility = :visibility, allow_comments = :allow_comments, updated = :updated WHERE blog_id = :blog_id AND slug = :slug");

            $edit->execute(array(
                ':category_id' => $category,
                ':title' => $title,
                ':content' => $content,
                ':visibility' => $visibility,
                ':allow_comments' => $allowcomments,
                ':updated' => date('Y-m-d H:i:s'),
                ':blog_id' => $blogid,
                ':slug' => $postslug
            ));
            if ($edit) {
                return true;
            }

        }
        return false;
    }

    public static function createposthistory($blogid, $postslug)
    {

        $database = DatabaseFactory::getFactory()->getConnection();

        $get = $database->prepare('SELECT * FROM Post WHERE blog_id = :blogid AND slug = :postslug');
        $get->execute(array(
            ':blogid' => $blogid,
            ':postslug' => $postslug
        ));
        $getr = $get->fetchObject();

        $insert = $database->prepare('INSERT INTO Post_history(post_id, title, content, created) VALUES (:post_id, :title, :content, :created)');
        $insert->execute(array(
            ':post_id' => $getr->id,
            ':title' => $getr->title,
            ':content' => $getr->content,
            ':created' => date('Y-m-d H:i:s')
        ));
        if ($insert) {
            return true;
        }
        return false;
    }

    public static function getposthistory($post_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $get = $database->prepare('SELECT * FROM Post_history WHERE post_id = :post_id');
        $get->execute(array(
            ':post_id' => $post_id
        ));
        return $getr = $get->fetchAll();
    }

    public static function getposthistoryrow($history_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $get = $database->prepare('SELECT * FROM Post_history WHERE id = :history_id LIMIT 1');
        $get->execute(array(
            ':history_id' => $history_id
        ));
        return $get->fetchObject();
    }

}
