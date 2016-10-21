<?php
$bbcode = new Golonka\BBCode\BBCodeParser;
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well">
                <h1 class="text-center"><?= $this->page->title;?></h1>
                <p class="text-center"><?= $this->user->user_name?></p>
                <div><?= $bbcode->parse($this->page->content)?></div>
            </div>
        </div>
        <?php include "sidebar.php"; ?>
    </div>
</div>
