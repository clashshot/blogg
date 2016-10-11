<div class="container">
    <h1>Blog/index</h1>
    <h1><?=$this->blog->title?></h1>
    <div class="box">
        <?=$this->blog->description?>
    </div>
    <div class="box">
        <?=$this->blog->about?>
    </div>
    <?php
    foreach ($this->posts as $post) {
        ?>
        <div class="row text-center">
            <h3><?=$post->title?></h3>
            <div class="col-md-12">
                <?=$post->content?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
