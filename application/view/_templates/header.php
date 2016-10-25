<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php if(isset($this->blog)){ echo $this->blog->title.' - BlogNation';} else { echo 'BlogNation'; }?></title>
    <!-- META -->
    <meta charset="utf-8">
    <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->
    <link rel="icon" href="data:;base64,=">
    <!-- CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/cosmo/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>js/wysibb/theme/default/wbbtheme.css" />
    <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <?php if (View::checkForActiveController($filename, "blog")) { ?>
        <nav class="navbar navbar-fixed-top navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=Config::get('URL')?><?=$this->blog->slug?>"><?php if(isset($this->blog)){ echo $this->blog->title;} else { echo 'BlogNation'; }?></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            if(!empty($page = BlogModel::showPages($this->blog->id))){
                            foreach ($page as $key => $value){
                                echo '<li><a href='.Config::get('URL').$this->blog->slug.'/'.$value->slug.'>'.ucfirst($value->title).'</a></li>';
                            }
                            };
                        ?>
                            <li style="background:#37a1ff;"><a href="<?php echo Config::get('URL'); ?>">Startsida</a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->
    <?php } else { ?>
        <?php if (Session::userIsLoggedIn()) : ?>
        <nav class="navbar navbar-fixed-top navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo Config::get('URL'); ?>">Blog|Nation</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" class="navbar-link"><?php echo $_SESSION['user_name'] ?><span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <?php if(AdminModel::isAdmin()){?><li><a href="<?=Config::get('URL')?>admin">Admin panel</a></li><?php } ?>
                                <li><a href="<?php echo Config::get('URL'); ?>user/editAvatar">Ändra din avatar</a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>user/edituseremail">Ändra e-post</a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>user/changePassword">Ändra lösenord</a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>login/logout">Logga ut</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->
        <?php else: ?>
            <nav class="navbar navbar-fixed-top navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo Config::get('URL'); ?>">Blog|Nation</a>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo Config::get('URL'); ?>index/aboutus">Om oss</a></li>
                            <li><a href="<?php echo Config::get('URL'); ?>index/termsofservice">Användarvillkor</a></li>
                            <li><a href="<?php echo Config::get('URL'); ?>index/contact">Kontakt</a></li>
                        </ul>
                    </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
            </nav><!-- /.navbar -->
        <?php endif; ?>
    <?php } ?>


