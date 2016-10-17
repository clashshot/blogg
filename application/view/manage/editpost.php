<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>

        <div class="panel panel-default">

            <div class="panel-heading">
                Ändra inlägg
            </div>
            <div class="panel-body">
                <form method="post" action="<?php echo Config::get('URL'); echo $this->blog->slug; ?>/manage/editpost_action/<?php echo $this->post->slug; ?>">

                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Titel" value="<?= $this->post->title ?>"/>
                    </div>
                    <div class="form-group">
                        <select name="category" class="form-control">
                            <?php
                            echo '<option value="'.$this->post->category_id.'" selected>'.CategoryModel::getnamebyid('Category', 'id', $this->post->category_id)->name.'</option>';
                            ?>
                            <?php
                            foreach($this->category as $key => $value){
                                echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <?php
                        if($this->post->visibility == 1) {
                            echo '<label class="radio-inline"><input type="radio" name="visibility" value="1" checked />Synlig</label>
                                  <label class="radio-inline"><input type="radio" name="visibility" value="0" />Ej synlig</label>';
                        } elseif($this->post->visibility == 0){
                            echo '<label class="radio-inline"><input type="radio" name="visibility" value="1" />Synlig</label>
                                 <label class="radio-inline"><input type="radio" name="visibility" value="0" checked/>Ej synlig</label>';
                        }

                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        if($this->post->allow_comments == 1){
                            echo '<label class="radio-inline"><input type="radio" name="comment" value="1" checked />Tillåt kommentarer</label>
                                  <label class="radio-inline"><input type="radio" name="comment" value="0" />Tillåt ej kommentarer</label>';
                        } elseif($this->post->allow_comments == 0){
                            echo '<label class="radio-inline"><input type="radio" name="comment" value="1" />Tillåt kommentarer</label>
                                  <label class="radio-inline"><input type="radio" name="comment" value="0" checked/>Tillåt ej kommentarer</label>';
                        }
                        ?>

                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" id="editor" rows="15"><?= $this->post->content; ?></textarea>
                    </div>

            </div>

        </div>
        <input type="submit" class="btn btn-primary pull-right" style="margin-bottom:30px;" value="Ändra" />

        </form>

    </div>

</div>