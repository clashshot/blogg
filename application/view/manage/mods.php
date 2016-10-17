<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Dina moderatorer:</h2>
            </div>
            <div class="panel-body">


                <table class="table">
                    <thead>
                    <tr>
                        <th>E-mail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->mods as $mod) {
                        ?>
                        <tr>
                            <td>
                                <?= $mod->user_email ?>
                            </td>
                            <td>
                                <button type="button" onclick="removemod(this,<?=$this->blog->id?>, <?= $mod->user_id ?>)"
                                        class="btn btn-primary">ta bort
                                </button>
                            </td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
                Lägg till mod:</br>
                <form method="post" action="<?php echo Config::get('URL'); echo $this->blog->slug; ?>/manage/addmod_action">
                    <input type="text" class="form-control" name="user_email" placeholder="email address (a real address)" required />
                    <input type="submit" class="btn btn-primary" value="lägg till" />
                </form>

            </div>
        </div>
    </div>

</div>
<?php
echo $_SERVER['HTTP_USER_AGENT'];
echo "</br>";
echo $_SERVER['REMOTE_ADDR'];
echo "</br>";
echo $_SERVER['HTTP_REFERER'];
echo "</br>";
echo $_SERVER['HTTP_X_FORWARDED_FOR'];
?>


