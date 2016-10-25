<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="well">
        <div class="profile-userpic text-center">
            <img src="<?= $this->user->user_avatar_link ?>">
        </div>
        <div class="text-center">
            <h2><?= $this->user->user_name ?></h2>
        </div>
        <h4 class="text-center"><?= $this->blog->description ?></h4>
        <div class="text-center">
            <ul class="social-network social-circle">
                <?php
                if (!empty($this->blog->social)) {
                    foreach ($this->blog->social as $social) {
                        ?>
                        <li><a href="<?= $social->base_url . $social->link ?>" class="<?=$social->parent_class?>" title="<?= $social->name ?>"><i
                                    class="<?= $social->class ?>"></i></a></li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <h4 style="margin-left:15px;">Kategorier</h4>
        <ul class="list-group">
            <?php
            if (!empty($this->category)) {
                foreach ($this->category as $row) {
                    echo '<a href="' . Config::get('URL') . $this->blog->slug . '/category/' . $row->slug . '" class="list-group-item">' . $row->name . '</a>';
                }
            } else {
                echo '<div class="panel-body">Inga kategorier</div>';
            }

            ?>


        </ul>
    </div>
</div>