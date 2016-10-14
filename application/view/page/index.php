<div class="container">
    <div class="well">
        <h1 class="text-center"><?= $this->page->title;?></h1>
        <p class="text-center"><?= $this->user->user_name?></p>
        <h4><?= $this->page->content;?></h4>
        <div class="profile-userpic text-center">
            <img src="<?= $this->user->user_avatar_link?>">
        </div>
        <div class="text-center">
            <ul class="social-network social-circle">
                <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>
    </div>
</div>
