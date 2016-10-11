<?php
$title = Session::get('title');
$description = Session::get('description');
$about = Session::get('about');
Session::set('title', null);
Session::set('description', null);
Session::set('about', null);

?>

<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <form method="post" action="<?php echo Config::get('URL'); ?>blog/blog_create">
        <div class = "form-group">
            <input type = "text"  name ="blogname" class="form-control" required placeholder="Här skriver du ditt bloggnamn">
        </div>
        <div class = "form-group">
            <input type="text" name="title" class="form-control" <?php if(isset($title))echo 'value="' . $title . '"';?> required placeholder="Här skriver du in din titel">
        </div>
        <div class = "form-group">
            <input type="text" name="description" class="form-control" <?php if(isset($description)) echo 'value="' . $description . '"';?> required placeholder="Skriv en beskriving om bloggen">
        </div>
        <div class = "form-group">
        <textarea name="about" class="form-control" required placeholder="Skriv något om dig själv"><?php if(isset($about)) echo $about;?></textarea>
            </div>
        <input type="submit" value="Skapa blogg" class ="btn btn-primary"/>


    </form>


</div>