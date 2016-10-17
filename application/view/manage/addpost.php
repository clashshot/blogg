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
                    <div class="form-group" style="max-width:25%;">
                        <label>Synlighet rättigheter</label>
                        <select name="visibility" class="form-control">
                            <option selected disabled>Välj</option>
                            <option value="1">Publik</option>
                            <option value="2">Registrerade användare</option>
                            <option value="3">Privat</option>
                        </select>
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