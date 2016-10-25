<?php
function renderComments($post, $blog_id, $blogslug, $postslug, $comments, $depth)
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
                        elseif (isset($comment->user_id))
                            echo 'Användare borttagen';
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
                    if ($comment->deleted == 1 || $comment->flagged == 1) {
                        echo "<p><i style='color: gray'>Den här kommentaren är bortagen</i></p>";
                    } else {
                        ?><p><?= $comment->comment ?></p>
                        <?php
                    }
                    if ($comment->deleted == 0) {
                        if (Session::userIsLoggedIn()) {
                            if ((UserModel::getEditPermission($blog_id) || Session::get("user_id") == $comment->user_id)) {
                                ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs dropdown-toggle"
                                            data-toggle="dropdown">
                                        <!--<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown"> -->
                                        Mer
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li
                                            <?php if ((Session::get("user_id") != $comment->user_id)) {
                                                echo " class='disabled'";
                                            } ?>><a data-toggle="collapse" href="#cha_<?= $comment->id ?>"
                                                    data-parent="#accordion<?= $comment->id ?>">Redigera</a></li>
                                        <li>
                                            <a onclick="return confirm('Är du säker på att du vill ta bort din kommentar?')"
                                               href="<?= Config::get('URL') . $blogslug . "/remove_comment/" . $postslug . "/" . $comment->id ?>">
                                                Ta bort
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--  <button type="button" class="btn btn-xs" data-toggle="collapse" href="#cha_<?= $comment->id ?>"
                                                                                                                                            data-parent="#accordion<?= $comment->id ?>">
                                        Ändra
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-xs">Ta bort</button> -->
                                <?php
                            }
                        }
                        ?>
                        <button type="button" class="btn btn-xs" data-toggle="collapse"
                                href="#ans_<?= $comment->id ?>"
                                data-parent="#accordion<?= $comment->id ?>">
                            Svara
                        </button>
                        <?php
                        if (Session::userIsLoggedIn()) {
                            if (CommentModel::likingcomment($comment->id)) {
                                ?>
                                <a onclick="like_comment(this, <?= $comment->id ?>, 0)"
                                   class="btn btn-primary btn-xs">Sluta
                                    gilla</a>
                                <?php
                            } else {
                                ?>
                                <a onclick="like_comment(this, <?= $comment->id ?>, 1)"
                                   class="btn btn-primary btn-xs">Gilla</a>
                                <?php
                            }
                            ?>
                            <?php
                            // Report comment
                            if (ReportModel::reportexists(Session::get('user_id'), 1, $comment->id)) {
                                echo 'Rapporterad';
                            } else {
                                echo '<a onclick="report(this,' . $comment->id . ', 1, prompt(\'Anledning till rapportering\', \'\'))" class="btn btn-xs btn-danger glyphicon glyphicon-flag"></a>';
                            } // End Report Comment
                            ?>
                        <?php } ?>
                        <div class="like">
                            <p><b id="comment_likes<?= $comment->id ?>"><?= $comment->likes ?></b> Gillningar</p>
                        </div>
                        <div id="accordion<?= $comment->id ?>">
                            <?php
                            if (Session::get("user_id") == $comment->user_id) {
                                ?>
                                <div class="panel comment_panel">
                                    <div id="cha_<?= $comment->id ?>" class="collapse">
                                        <form method="post"
                                              action="<?= Config::get("URL") . $blogslug . "/update_comment/" . $postslug ?>">
                                            <input type="hidden" name="comment_id" value="<?= $comment->id ?>"/>
                                            <br/>
                                            <textarea maxlength=255 name="comment"
                                                      class="form-control"><?= $comment->comment ?></textarea>
                                            <br/>
                                            <input type="submit" class="btn btn-primary btn-sm" value="Ändra"/>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="panel comment_panel">
                                <div id="ans_<?= $comment->id ?>" class="collapse">
                                    <form method="post"
                                          action="<?= Config::get("URL") . $blogslug . "/comment/" . $postslug ?>">
                                        <?php if ($depth < 7) { ?>
                                            <input type="hidden" name="comment_id" value="<?= $comment->id ?>"/>
                                        <?php } else { ?>
                                            <input type="hidden" name="comment_id"
                                                   value="<?= $comment->comment_id ?>"/>
                                        <?php } ?>
                                        <br/>
                                        <textarea maxlength=255 name="comment" class="form-control"></textarea>
                                        <br/>
                                        <input type="submit" class="btn btn-primary btn-sm" value="Skicka"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    if ($depth <= 7) {
                        renderComments($post, $blog_id, $blogslug, $postslug, $comment->subComments, $depth + 1);
                    }
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
                <p class="text-center"><?= BlogModel::getCategory($this->post->category_id) ?></p>
                <?= $bbcode->parse(Filter::XSSFilter($this->post->content), true) ?>
                <div class="time row">
                    <div class="pull-left">
                        <p><?= $this->post->created ?>
                            <?php if (Session::userIsLoggedIn()) {
                                // Report comment
                                if (ReportModel::reportexists(Session::get('user_id'), 2, $this->post->id)) {
                                    echo '- <b style="color:red"> Rapporterad</b>';
                                } else {
                                    echo '<a style="margin:0px 0px 3px 5px;" onclick="report(this,' . $this->post->id . ', 2, prompt(\'Anledning till rapportering\', \'\'))" class="btn btn-xs btn-danger glyphicon glyphicon-flag"></a>';
                                } // End Report Comment
                            }?></p>
                    </div>
                    <div class="pull-right">
                        <?php
                        if (Session::userIsLoggedIn()) {
                            if (BlogModel::likingpost($this->post->id)) {
                                ?>
                                <a id="gill" onclick="like_post(this, <?= $this->post->id ?>, 0)"
                                   class="btn btn-primary btn-sm">Sluta
                                    gilla</a>
                                <?php
                            } else {
                                ?>
                                <a id="gill" onclick="like_post(this, <?= $this->post->id ?>, 1)"
                                   class="btn btn-primary btn-sm">Gilla</a>
                                <?php
                            }
                            if (FavoriteModel::checkfavorite($this->post->id)) {
                                ?>
                                <a onclick="favoritepost(this, <?= $this->post->id ?>, 0)"
                                   class="btn btn-primary btn-sm glyphicon glyphicon-star"></a>
                                <?php
                            } else { ?>
                                <a onclick="favoritepost(this, <?= $this->post->id ?>, 1)"
                                   class="btn btn-primary btn-sm glyphicon glyphicon-star-empty"></a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="pull-right like">
                        <p id="gilla"><b><?= $this->post->likes ?></b> Gillningar</p>
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
                        <textarea maxlength=255 class="form-control" name="comment"
                                  placeholder="<?php if ($this->post->allow_comments == 1)
                                      echo "Skriv en kommentar...";
                                  else
                                      echo "Kommentarer har blivit avstängd"; ?>"
                            <?php if ($this->post->allow_comments == 1)
                                echo "required";
                            else
                                echo "disabled";
                            ?>></textarea>
                        <br/>
                        <input type="submit" class="btn btn-primary pull-right"
                               value="Skicka"
                            <?php if ($this->post->allow_comments == 0)
                                echo "disabled"; ?>/>
                    </form>
                </div>
                <div class="col-md-12">
                    <?php
                    if ($this->post->allow_comments == 1)
                        renderComments($this->post, $this->blog->id, $this->blog->slug, $this->post->slug, $this->comments, 0);
                    $this->paginate->render();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>