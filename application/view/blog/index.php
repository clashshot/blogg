<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

            <?php
            foreach ($this->posts as $post) {
                ?>
                <div class="well well-post">
                    <div class="row">
                        <h2 class="text-center"><?= $post->title ?></h2>
                        <p class="text-center"><?=BlogModel::getCategory($post->category_id)?></p>
                        <div class="col-md-12">
                            <h4 class="short"><?= $post->content ?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group pull-right readmore">
                            <a class="btn btn-primary" href="<?=Config::get('URL')?><?=$this->blog->slug?>/<?=$post->slug?>">Read More</a>
                        </div>
                    </div>
                    <div class="time row">
                        <div class="pull-left">
                            <p><?= $post->created?></p>
                        </div>
                        <div class="pull-right comment">
                            <p><b><?=$post->comments?></b> Comments</p>
                        </div>
                        <div class="pull-right like">
                            <p><b><?=$post->likes?></b> Likes</p>
                        </div>
                    </div>
                </div>

                <?php
            }
            $this->paginate->render();
            ?>


        </div>
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
    </div>

</div>
