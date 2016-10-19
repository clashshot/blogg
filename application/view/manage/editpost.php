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
                        <label>Titel</label>
                        <input type="text" name="title" class="form-control" placeholder="Titel" value="<?= $this->post->title ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
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
                        <label>Hämta från historik (Valfritt)</label>
                        <select name="posthistory" id="posthistory" class="form-control">
                            <option selected disabled>Välj historik</option>
                            <?php
                            if(!empty($this->posthistory)){
                                foreach($this->posthistory as $posthistory){
                                    echo '<option value="'.$posthistory->id.'">'.$posthistory->title.' '.$posthistory->created.'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group" style="max-width:25%;">
                        <label>Synlighet rättigheter</label>
                        <select name="visibility" class="form-control" required>
                            <?php
                            switch ($this->post->visibility){
                                case '1':
                                    echo '<option value="1" selected>Publik</option>
                            <option value="2">Registrerade användare</option>
                            <option value="3">Privat</option>';
                                    break;
                                case '2':
                                    echo '<option value="1">Publik</option>
                            <option value="2" selected>Registrerade användare</option>
                            <option value="3">Privat</option>';
                                    break;
                                case '3':
                                    echo '<option value="1">Publik</option>
                            <option value="2">Registrerade användare</option>
                            <option value="3" selected>Privat</option>';
                                    break;
                            }
                            ?>
                        </select>
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