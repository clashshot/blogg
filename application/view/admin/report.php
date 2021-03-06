<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <div class="panel panel-default">
            <div class="panel-heading">Rapporteringar</div>
            <div class="panel-body">
                <?php
                if (!empty($this->reports)) { ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Användare</th>
                            <th>Typ</th>
                            <th>Anledning</th>
                            <th>Prioritet</th>
                            <th>Innehåll</th>
                            <th>Hantering</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($this->reports as $report) {
                            ?>
                            <tr>
                                <td>
                                    <a href="<?= Config::get('URL') . 'profile/showProfile/' . $report->user_id; ?>"><?= $report->user_name ?></a>
                                </td>
                                <td><?php
                                    switch ($report->type) {
                                        case 0:
                                            echo 'Blogg';
                                            break;
                                        case 1:
                                            echo 'Kommentar';
                                            break;
                                        case 2:
                                            echo 'Inlägg';
                                            break;
                                    }
                                    ?></td>
                                <td><a type="button" class="reportmodal" data-toggle="modal" data-target="#report<?=$report->id?>"><?=substr($report->reason, 0, 40) ?><?php if(strlen($report->reason) > 40)echo '...';?></a></td>
                                <td><?php
                                    switch ($report->priority) {
                                        case 1:
                                            echo 'Låg';
                                            break;
                                        case 2:
                                            echo 'Medel';
                                            break;
                                        case 3:
                                            echo 'Hög';
                                            break;
                                    }
                                    ?></td>
                                <td><?php
                                    switch ($report->type) {
                                        case 0:
                                            $blog = BlogModel::getBlog($report->reported_id);
                                            if(isset($blog)){
                                                echo '<a href="' . Config::get('URL') . $blog->slug . '">Gå till ' . $blog->slug . '</a>';
                                            }else{
                                                echo 'Bloggen hittades inte';
                                            }
                                            break;
                                        case 1:
                                            $comment = CommentModel::getcomment($report->reported_id)->comment;
                                            if(isset($blog)){
                                                echo $comment;
                                            }else{
                                                echo 'Kommentaren hittades inte';
                                            }
                                            break;
                                        case 2:
                                            $post = BlogModel::getpostbyid($report->reported_id);
                                            if(!empty($post)){
                                                $blog = BlogModel::getBlog($post->blog_id);
                                                if(isset($blog)){
                                                    echo '<a href="' . Config::get('URL') . $blog->slug . '/' . $post->slug . '">Gå till ' . $blog->slug . '</a>';
                                                }else{
                                                    echo 'Inlägget hittades inte';
                                                }
                                            }else{
                                                echo 'Inlägget hittades inte';
                                            }
                                            break;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button type="button" onclick="solvereport(this, <?= $report->id ?>)"
                                            class="btn btn-primary">Löst
                                    </button>
                                </td>
                            </tr>
                            <div id="report<?=$report->id?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Anledning</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><?=$report->reason?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                        } ?>
                        </tbody>
                    </table>
                    <?php
                    $this->paginate->render();
                } else {
                    echo 'Det finns inga rapporter att hantera';
                }
                ?>
            </div>
        </div>
    </div>
</div>
