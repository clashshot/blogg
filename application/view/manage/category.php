<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>
        <a href="<?php echo Config::get('URL');
        echo $this->blog->slug; ?>/manage/addpost" class="btn btn-primary btn-xs pull-right"
           style="margin:8px 8px 0px 0px">Skapa ny kategori</a>
        <div class="panel panel-default">
            <div class="panel-heading">Dina kategorier</div>
            <div class="panel-body">
                <?php if (!empty($this->category)) { ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Namn</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->category as $post) { ?>
                            <tr>
                                <td><?= $post->name ?></td>
                                <td class="text-center"><a class='btn btn-info btn-xs'
                                                           href="<?= Config::get("URL") . $this->blog->slug ?>/manage/editcategory/<?= $post->id ?>"><span
                                            class="glyphicon glyphicon-edit"></span> Ändra</a> <a href="<?= Config::get("URL") . $this->blog->slug ?>/manage/removecategory/<?= $post->id ?>"
                                                                                                  class="btn btn-danger btn-xs"><span
                                            class="glyphicon glyphicon-remove"></span> Del</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    $this->paginate->render();
                }else {
                    echo 'Du har inga kategorier';
                }
                ?>
            </div>
        </div>

    </div>

</div>
