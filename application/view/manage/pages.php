<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>
        <a href="<?php echo Config::get('URL');
        echo $this->blog->slug; ?>/manage/addpage" class="btn btn-primary btn-xs pull-right"
           style="margin:8px 8px 0px 0px">Lägg till sida</a>
        <div class="panel panel-default">
            <div class="panel-heading">Dina inlägg</div>
            <div class="panel-body">
                <?php if (!empty($this->pages)) { ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Titel</th>
                            <th>Skapad</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->pages as $page) { ?>
                            <tr>
                                <td><?= $page->title ?></td>
                                <td><?= $page->created ?></td>
                                <td class="text-center">
                                    <a class='btn btn-info btn-xs'href="<?= Config::get("URL") . $this->blog->slug ?>/manage/editpage/<?= $page->slug ?>">
                                        <span class="glyphicon glyphicon-edit"></span> Ändra</a>
                                    <a class="btn btn-danger btn-xs" href="<?php echo Config::get('URL') . $this->blog->slug; ?>/manage/deletepage/<?php echo $page->slug; ?>" onclick="return confirm('Är du säker på att du vill ta bort detta inlägg?')">
                                        <span class="glyphicon glyphicon-remove"></span> Ta bort</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>

    </div>

</div>