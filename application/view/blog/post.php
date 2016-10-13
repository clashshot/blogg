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
    <div class="col-md-8">
        <?php
        renderComments($this->comments);
        ?>
    </div>
</div>