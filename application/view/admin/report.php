<div class="container-fluid">
    <h1>Admin/Reports</h1>

    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Gånger</th>
                    <th>Type</th>
                    <th>Reason</th>
                    <th>Priority</th>
                </tr>
            </thead>
            <tbody>
        <?php
        foreach ($this->reports as $report) {
            ?>
            <tr>
                <td><?=$report->times?></td>
                <td><?php
                    switch ($report->type){
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
                <td><?=$report->reason?></td>
                <td><?=$report->priority?></td>
            </tr>
            <?php
        }
        ?>
            </tbody>
        </table>
    </div>
</div>
