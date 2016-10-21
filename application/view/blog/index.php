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
                            <h2 class="text-center"><?= $post->title ?></h2>
                                <p class="text-center"><?= BlogModel::getCategory($post->category_id) ?></p>
                            <div class="col-md-12">
                                <div class="short"><?= $bbcode->parse(Filter::XSSFilter($post->content), true) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group text-center readmore">
                                <a class="btn btn-primary">Se hela posten</a>
                            </div>
                        </div>
                        <div class="time row">
                            <div class="pull-left">
                                <p><?= $post->created ?></p>
                            </div>
                            <div class="pull-right comment">
                                <p class="commentlink"><b><?= $post->comments ?></b><a class="commentlink" href="<?= Config::get('URL') ?><?= $this->blog->slug ?>/<?= $post->slug ?>">
                                        Kommentarer</a></p>
                            </div>
                            <div class="pull-right like">
                                <p><b><?= $post->likes ?></b> Gillningar  </p>
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
