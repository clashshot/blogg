<div class="container">
<div class="row">

        <?php $this->renderFeedbackMessages(); ?>
        <a href="<?php echo Config::get('URL');?>dashboard/create" class="btn btn-primary btn-xs pull-right" style="margin:8px 8px 0px 0px">Skapa ny blogg</a>
    <div class="panel panel-default">
        <div class="panel-heading">Dina bloggar</div>
        <table class="table table-hover table-striped">
            <tbody>
            <?php if(!empty($this->listblogs)){
            foreach($this->listblogs as $key => $value){ ?>
                <tr>
                    <td>
                        <a href=""><i class="<?php if($value->visible == 1){ echo '-alt fa fa-2x fa-eye fa-fw"'; echo 'onclick="setVisibility(this, ' . $value->id . ', 0)"'; } else { echo 'fa fa-2x fa-fw fa-eye-slash"'; echo 'onclick="setVisibility(this, ' . $value->id . ', 1)"'; } ?>></i></a>
                    </td>
                    <td>
                        <h4>
                            <b><?= $value->title; ?></b>
                        </h4>
                        <p style="max-width: 80%"><?= $value->description; ?></p>

                    </td>
                    <td></td><td></td>
                    <td><?=$value->posts?> Inlägg</td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo Config::get('URL');echo $value->slug;?>"><button class="btn btn-default" type="button"><i class="fa fa-fw fa-eye"></i>Visa</button></a>
                            <a href="<?php echo Config::get('URL');echo $value->slug;?>/manage"><button class="btn btn-primary" type="button"><i class="fa fa-fw fa-cog"></i>Administrera</button></a>
                            <a href="<?php echo Config::get('URL'); ?>dashboard/delete/<?php echo $value->slug; ?>" onclick="return confirm('Är du säker på att du vill ta bort denna blogg?')"><button class="btn btn-danger" type="button"><i class="fa fa-fw s fa-remove"></i>Ta bort</button></a>
                        </div>
                    </td>
                </tr>
            <?php }
            }?>
            <!-- <a href="#"><i class="fa fa-2x"></i></a> -->
            </tbody>
        </table>
    </div>

</div>
</div>