<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Bloggar:</div>
            <table class="table table-hover table-striped">
                <tbody>
                <?php
                if(!empty($this->blogs)){
                    foreach($this->blogs as $key => $value){ ?>
                        <tr>
                            <td>
                            <h4>
                                <b><?= $value->title; ?></b>
                            </h4>
                            <p style="max-width: 80%"><?= $value->description; ?></p>
                            </td>
                            <td><?=$value->posts?> Inlägg</td>
                        </tr>
                    <?php }
                }?>
                <!-- <a href="#"><i class="fa fa-2x"></i></a> -->
                </tbody>
            </table>
        </div>
    </div>
</div>
