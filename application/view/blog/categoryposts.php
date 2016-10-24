<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

            <?php
            $bbcode = new Golonka\BBCode\BBCodeParser;
            if(!empty($this->catpage)) {
                foreach ($this->catpage as $row) {
                    ?>
                    <div class="well well-post">
                        <div class="row">
                            <h2 class="text-center"><?= $row->title ?></h2>
                            <p class="text-center"><?= BlogModel::getCategory($row->category_id) ?></p>
                            <div class="col-md-12">
                                <div class="short"><?= $bbcode->parse(Filter::XSSFilter($row->content), true) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group pull-right readmore">
                                <a class="btn btn-primary"
                                   href="<?= Config::get('URL') ?><?= $this->blog->slug ?>/<?= $row->slug ?>">Läs mer</a>
                            </div>
                        </div>
                        <div class="time row">
                            <div class="pull-left">
                                <p><?= $row->created ?></p>
                            </div>
                            <div class="pull-right comment">
                                <p><b><?= $row->comments ?></b> Kommentarer</p>
                            </div>
                            <div class="pull-right like">
                                <p><b><?= $row->likes ?></b> Gillningar</p>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                $this->paginatecat->render();
            } else {
                echo 'Inga inlägg har hittats i denna kategori.';
            }
            ?>


        </div>
        <?php include "sidebar.php"; ?>
    </div>

</div>
