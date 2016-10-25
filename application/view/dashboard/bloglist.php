<div class="container">
    <div class="row">
        <div class="panel panel-default">

            <table class="table table-hover table-striped">
                <tbody>
                <tr>
                    <th>Bloggnamn</th>
                    <th>beskrivning</th>
                    <th></th>
                </tr>

                <?php
                if(!empty($this->blogs)){
                    foreach($this->blogs as $key => $value){ ?>
                        <tr>
                            <td>
                            <h4>
                                <b><?= $value->title; ?></b>
                            </h4>
                            </td>
                            <td><p style="max-width: 80%"><?= $value->description; ?></p></td>
                            <td><a href="<?php echo Config::get('URL');echo $value->slug;?>"><button class="btn btn-default" type="button"><i class="fa fa-fw fa-eye"></i>Visa</button></a></td>
                        </tr>
                    <?php }
                }else{
                    echo "Finns inga Bloggar att visa";
                }

                ?>
                <!-- <a href="#"><i class="fa fa-2x"></i></a> -->
                </tbody>
            </table>

        </div>
        <?php $this->paginate->render(); ?>
    </div>
</div>
