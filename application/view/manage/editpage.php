<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>

        <div class="panel panel-default">

            <div class="panel-heading">
                Ändra sida
            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo Config::get('URL'); echo $this->blog->slug; ?>/manage/editpage_action/<?php echo $this->post->slug; ?>">

                    <div class="form-group">
                        <label>Titel</label>
                        <input type="text" name="title" class="form-control" placeholder="Titel" value="<?= $this->page->title ?>"/>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>