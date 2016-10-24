<div class="container-fluid">
    <?php include 'sidebar.php'; ?>
    <div class="col-md-9">
        <?php $this->renderFeedbackMessages();?>
        <div class="panel panel-default">

            <div class="panel-heading">
                Skapa sida
            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo Config::get('URL'); echo $this->blog->slug; ?>/manage/addpage_action">

                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Titel" required/>
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" id="editor"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" value="Skapa" />
                </form>
            </div>
        </div>
    </div>
</div>