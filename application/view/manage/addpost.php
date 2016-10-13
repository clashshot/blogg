<div class="container">

    <div class="col-md-10 col-md-offset-1">
        <?php $this->renderFeedbackMessages(); ?>
        <div class="panel panel-default">

            <div class="panel-heading">
                Skapa post
            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo Config::get('URL'); echo $this->blog->slug; ?>/manage/addpost_action">

                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Titel" />
                    </div>
                    <div class="form-group">
                        <select name="category" class="form-control">
                            <option disabled selected>Välj kategori</option>
                            <option value="1">Vardag</option>
                            <option value="2">Bilar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="visibility" value="1" checked />Synlig</label>
                        <label class="radio-inline"><input type="radio" name="visibility" value="0" />Ej synlig</label>
                    </div>
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="comment" value="1" checked />Tillåt kommentarer</label>
                        <label class="radio-inline"><input type="radio" name="comment" value="0" />Tillåt ej kommentarer</label>
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" id="editor"></textarea>
                    </div>

            </div>

        </div>
        <input type="submit" class="btn btn-primary pull-right" style="margin-bottom:30px;" value="Skapa" />

        </form>
    </div>

</div>