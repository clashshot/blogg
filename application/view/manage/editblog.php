<div class="container-fluid">
    <?php
    include "sidebar.php";
    ?>
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-md-9">
        <form method="post" action="<?php echo Config::get('URL'); ?><?= $this->blog->slug ?>/manage/blog_update">
            <div class="form-group">
                <label>Bloggnamn</label>
                <input type="text" name="title" class="form-control" value="<?= $this->blog->title ?>" required
                       placeholder="Här skriver du in din titel">
            </div>
            <div class="form-group">
                <div class="row">
                    <?php
                    foreach ($this->social_pages as $social) {
                        ?>
                        <div class="col-md-4" id="<?= $social->parent_class ?>">
                            <div class="input-group"><span class="input-group-addon"><i style="font-size:21px"
                                                                                        class="<?= $social->class ?>"></i></span><input
                                    type="text" name="social[<?= $social->id ?>]" value="<?= $social->link ?>"
                                    class="form-control"
                                    placeholder="<?= $social->placeholder ?>"></div>
                        </div>
                        <?php
                    }
                    ?>
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
                <input type="text" name="description" class="form-control" value="<?= $this->blog->description ?>"
                       required
                       placeholder="Skriv en beskriving om bloggen">
            </div>
            <input type="submit" value="Uppdatera blogg" class="btn btn-primary"/>
        </form>
    </div>
</div>