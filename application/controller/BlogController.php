<?php

class BlogController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        $name = Request::get('name');
        echo $name;
    }

    /**
     * Handles what happens when user moves to URL/index/index - or - as this is the default controller, also
     * when user moves to /index or enter your application at base level
     */
    public function index($blogid){
        $this->View->render('blog/index', array(
            'blog' => BlogModel::getBlog($blogid),
            'posts' => BlogModel::getPosts($blogid, Request::get('page')),
            'paginate' => new Paginate("Post WHERE blog_id = :blog_id", [':blog_id' => $blogid], 5)
        ));
    }

    public function post($blogid, $postslug){
        if($post = BlogModel::getpost($blogid, $postslug)){
<<<<<<< HEAD
            $this->View->render('blog/post',array(
                'blog' => BlogModel::getBlog($blogid),
                'post' => $post,
                'comments' => CommentModel::getComments($post->id)
            ));
        }else{
            echo '<h1>Post not found!</h1>';
=======
            echo '<h1>' . $post->title . '</h1>';
            echo "<p>$post->content</p>";
        }elseif(BlogModel::getpage($blogid, $postslug)){
            $this->View->render('page/index', array(
                'page' => BlogModel::getPage($blogid, $postslug)
            ));
        } else {
            echo '<h1>Did not find post.</h1>';
>>>>>>> origin/master
        }
    }

    public function manage($blogid, $method = 'index', $postslug = ''){
        switch (strtolower($method)){
            // Shows posts
            case 'index':
                $this->View->render('manage/index', array(
                    'blog' => BlogModel::getBlog($blogid),
                    'posts' => BlogModel::getPosts($blogid, Request::get("page"), 10),
                    'paginate' => new Paginate("Post WHERE blog_id = :blog_id", [':blog_id' => $blogid], 10)
                ));
                break;
            // Render view for add post
            case 'addpost':
                $this->View->render('manage/addpost',array(
                    'blog' => BlogModel::getBlog($blogid)
                ));
                break;
            // Add post
            case 'addpost_action':
                if(BlogModel::addpost($blogid)){
                    Session::add('feedback_positive', 'Inlägg skapades');
                    Redirect::to(BlogModel::getBlog($blogid)->slug.'/manage/index');
                } else {
                    Session::add('feedback_negative', 'Inlägg kunde ej skapas, försök igen.');
                    Redirect::to(BlogModel::getBlog($blogid)->slug.'/manage/addpost');
                }
                break;
            // Render view for edit post
            case 'editpost':
                $post = BlogModel::getpost($blogid, $postslug);
                $this->View->render('manage/editpost', array('post' => $post));
                break;
            // Render view for edit blog
            case 'editblog':
                $this->View->render ('manage/editblog',array(
                    "blog" => BlogModel::getBlog($blogid)
                ));
                break;
            // Render view for history
            case 'history':
                echo 'history';
                break;
            // Render view for blog moderators
            case 'mods':
                $this->View->render('manage/mods', array(
                    'blog' => BlogModel::getBlog($blogid),
                    'mods' => BlogModel::getMods($blogid)
                ));
                break;
            // Add moderator a blog
            case 'addmod_action':
                if (BlogModel::addMod($blogid)) {
                    Redirect::to(BlogModel::getBlog($blogid)->slug.'/manage/mods');
                } else {
                    Redirect::to(BlogModel::getBlog($blogid)->slug.'/manage/mods');
                }
                break;
            // Remove moderator from a blog
            case 'removemod_action':
                /*
                if(BlogModel::removeMod($blogid)){
                    Redirect::to('manage/mods');
                } else {
                    Redirect::to('manage/mods');
                }
                */
                $this->View->renderJSON(BlogModel::completedRemoveMod($data));
                break;
            // Render view for category
            case 'category':
                    $this->View->render('manage/category', array(
                        'blog' => BlogModel::getBlog($blogid),
                        'category' => CategoryModel::showCategory($blogid),
                        'paginate' => new Paginate("Category WHERE blog_id = :blog_id", [':blog_id' => $blogid], 10)
                    ));
                break;
            // Add category
            case 'addcategory':

                break;
            // If nothing is requested, this is default 404 error view
            default:
                header('HTTP/1.0 404 Not Found', true, 404);
                $this->View->render('error/404');
                break;
        }
    }
    public function removeMod($blog_id){

        $this->View->renderJSON(BlogModel::removeMod($blog_id));

    }
    
    public function ajaxcheck($action = 'index', $value = null){
        switch ($action){
            case 'blog_slug':
                $baseSlug = BlogModel::slugify($value);
                $slug = $baseSlug;
                for ($i = 0; $i < 5; $i++){
                    if(!BlogModel::blogexists($slug)){
                        echo $slug;
                        break;
                    }
                    $slug = $baseSlug . '-' . $this->generateRandomString(6);
                }
                if (BlogModel::blogexists($slug)){
                    echo "Kunde inte skapa en unik slug";
                }
                break;
            default:
                header('HTTP/1.0 404 Not Found', true, 404);
                $this->View->render('error/404');
                break;
        }
    }

    public function comment($post_id){
        $comment = CommentModel::getComments($post_id);
        print_r($comment);
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
