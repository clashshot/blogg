<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>
        <a href="<?php echo Config::get('URL');
        echo $this->blog->slug; ?>/manage/addpost" class="btn btn-primary btn-xs pull-right"
           style="margin:8px 8px 0px 0px">Skriv
            nytt inlägg</a>
        <div class="panel panel-default">
            <div class="panel-heading">Dina inlägg</div>
            <div class="panel-body">
                <?php if (!empty($this->posts)) { ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Titel</th>
                            <th>Synlighet</th>
                            <th>Skapade</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->posts as $post) { ?>
                            <tr>
                                <td><?= $post->title ?></td>
                                <td><?= $post->visibility ?></td>
                                <td><?= $post->created ?></td>
                                <td class="text-center"><a class='btn btn-info btn-xs'
                                                           href="<?= Config::get("URL") . $this->blog->slug ?>/manage/editpost/<?= $post->slug ?>"><span
                                            class="glyphicon glyphicon-edit"></span> Ändra</a> <a href="<?php echo Config::get('URL') . $this->blog->slug; ?>/manage/deletepost/<?php echo $post->slug; ?>" onclick="return confirm('Är du säker på att du vill ta bort detta inlägg?')" class="btn btn-danger btn-xs"><span
                                            class="glyphicon glyphicon-remove"></span> Ta bort</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    $this->paginate->render();
                }else {
                    echo 'Du har inga inlägg';
                }
                ?>
            </div>
        </div>

    </div>

</div>