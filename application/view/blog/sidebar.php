<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="well">
        <div class="profile-userpic text-center">
            <img src="<?=$this->user->user_avatar_link?>">
            <?php if (Session::userIsLoggedIn()) {
                // Report comment
                if (ReportModel::reportexists(Session::get('user_id'), 0, $this->blog->id)) {
                    echo '<div class="vcenter" style="color:red;"><b>Rapporterad</b></div>';
                } else {
                    echo '<div class="vcenter" style="margin-top:5px;"><a style="margin:0px 0px 3px 5px;" type="button" data-toggle="modal" data-target="#0reportmodal' . $this->blog->id . '" id="0report' . $this->blog->id . '" class="btn btn-xs btn-danger glyphicon glyphicon-flag"></a></div>';
                } // End Report Comment
            }?>
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
                    echo '<a href="' . Config::get('URL') . $this->blog->slug . '/category/' . $row->slug . '" class="list-group-item';
                    if ($row->slug == $this->catslug){
                        echo ' active';
                    };
                    echo '">' . $row->name . '</a>';
                }
            } else {
                echo '<div class="panel-body">Inga kategorier</div>';
            }

            ?>
        </ul>
    </div>
    <div id="<?='0reportmodal' . $this->blog->id?>" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Rapportera blogg</h4>
                </div>
                <div class="modal-body">
                    <select id="0reportprio<?=$this->blog->id?>" class="form-control">
                        <option selected disabled>Prioritet</option>
                        <option value="1">Låg</option>
                        <option value="2">Medel</option>
                        <option value="3">Hög</option>
                    </select>
                    <br>
                    <textarea class="form-control" rows="4" id="<?='0reporttext' . $this->blog->id?>"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="report(document.getElementById('0report<?=$this->blog->id?>'), <?=$this->blog->id?>, 0, document.getElementById('0reporttext<?=$this->blog->id?>').value, '0reportprio<?=$this->blog->id?>')">Rapportera</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Avbryt</button>
                </div>
            </div>
        </div>
    </div>
</div>
