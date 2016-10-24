<div class="container-fluid">
    <?php
    include "sidebar.php";
    ?>
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-md-9">
        <form method="post" action="<?php echo Config::get('URL'); ?><?= $this->blog->slug ?>/manage/blog_update">
            <div class="form-group">
                <input type="text" name="title" class="form-control" value="<?= $this->blog->title ?>" required
                       placeholder="Här skriver du in din titel">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i style="font-size:24px" class="fa">&#xf082;</i>
                            </span>
                            <input type="text" name="facebook" value="<?= $this->blog->facebook ?>" class="form-control" placeholder="/facebookusername">
                            </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i style="font-size:24px" class="fa">&#xf081;</i>
                            </span>
                            <input type="text" name="twitter" value="<?= $this->blog->twitter ?>" class="form-control"
                                   placeholder="/twitterusername">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i style="font-size:24px" class="fa">&#xf0d4;</i>
                             </span>
                            <input type="text" name="google" value="<?= $this->blog->google_plus ?>"
                                   class="form-control"
                                   placeholder="/u/0/1234567890">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" name="description" class="form-control" value="<?= $this->blog->description ?>"
                       required
                       placeholder="Skriv en beskriving om bloggen">
            </div>
            <div class="form-group">

                <textarea name="about" class="form-control" id="editor1"><?= $this->blog->about ?></textarea>
            </div>
            <script>
                CKEDITOR.replace('editor1', {
                    extraPlugins: 'bbcode',
                });
            </script>
            <input type="submit" value="Uppdatera blogg" class="btn btn-primary"/>
        </form>
    </div>
</div>