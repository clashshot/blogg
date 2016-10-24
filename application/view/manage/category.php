<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>
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
                                <td class="text-center"><a class='btn btn-info btn-xs' type="button" data-toggle="modal" data-target="#myModal<?=$post->id?>"><span
                                            class="glyphicon glyphicon-edit"></span> Ändra</a> <a onclick="removecategory(this, <?=$this->blog->id?>, <?=$post->id?>)"
                                                                                                  class="btn btn-danger btn-xs"><span
                                            class="glyphicon glyphicon-remove"></span> Del</a></td>
                            </tr>
                            <div class="modal fade" id="myModal<?=$post->id?>" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Ändra <?=$post->name?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="<?= Config::get("URL") . $this->blog->slug ?>/manage/editcategory">
                                                <div class="form-group">
                                                    <input type="text" value="<?=$post->name?>" name="new_category" class="form-control">
                                                </div>
                                                <input type="hidden" value="<?=$post->id?>" name="category">
                                                <input type="submit" value="Ändra" class="btn btn-primary">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
