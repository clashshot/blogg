<?php

class IndexController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handles what happens when user moves to URL/index/index - or - as this is the default controller, also
     * when user moves to /index or enter your application at base level
     */
    public function index()
    {
        if (LoginModel::isUserLoggedIn()) {
            Redirect::to('dashboard');
        } else {
            $this->View->render('index/index');
        }
    }

    public function termsofservice()
    {
            $this->View->render('_templates/terms');
    }
    public function aboutus()
    {

        $this->View->render('_templates/aboutus');

    }

    public function contact(){
        $this->View->render('_templates/contact');
    }

    public function contact_action(){
        if(UserModel::contact()){
            Redirect::to('index/contact');
        } else {
            Redirect::to('index/contact');
        }
    }

}
