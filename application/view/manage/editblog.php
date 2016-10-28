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
                    <div class="col-md-3">
                        <select id="social_select" class="form-control" style="margin-bottom:15px;">
                            <?php
                            foreach ($this->social as $social) {
                                ?>
                                <option value="<?= $social->id ?>"
                                        data-placeholder="<?= $social->placeholder ?>"
                                        data-class="<?= $social->class ?>"
                                        data-parentclass="<?= $social->parent_class ?>"><?= $social->name ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary" onclick="addSocial(this)">Lägg till</button>
                    </div>
                </div>
                <?php
                foreach ($this->social_pages as $social) {
                    ?>
                    <div class="col-md-6" style="margin-left:-15px;" id="<?= $social->parent_class ?>">
                        <div class="input-group col-md-10" style="float: left"><span class="input-group-addon"><i
                                    style="font-size:21px" class="<?= $social->class ?>"></i></span><input
                                type="text" value="<?=$social->link?>" name="social[<?= $social->id ?>]" class="form-control"
                                placeholder="<?= $social->placeholder ?>"></div>
                        <button type="button" class="btn btn-danger" onclick="removeSocial(this)">X</button>
                    </div>
                    <br>
                    <br>
                    <br>
                    <?php
                }
                ?>
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