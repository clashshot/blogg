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
    public function index($blogid, $catslug = '')
    {
    $blog = BlogModel::getBlog($blogid);
        $this->View->render('blog/index', array(
            'blog' => $blog,
            'user' => UserModel::getPublicProfileOfUser($blog->user_id),
            'posts' => BlogModel::getPosts($blogid, Request::get('page')),
            'category' => CategoryModel::showCatexistsinPost($blogid),
            'catslug' => $catslug,
            'paginate' => new Paginate("Post WHERE blog_id = :blog_id AND visibility <= :permission", [':blog_id' => $blogid, ':permission' => UserModel::getPermission($blogid)], 5)
        ));
    }

    public function post($blogid, $postslug)
    {
        if (BlogModel::getBlog($blogid)->visible != 0 || UserModel::getExtendedPermission($blogid)) {
            if ($post = BlogModel::getpost($blogid, $postslug)) {
                if (UserModel::getPermission($blogid) >= $post->visibility) {
                    $blog = BlogModel::getBlog($blogid);
                    $this->View->render('blog/post', array(
                        'blog' => $blog,
                        'post' => $post,
                        'user' => UserModel::getPublicProfileOfUser($blog->user_id),
                        'comments' => CommentModel::getComments($post->id, Request::get('page')),
                        'category' => CategoryModel::showCatexistsinPost($blogid),
                        'catslug' => $postslug,
                        'paginate' => new Paginate("Comment WHERE post_id = :post AND comment_id IS NULL", array('post' => $post->id))
                    ));
                } else {
                    Redirect::to(BlogModel::getBlog($blogid)->slug);
                }
            } elseif (BlogModel::getpage($blogid, $postslug)) {
                $blog = BlogModel::getBlog($blogid);
                $this->View->render('blog/page',array(
                    'blog' => $blog,
                    'user' => UserModel::getPublicProfileOfUser($blog->user_id),
                    'category' => CategoryModel::showCatexistsinPost($blogid),
                    'catslug' => $postslug,
                    'page' => BlogModel::getPage($blogid, $postslug)
                ));
            }else{
                Redirect::to(BlogModel::getBlog($blogid)->slug);
            }
        } elseif (BlogModel::getpage($blogid, $postslug)) {
            $blog = BlogModel::getBlog($blogid);
            $this->View->render('blog/page', array(
                'blog' => $blog,
                'user' => UserModel::getPublicProfileOfUser($blog->user_id),
                'page' => BlogModel::getPage($blogid, $postslug)
            ));
        } else {
            echo '<h1>Did not find post.</h1>';
        }
    }

    public function category($blogid, $catslug){
            $blog = BlogModel::getBlog($blogid);
            $catpage = CategoryModel::catpage($blogid, $catslug, Request::get('page'));
            $catid = CategoryModel::getnamebyid('Category', 'slug', $catslug)->id;
            if(!empty($catpage)){
                $this->View->render('blog/index', array(
                    'blog' => BlogModel::getBlog($blogid),
                    'user' => UserModel::getPublicProfileOfUser($blog->user_id),
                    'posts' => $catpage,
                    'category' => CategoryModel::showCatexistsinPost($blogid),
                    'catslug' => $catslug,
                    'paginate' => new Paginate("Post WHERE blog_id = :blog_id AND category_id = :catid AND visibility <= :permission", [':blog_id' => $blogid, ':catid' => $catid, ':permission' => UserModel::getPermission($blogid)], 5)
                ));
            } else {
                Redirect::to(BlogModel::getBlog($blogid)->slug);
            }
    }

    public function manage($blogid, $method = 'index', $postslug = '')
    {
        if (UserModel::getEditPermission($blogid)) {
            switch (strtolower($method)) {
                case 'index':
                    $this->View->render('manage/index', array(
                        'blog' => BlogModel::getBlog($blogid),
                        'posts' => BlogModel::getPosts($blogid, Request::get("page"), 10),
                        'paginate' => new Paginate("Post WHERE blog_id = :blog_id", [':blog_id' => $blogid], 10)
                    ));
                    break;
                case 'addpost':
                    $this->View->render('manage/addpost', array(
                        'blog' => BlogModel::getBlog($blogid),
                        'category' => CategoryModel::showCategory($blogid, null, null, -1)
                    ));
                    break;
                case 'addpost_action':
                    if (BlogModel::addpost($blogid)) {
                        Session::add('feedback_positive', 'Inlägg skapades');
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/index');
                    } else {
                        Session::add('feedback_negative', 'Inlägg kunde ej skapas, försök igen.');
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/addpost');
                    }
                    break;
                case 'editpost':
                    $post = BlogModel::getpost($blogid, $postslug);
                    $excludecat = $post->category_id;
                    $category = CategoryModel::showCategory($blogid, $excludecat, null, -1);

                    $this->View->render('manage/editpost', array(
                        'blog' => BlogModel::getBlog($blogid),
                        'post' => $post,
                        'category' => $category,
                        'posthistory' => BlogModel::getposthistory($post->id)
                    ));
                    break;
                case 'editpost_action':
                    $editpost = BlogModel::editpost($blogid, $postslug);
                    if($editpost){
                        Session::add('feedback_positive', 'Ditt inlägg har uppdaterats.');
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/index');
                    } else {
                        Session::add('feedback_negative', 'Ditt inlägg kunde ej uppdatera.');
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/editpost/'.$postslug);
                    }
                    break;
                case 'deletepost':
                    if (UserModel::getEditPermission($blogid)) {
                        BlogModel::deletepost($blogid, $postslug);
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage');
                    } else {
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage');
                    }
                    break;
                case 'update':
                    $this->View->render('manage/editblog', array(
                        "blog" => BlogModel::getBlog($blogid),
                        'social_pages' => BlogModel::socialpages($blogid),
                        'social' => BlogModel::social()
                    ));
                    break;
                case 'blog_update':
                    BlogModel::blog_update($blogid);
                    Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage');
                    break;
                case 'history':
                    echo 'history';
                    break;
                case 'mods':
                    if (UserModel::getExtendedPermission($blogid)) {
                        $this->View->render('manage/mods', array(
                            'blog' => BlogModel::getBlog($blogid),
                            'mods' => BlogModel::getMods($blogid)
                        ));
                    } else {
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/');
                    }
                    break;
                case 'addmod_action':
                    if (BlogModel::addMod($blogid)) {
                        Session::add('feedback_positive', 'Moderator lades till');
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/mods');
                    } else {
                        Session::add('feedback_negative', 'Moderator kunde inte läggas till, var vänlig försök igen');
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/mods');
                    }
                    break;
                case 'category':
                    $this->View->render('manage/category', array(
                        'blog' => BlogModel::getBlog($blogid),
                        'category' => CategoryModel::showCategory($blogid, null, Request::get('page')),
                        'paginate' => new Paginate("Category WHERE blog_id = :blog_id", [':blog_id' => $blogid], 10)
                    ));
                    break;
                case 'editcategory':
                    CategoryModel::editCategory($blogid);
                    Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/category');
                    break;
                case 'removecategory':
                    echo CategoryModel::removeCategory($blogid);
                    break;
                case 'remove':
                    break;
                //TODO
                case 'pages':
                    $this->View->render('manage/pages', array(
                        'blog' => BlogModel::getBlog($blogid),
                        'pages' => BlogModel::showPages($blogid)
                    ));
                    break;
                case 'addpage':
                    $this->View->render('manage/addpage', array(
                        'blog' => BlogModel::getBlog($blogid)
                    ));
                    break;
                case 'addpage_action':
                    if (BlogModel::addpage($blogid)) {
                        Session::add('feedback_positive', 'Sidan skapades.');
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/pages');
                    } else {
                        Session::add('feedback_negative', 'Sidan kunde ej skapas, försök igen.');
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/addpage');
                    }
                    break;
                case 'editpage':
                    $page = BlogModel::getPage($blogid, $postslug);
                    $this->View->render('manage/editpage', array(
                        'blog' => BlogModel::getBlog($blogid),
                        'page' => $page,
                    ));
                    break;
                case 'pageedit_action':
                    $editpage = BlogModel::editPages($blogid, $postslug);
                    if($editpage){
                        Session::add('feedback_positive', 'Din sida har uppdaterats.');
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/pages');
                    } else {
                        Session::add('feedback_negative', 'Din sida kunde ej uppdateras.');
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/editpage/' . $postslug);
                    }
                    break;
                case 'deletepage':
                    if (UserModel::getEditPermission($blogid)) {
                        BlogModel::deletepage($blogid, $postslug);
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/pages');
                    } else {
                        Redirect::to(BlogModel::getBlog($blogid)->slug . '/manage/pages');
                    }
                    break;
                default:
                    header('HTTP/1.0 404 Not Found', true, 404);
                    $this->View->render('error/404');
                    break;
            }
        } else {
            Redirect::to(BlogModel::getBlog($blogid)->slug);
        }

    }

    public function removeMod($blog_id)
    {
        echo BlogModel::removeMod($blog_id);
    }

    public function ajaxcheck($action = 'index', $value = null)
    {
        switch ($action) {
            case 'blog_slug':
                $baseSlug = BlogModel::slugify($value);
                $slug = $baseSlug;
                for ($i = 0; $i < 5; $i++) {
                    if (!BlogModel::blogexists($slug) && !Blacklist::contains($slug)) {
                        echo $slug;
                        break;
                    }
                    $slug = $baseSlug . '-' . Text::generateRandomString(6);
                }
                if (BlogModel::blogexists($slug)) {
                    echo "Kunde inte skapa en unik slug";
                }
                break;
            case 'post_likes':
                echo BlogModel::getPostLikes(Request::post('post_id'));
                break;
            case 'comment_likes':
                echo CommentModel::getCommentLikes(Request::post('comment_id'));
                break;
            case 'posthistory':
                $this->View->renderJSON(BlogModel::getposthistoryrow(Request::post('post_id')));
                break;
            default:
                header('HTTP/1.0 404 Not Found', true, 404);
                $this->View->render('error/404');
                break;
        }
    }

    public function ajaxAdd($blogid, $action = 'index'){
        switch (strtolower($action)){
            case 'index':
                break;
            case 'addcategory':
                if(!CategoryModel::getCategory($blogid, Request::post('name'))){
                    CategoryModel::addCategory($blogid);
                }
                $this->View->renderJSON(CategoryModel::showCategory($blogid, null, null, -1));
                break;
            default:
                header('HTTP/1.0 404 Not Found', true, 404);
                $this->View->render('error/404');
                break;
        }
    }

    public function comment($blogid, $postslug)
    {
        $blog = BlogModel::getBlog($blogid);
        CommentModel::postComment(BlogModel::getpost($blogid, $postslug)->id);
        Redirect::to($blog->slug."/".$postslug);
    }

    public function update_comment($blogid, $postslug)
    {
        $blog = BlogModel::getBlog($blogid);
        CommentModel::updateComment();
        Redirect::to($blog->slug."/".$postslug);
    }

    public function remove_comment($blogid, $postslug, $comment)
    {
        $blog = BlogModel::getBlog($blogid);
        CommentModel::removeComment($comment);
        Redirect::to($blog->slug."/".$postslug);
    }

    public function like(){
        if(Request::post('like') == 1){
            if(BlogModel::addPostlike()){
                echo 1;
            }
        }else{
            if(BlogModel::removePostlike()){
                echo 0;
            }
        }
    }

    public function like_comment(){
        if(Request::post('like') == 1){
            if(CommentModel::addCommentlike()){
                echo 1;
            }
        }else{
            if(CommentModel::removeCommentlike()){
                echo 0;
            }
        }
    }

    public function visibility(){
        echo BlogModel::switchVisible();
    }

    public function favorite(){
        if(Request::post('favorite') == 1){
            if(FavoriteModel::addfavorite()){
                echo 1;
            }
        }else {
            if(FavoriteModel::removefavorite()){
                echo 0;
            }
        }
    }

    public function report(){
        if(Session::userIsLoggedIn()){
            echo ReportModel::report();
        }
    }
}
