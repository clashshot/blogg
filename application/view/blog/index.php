<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="well">
                <?php
                foreach ($this->posts as $post) {
                    ?>
                    <div class="row text-center">
                        <h2><?=$post->title?></h2>
                        <div class="col-md-12">
                            <h4><?=$post->content?></h4>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="well">
                <div class="row">
                    <h2 class="text-center">Lorem Ipsum</h2>
                    <div class="col-md-12">
                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis magna magna. Morbi ultrices efficitur pharetra. Sed non porttitor urna. Mauris ut est tincidunt, faucibus lacus at, vehicula lorem. Maecenas pellentesque lobortis sem, quis mollis dui vestibulum eget. Sed maximus porttitor odio non sodales. In tempor eget massa quis egestas. Phasellus odio ante, maximus non erat in, consequat vulputate tortor. Etiam vehicula enim velit, in scelerisque eros porttitor at. Suspendisse egestas pulvinar metus, ac fermentum dui auctor non. Suspendisse gravida hendrerit nisi, vitae elementum turpis molestie in. Nulla elementum accumsan porttitor.</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="well">
                <?=$this->blog->description?>
            </div>
        </div>
    </div>

</div>
