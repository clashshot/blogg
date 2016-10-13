<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Lägga till moderatorer(email):</h2>
            </div>
            <div class="panel-body">
                <?php
                print "Dina nuvarande moderatorer:</br>";
                foreach ($this->mods as $mod){
                    ?>
                    Email: <?=$mod->user_email?> ID: <?=$mod->user_id?></br>
                    <?php
                }
                ?>
                </br>Lägg till mod:</br>
                <form method="post" action="<?php echo Config::get('URL'); echo $this->blog->slug; ?>/manage/addmod_action">
                    <input type="text" name="user_email" placeholder="email address (a real address)" required />
                    <input type="submit" value="lägg till" />
                </form>
                </br>Ta bort moderatorer:</br>
                <form method="post" action="<?php echo Config::get('URL'); echo $this->blog->slug; ?>/manage/removemod_action">
                    <input type="number" name="user_id" placeholder="ID" required />
                    <input type="submit" value="ta bort" />
                </form>
            </div>
        </div>
    </div>

</div>