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
                                <td><?= $report->reason ?></td>
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
                                            echo '<a href="' . Config::get('URL') . $blog->slug . '">Gå till ' . $blog->slug . '</a>';
                                            break;
                                        case 1:
                                            echo CommentModel::getcomment($report->reported_id)->comment;
                                            break;
                                        case 2:
                                            $post = BlogModel::getpostbyid($report->reported_id);
                                            $blog = BlogModel::getBlog($post->blog_id);
                                            echo '<a href="' . Config::get('URL') . $blog->slug . '/' . $post->slug . '">Gå till ' . $blog->slug . '</a>';
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

                            <?php
                        } ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo 'Det finns inga rapporter att hantera';
                }
                ?>
            </div>
        </div>
    </div>
</div>
