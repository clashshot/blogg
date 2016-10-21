<?php
$bbcode = new Golonka\BBCode\BBCodeParser;
?>
<div class="container">
    <div class="well">
        <h1 class="text-center"><?= $this->page->title;?></h1>
        <p class="text-center"><?= $this->user->user_name?></p>
        <div><?= $bbcode->parse($this->page->content)?></div>
        <div class="profile-userpic text-center">
            <img src="<?= $this->user->user_avatar_link?>">
        </div>
        <div class="text-center">
            <ul class="social-network social-circle">
                <?php
                if(isset($this->blog->facebook)){
                    ?>
                    <li><a href="<?=$this->blog->facebook?>" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <?php
                }
                if(isset($this->blog->twitter)){
                    ?>
                    <li><a href="<?=$this->blog->twitter?>" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                    <?php
                }
                if(isset($this->blog->google_plus)){
                    ?>
                    <li><a href="<?=$this->blog->google_plus?>" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>
