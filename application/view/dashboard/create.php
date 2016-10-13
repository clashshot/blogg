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
        <div class="form-group" style="max-width:25%;">
            <label>Synlighet rättigheter</label>
            <select name="visibility" class="form-control">
                <option selected disabled>Välj</option>
                <option value="1">Publik</option>
                <option value="2">Registrerade & Moderatorer</option>
                <option value="3">Privat</option>
            </select>
        </div>
        <div class="form-group">
            <label>Beskrivning om din blogg</label>
        <textarea name="about" class="form-control" id="editor" required rows="12"></textarea>
        </div>
        <script>
            CKEDITOR.replace('editor2',{
                extraPlugins : 'bbcode',
            });
        </script>
        <input type="submit" value="Skapa" class ="btn btn-primary pull-right"/>
    </form>
    </div>
    </div>
