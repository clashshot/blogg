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
            echo '<h1>' . $post->title . '</h1>';
            echo "<p>$post->content</p>";
        }elseif(BlogModel::getpage($blogid, $postslug)){
            $this->View->render('page/index', array(
                'page' => BlogModel::getPage($blogid, $postslug)
            ));
        } else {
            echo '<h1>Did not find post.</h1>';
        }
    }

    public function manage($blogid, $method = 'index', $postslug = ''){
        switch (strtolower($method)){
            case 'index':
                $this->View->render('manage/index', array(
                    'blog' => BlogModel::getBlog($blogid),
                    'posts' => BlogModel::getPosts($blogid, Request::get("page"), 10),
                    'paginate' => new Paginate("Post WHERE blog_id = :blog_id", [':blog_id' => $blogid], 10)
                ));
                break;
            case 'addpost':
                $this->View->render('manage/addpost',array(
                    'blog' => BlogModel::getBlog($blogid)
                ));
                break;
            case 'addpost_action':
                if(BlogModel::addpost($blogid)){
                    Session::add('feedback_positive', 'Inlägg skapades');
                    Redirect::to(BlogModel::getBlog($blogid)->slug.'/manage/index');
                } else {
                    Session::add('feedback_negative', 'Inlägg kunde ej skapas, försök igen.');
                    Redirect::to(BlogModel::getBlog($blogid)->slug.'/manage/addpost');
                }
                break;
            case 'editpost':
                $post = BlogModel::getpost($blogid, $postslug);
                $this->View->render('manage/editpost', array('post' => $post));
                break;
            case 'deletepost':
                if(UserModel::getEditPermission($blogid) >= 3){
                    $post = BlogModel::getpost($blogid, $postslug);
                    //TODO BlogModel::deletepost($blogid, $postslug);
                    echo 'Should have deleted ' . $post->title;
                }else{
                    Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage');
                }
                echo '<br>deletepost<br>';
                break;
            case 'update':
                $this->View->render ('manage/editblog',array(
                    "blog" => BlogModel::getBlog($blogid)
                ));
                break;
            case 'deleteblog':
                if(UserModel::getEditPermission($blogid) >= 4){
                    //TODO BlogModel::deleteblog($blogid);
                }else{
                    Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage');
                }
                echo 'deleteblog';
                break;
            case 'history':
                echo 'history';
                break;
            case 'mods':
                $this->View->render('manage/mods', array(
                    'blog' => BlogModel::getBlog($blogid),
                    'mods' => BlogModel::getMods($blogid)
                ));
                break;
            case 'addmod_action':
                if (BlogModel::addMod($blogid)) {
                    Redirect::to('manage/mods');
                } else {
                    Redirect::to('manage/mods');
                }
                break;
            case 'removemod_action':
                if(BlogModel::removeMod($blogid)){
                    Redirect::to('manage/mods');
                } else {
                    Redirect::to('manage/mods');
                }
                break;
            case 'category':
                echo 'category';
                break;
            default:
                header('HTTP/1.0 404 Not Found', true, 404);
                $this->View->render('error/404');
                break;
        }
    }

    public function comment($blogid){

    }
}
