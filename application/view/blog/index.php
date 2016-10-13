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
                            <p><b>73</b> Comments</p>
                        </div>
                        <div class="pull-right like">
                            <p><b>48</b> Likes</p>
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
                <div class="profile-userpic">
                    <img src="https://scontent-arn2-1.xx.fbcdn.net/v/t1.0-9/12523991_1075837129141264_7524897460062579225_n.jpg?oh=12d1e6829f5a4834197220de5747588e&oe=585F5ADC">
                </div>
                <?= $this->blog->description ?>
            </div>
        </div>
    </div>

</div>
