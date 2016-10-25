<div class="container">

    <?php $this->renderFeedbackMessages(); ?>
    <div class="panel panel-default">

        <div class="panel-heading">Skapa ny blogg</div>
        <div class="panel-body">
            <form method="post" action="<?php echo Config::get('URL'); ?>dashboard/blog_create">
                <div class="form-group">
                    <label>Bloggnamn</label>
                    <input type="text" onkeyup="blogSlugCheck(this)" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-6">
                                <select id="social_select" class="form-control">
                                    <?php
                                    foreach ($this->social as $social) {
                                        ?>
                                        <option value="<?= $social->id ?>"
                                                data-placeholder="<?= $social->placeholder ?>"
                                                data-class="<?= $social->class ?>"
                                                data-parentclass="<?=$social->parent_class?>"><?= $social->name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary col-md-6" onclick="addSocial(this)">Lägg till</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Kort beskrivning om dig</label>
                    <input type="text" name="description" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="radio-inline"><input type="radio" name="visibility" value="1" checked/>Synlig</label>
                    <label class="radio-inline"><input type="radio" name="visibility" value="0"/>Ej synlig</label>
                </div>
                <input type="submit" value="Skapa" class="btn btn-primary pull-right"/>
            </form>
        </div>
    </div>
