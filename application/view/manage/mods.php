<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Dina moderatorer:
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
                Lägg till mod (email eller användarnamn):</br>
                <form method="post" action="<?php echo Config::get('URL'); echo $this->blog->slug; ?>/manage/addmod_action">
                    <input type="text" class="form-control" name="user_identity" placeholder="Email eller användarnamn" required />
                    <input type="submit" class="btn btn-primary" value="lägg till" />
                </form>
            </div>
        </div>
    </div>
</div>

