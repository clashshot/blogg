<?php
function renderComments($blog_id, $blogslug, $postslug, $comments)
{
    if (!empty($comments)) {
        foreach ($comments as $comment) {
            $comment->user_avatar_link = (Config::get('USE_GRAVATAR') ? AvatarModel::getGravatarLinkByEmail($comment->user_email) : AvatarModel::getPublicAvatarFilePathOfUser($comment->user_has_avatar, $comment->user_id));
            ?>
            <div data-comment="<?= $comment->id ?>" class="media">
                <div class="media-left">
                    <?php if (isset($comment->user_avatar_link)) { ?>
                        <img src="<?= $comment->user_avatar_link ?>" height="44px" width="44px"/>
                    <?php } ?>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <?php
                        if (!empty($comment->user_name))
                            echo $comment->user_name;
                        else
                            echo "Anonym";
                        ?>
                        <small><i><?php if ($comment->deleted == 0)
                                    echo "Kommenterades  $comment->created";
                                if (isset($comment->updated) && $comment->deleted == 0) {
                                    echo " | Redigerades " . $comment->updated . "";
                                } elseif (isset($comment->updated) && $comment->deleted == 1) {
                                    echo "Raderades " . $comment->updated . "";
                                } ?></i></small>
                    </h4>
                    <?php
                    if ($comment->deleted == 0) {
                        ?><p><?= $comment->comment ?></p>
                        <?php
                    } else {
                        echo "<p><i style='color: gray'>Den här kommentaren är bortagen</i></p>";
                    }
                    if ($comment->deleted == 0) {
                        if(Session::userIsLoggedIn()) {
                            if (UserModel::getEditPermission($blog_id))//(Session::get("user_id") == $comment->user_id && !empty($comment->user_id))
                            {
                                ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs dropdown-toggle"
                                            data-toggle="dropdown">
                                        <!--<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown"> -->
                                        Ändra
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a data-toggle="collapse" href="#cha_<?= $comment->id ?>"
                                               data-parent="#accordion<?= $comment->id ?>">Ändra</a></li>
                                        <li><a href="<?= Config::get('URL') . "/remove_comment/" . $comment->id ?>">Ta
                                                bort</a>
                                        </li>
                                        <li class="disabled"><a>Censurera</a></li>
                                    </ul>
                                    <!--  <button type="button" class="btn btn-xs" data-toggle="collapse" href="#cha_<?= $comment->id ?>"
                                                                                                                                            data-parent="#accordion<?= $comment->id ?>">
                                        Ändra
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-xs">Ta bort</button> -->
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <button type="button" class="btn btn-xs" data-toggle="collapse" href="#ans_<?= $comment->id ?>"
                                data-parent="#accordion<?= $comment->id ?>">
                            Svara
                        </button>
                        <?php
                        if (Session::userIsLoggedIn()) {
                            if (CommentModel::likingcomment($comment->id)) {
                                ?>
                                <a onclick="like_comment(this, <?= $comment->id ?>, 0)" class="btn btn-primary btn-xs">Sluta
                                    gilla</a>
                                <?php
                            } else {
                                ?>
                                <a onclick="like_comment(this, <?= $comment->id ?>, 1)"
                                   class="btn btn-primary btn-xs">Gilla</a>
                                <?php
                            }
                        }
                        ?>
                        <div class="like">
                            <p><b id="comment_likes<?= $comment->id ?>"><?= $comment->likes ?></b> Gillningar</p>
                        </div>
                        <div id="accordion<?= $comment->id ?>">
                            <?php
                            if (Session::get("user_id") == $comment->user_id) {
                                ?>
                                <div class="panel">
                                    <div id="cha_<?= $comment->id ?>" class="collapse">
                                        <form method="post"
                                              action="<?= Config::get("URL") . $blogslug . "/update_comment/" . $postslug ?>">
                                            <input type="hidden" name="comment_id" value="<?= $comment->id ?>"/>
                                            <br/>
                                            <textarea type="text" name="comment"
                                                      class="form-control"><?= $comment->comment ?></textarea>
                                            <br/>
                                            <input type="submit" class="btn btn-primary btn-sm" value="Ändra"/>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="panel">
                                <div id="ans_<?= $comment->id ?>" class="collapse">
                                    <form method="post"
                                          action="<?= Config::get("URL") . $blogslug . "/comment/" . $postslug ?>">
                                        <input type="hidden" name="comment_id" value="<?= $comment->id ?>"/>
                                        <br/>
                                        <textarea type="text" name="comment" class="form-control"></textarea>
                                        <br/>
                                        <input type="submit" class="btn btn-primary btn-sm" value="Skicka"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    renderComments($blog_id, $blogslug, $postslug, $comment->subComments);
                    ?>
                </div>
            </div>
            <?php
        }
    }
}

$bbcode = new Golonka\BBCode\BBCodeParser;
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well">
                <h1 class="text-center"><?= $this->post->title ?></h1>
                <?= $bbcode->parse($this->post->content, true) ?>
                <div class="time row">
                    <div class="pull-left">
                        <p><?= $this->post->created ?></p>
                    </div>
                    <div class="pull-right">
                        <?php
                        if (Session::userIsLoggedIn()) {
                            if (BlogModel::likingpost($this->post->id)) {
                                ?>
                                <a onclick="like_post(this, <?= $this->post->id ?>, 0)"
                                   class="btn btn-primary btn-sm">Sluta
                                    gilla</a>
                                <?php
                            } else {
                                ?>
                                <a onclick="like_post(this, <?= $this->post->id ?>, 1)"
                                   class="btn btn-primary btn-sm">Gilla</a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="pull-right like">
                        <p><b id="likes"><?= $this->post->likes ?></b> Gillningar</p>
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
                    renderComments($this->blog->id, $this->blog->slug, $this->post->slug, $this->comments);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>