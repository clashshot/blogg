<?php
    function renderComments($comments){
        if(!empty($comments)) {
            foreach ($comments as $comment) {
                $comment->user_avatar_link = (Config::get('USE_GRAVATAR') ? AvatarModel::getGravatarLinkByEmail($comment->user_email) : AvatarModel::getPublicAvatarFilePathOfUser($comment->user_has_avatar, $comment->user_id));
                ?>
                <div class="media">
                    <div class="media-left">
                        <?php if (isset($comment->user_avatar_link)) { ?>
                            <img src="<?=$comment->user_avatar_link?>"/>
                        <?php } ?>
                    </div>
                    <div class="media-body">
                        <h4 class="medua-heading">
                            <?=$comment->user_name?> <small><i>Kommenterades <?= $comment->created ?></i></small>
                        </h4>
                        <p><?= $comment->comment ?></p>
                        <?php
                        renderComments($comment->subComments);
                        ?>
                    </div>
                </div>
                <?php
            }
        }
    }
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 well">
            <h2 class="text-center"><?=$this->post->title?></h2>
            <?=$this->post->content?>
        </div>
    </div>
    <div class="row">
    <div class="col-md-8 well col-md-offset-2">
        <?php
        renderComments($this->comments);
        ?>
    </div>
    </div>
</div>