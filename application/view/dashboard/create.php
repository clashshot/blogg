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
        <div class = "form-group">
            <label>Kort beskrivning om dig</label>
            <input type="text" name="description" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="radio-inline"><input type="radio" name="visibility" value="1" checked />Synlig</label>
            <label class="radio-inline"><input type="radio" name="visibility" value="0" />Ej synlig</label>
        </div>
        <div class="form-group">
            <label>Beskrivning om din blogg</label>
        <textarea name="about" class="form-control" id="editor" rows="12"></textarea>
        </div>
        <input type="submit" value="Skapa" class ="btn btn-primary pull-right"/>
    </form>
    </div>
    </div>
