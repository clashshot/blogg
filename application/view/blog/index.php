<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

            <?php
            $bbcode = new Golonka\BBCode\BBCodeParser;
            if (!empty($this->posts)) {
                foreach ($this->posts as $post) {
                    ?>
                    <div class="well well-post">
                        <div class="row">
                            <h2 class="text-center"><a style="text-decoration: none" href="<?= Config::get('URL') ?><?= $this->blog->slug ?>/<?= $post->slug ?>"><?= $post->title ?></a></h2>
                            <p class="text-center"><?= BlogModel::getCategory($post->category_id) ?></p>
                            <div class="col-md-12">
                                <div id="post<?=$post->id?>" class="collapse post"><?= $bbcode->parse(Filter::XSSFilter($post->content), true) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group text-center readmore">
                                <a type="button" data-target="#post<?=$post->id?>" class="post-collapse fa fa-chevron-down"></a>
                            </div>
                        </div>
                        <div class="time row">
                            <div class="pull-left">
                                <p><?php echo date("j F, Y g:i",strtotime($post->created));  ?>
                                <?php if (Session::userIsLoggedIn()) {
                                    // Report comment
                                    if (ReportModel::reportexists(Session::get('user_id'), 2, $post->id)) {
                                        echo '- <b style="color:red"> Rapporterad</b>';
                                    } else {
                                        echo '<a style="margin:0px 0px 3px 5px;" type="button" data-toggle="modal" data-target="#2reportmodal' . $post->id . '" id="2report' . $post->id . '" class="btn btn-xs btn-danger glyphicon glyphicon-flag"></a>';
                                    } // End Report Comment
                                }?></p>
                            </div>
                            <div class="pull-right comment">
                                <p class="commentlink"><b><?= $post->comments ?></b><a class="commentlink"
                                                                                       href="<?= Config::get('URL') ?><?= $this->blog->slug ?>/<?= $post->slug ?>">
                                        Kommentarer</a></p>
                            </div>
                            <div class="pull-right like">
                                <p><b><?= $post->likes ?></b> Gillningar</p>
                            </div>
                        </div>
                    </div>
                    <div id="<?='2reportmodal' . $post->id?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Rapportera inlägg</h4>
                                </div>
                                <div class="modal-body">
                                    <select id="2reportprio<?=$post->id?>" class="form-control">
                                        <option selected disabled>Prioritet</option>
                                        <option value="1">Låg</option>
                                        <option value="2">Medel</option>
                                        <option value="3">Hög</option>
                                    </select>
                                    <br>
                                    <textarea class="form-control" rows="4" id="<?='2reporttext' . $post->id?>"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="report(document.getElementById('2report<?=$post->id?>'), <?=$post->id?>, 2, document.getElementById('2reporttext<?=$post->id?>').value, '2reportprio<?=$post->id?>')">Rapportera</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Avbryt</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }else{
                echo "Finns inga inlägg att visa";
            }
            $this->paginate->render();
            ?>


        </div>
        <?php include "sidebar.php"; ?>
    </div>

</div>