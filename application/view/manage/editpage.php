<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>

        <div class="panel panel-default">

            <div class="panel-heading">
                Ändra sida
            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo Config::get('URL'); echo $this->blog->slug; ?>/manage/pageedit_action/<?php echo $this->page->slug; ?>">

                    <div class="form-group">
                        <label>Titel</label>
                        <input type="text" name="title" class="form-control" placeholder="Titel" value="<?= $this->page->title ?>"/>
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" id="editor" rows="15"><?= $this->page->content; ?></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" value="Ändra" />
                </form>
            </div>
        </div>
    </div>
</div>