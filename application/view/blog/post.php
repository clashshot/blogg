<?php
function renderComments($blogslug, $postslug, $comments)
{
    if (!empty($comments)) {
        foreach ($comments as $comment) {
            $comment->user_avatar_link = (Config::get('USE_GRAVATAR') ? AvatarModel::getGravatarLinkByEmail($comment->user_email) : AvatarModel::getPublicAvatarFilePathOfUser($comment->user_has_avatar, $comment->user_id));
            ?>
            <div data-comment="<?= $comment->id ?>" class="media">
                <div class="media-left">
                    <?php if (isset($comment->user_avatar_link)) { ?>
                        <img src="<?= $comment->user_avatar_link ?>"/>
                    <?php } ?>
                </div>
                <div class="media-body">
                    <h4 class="medua-heading">
                        <?php
                        if (!empty($comment->user_name))
                            echo $comment->user_name;
                        else
                            echo "Anonym";
                        ?>
                        <small><i>Kommenterades <?= $comment->created ?></i></small>
                    </h4>
                    <p><?= $comment->comment ?></p>
                    <button type="button" class="btn btn-sm" data-toggle="collapse" data-target="#<?= $comment->id ?>">
                        Svara
                    </button>
                    <input type="submit" class="btn btn-primary btn-sm" value="Gilla"/>
                    <div class="like">
                        <p><b><?=$comment->likes?></b> Gillningar</p>
                    </div>
                    <div id="<?= $comment->id ?>" class="collapse">
                        <form method="post" action="<?= Config::get("URL") . $blogslug . "/comment/" . $postslug ?>">
                            <input type="hidden" name="comment_id" value="<?= $comment->id ?>"/>
                            <br/>
                            <textarea type="text" name="comment" class="form-control"></textarea>
                            <br/>
                            <input type="submit" class="btn btn-primary btn-sm" value="Skicka"/>
                        </form>
                    </div>
                    <?php
                    renderComments($blogslug, $postslug, $comment->subComments);
                    ?>
                </div>
            </div>
            <?php
        }
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well">
                <h1 class="text-center"><?= $this->post->title ?></h1>
                <?= $this->post->content ?>
                <div class="time row">
                    <div class="pull-left">
                        <p><?= $this->post->created ?></p>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm">Gilla</a>
                    </div>
                    <div class="pull-right like">
                        <p><b><?= $this->post->likes ?></b> Gillningar</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include "sidebar.php";
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="well" style="overflow: auto">
                <div class="col-md-12">
                    <form method="post"
                          action="<?= Config::get("URL") . $this->blog->slug . "/comment/" . $this->post->slug ?>">
                        <textarea type="text" class="form-control" name="comment" placeholder="Skriv en kommentar..."
                                  required></textarea>
                        <br/>
                        <input type="submit" class="btn btn-primary" value="Skicka"/>
                    </form>
                </div>
                <div class="col-md-12">
                    <?php
                    renderComments($this->blog->slug, $this->post->slug, $this->comments);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>