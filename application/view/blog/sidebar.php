<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="well">
        <div class="profile-userpic text-center">
            <img src="<?=$this->user->user_avatar_link?>">
        </div>
        <div class="text-center">
            <h2><?=$this->user->user_name ?></h2>
        </div>
        <h4 class="text-center"><?= $this->blog->description ?></h4>
        <div class="text-center">
            <ul class="social-network social-circle">
                <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>
    </div>
</div>