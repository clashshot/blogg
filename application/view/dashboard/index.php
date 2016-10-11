<div class="container-fluid">
<div class="row">

    <div class="col-md-12">
        <?php $this->renderFeedbackMessages(); ?>
        <a href="<?php echo Config::get('URL');?>blog/create" class="btn btn-primary btn-xs pull-right" style="margin:8px 8px 0px 0px">Skapa ny blogg</a>
    <div class="panel panel-default">
        <div class="panel-heading">Dina bloggar</div>
        <table class="table table-hover table-striped">
            <tbody>
            <?php if(!empty($this->listblogs)){
            foreach($this->listblogs as $key => $value){ ?>
                <tr>
                    <td>
                        <a href="#"><i class="<? if($value->visible == 1){ echo '-alt fa fa-2x fa-eye fa-fw'; } else { echo 'fa fa-2x fa-fw fa-eye-slash'; } ?>"></i></a>
                    </td>
                    <td>
                        <h4>
                            <b><?= $value->title; ?></b>
                        </h4>
                        <p style="max-width: 80%"><?= $value->description; ?></p>

                    </td>
                    <td></td><td></td>
                    <td>109 Inlägg</td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo Config::get('URL');echo $value->slug;?>"><button class="btn btn-default" type="button"><i class="fa fa-fw fa-eye"></i>Visa</button></a>
                            <a href="<?php echo Config::get('URL');echo $value->slug;?>/manage"><button class="btn btn-default" type="button"><i class="fa fa-fw fa-cog"></i>Administrera</button></a>
                            <a href="<?php echo Config::get('URL');echo $value->slug;?>/delete"><button class="btn btn-default" type="button"><i class="fa fa-fw s fa-remove"></i>Ta bort</button></a>
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
</div>