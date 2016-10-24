<div class="container">

    <?php $this->renderFeedbackMessages(); ?>
    <div class="panel panel-default">

        <div class="panel-heading">Skapa ny blogg</div>
        <div class="panel-body">
    <form method="post" action="<?php echo Config::get('URL'); ?>dashboard/blog_create">
        <div class = "form-group">
            <label>Bloggnamn</label>
            <input type="text" onkeyup="blogSlugCheck(this)" name ="title" class="form-control" required>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i style="font-size:22px" class="fa">&#xf082;</i>
                        </span>
                        <input type="text" name="facebook" class="form-control"
                               placeholder="/facebookusername">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i style="font-size:22px" class="fa">&#xf081;</i>
                        </span>
                        <input type="text" name="twitter" class="form-control"
                               placeholder="/twitterusername">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i style="font-size:22px" class="fa">&#xf0d4;</i>
                        </span>
                        <input type="text" name="google" class="form-control"
                               placeholder="/u/0/1234567890">
                    </div>
                </div>
            </div>
        </div>
        <div class = "form-group">
            <label>Kort beskrivning om dig</label>
            <input type="text" name="description" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="radio-inline"><input type="radio" name="visibility" value="1" checked />Synlig</label>
            <label class="radio-inline"><input type="radio" name="visibility" value="0" />Ej synlig</label>
        </div>
        <input type="submit" value="Skapa" class ="btn btn-primary pull-right"/>
    </form>
    </div>
    </div>
