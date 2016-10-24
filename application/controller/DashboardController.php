<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class DashboardController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {
        $this->View->render('dashboard/index', array(
            'listblogs' => DashboardModel::listblogs(),
            'listmodblogs' => DashboardModel::listmodblogs()
    ));
    }

    public function create() {
        $this->View->render('dashboard/create');
    }

    public function favorite() {
        $this->View->render('dashboard/favorite', array(
            'posts' => FavoriteModel::favoritelist(),
            'paginate' => new Paginate("Favorite WHERE Favorite.user_id = :userid", array('userid' => Session::get('user_id')), 10)
        ));
    }

    public function blog_create(){
        // Brolaugh was here <3 lol
        if($blog = BlogModel::blog_create()){
            Session::add('feedback_positive', 'Bloggen har skapats');
            Redirect::to($blog->slug . "/manage" );
        } else {
            Session::add('feedback_negative', 'Bloggen kunde inte skapas, kontrollera och försök igen.');
            Redirect::to('dashboard/create');
        }
    }

    public function delete($slug){
        if(DashboardModel::delete($slug)){
            Session::add('feedback_positive', 'Bloggen togs bort.');
            Redirect::to('dashboard');
        } else {
            Session::add('feedback_negative', 'Kunde ej ta bort, försök igen.');
            Redirect::to('dashboard');
        }
    }
}
