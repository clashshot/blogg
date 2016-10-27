<div class="container">
    <div class="col-md-8">
        <div class="well">
            <h2>Välkommen till <b>Blog|Nation</b></h2>
            <br/>
            <h4><span class="glyphicon glyphicon-pencil"></span> <b>Samla dina bloggar</b> på ett enkelt och smidigt sätt.</h4>
            <br/>
            <h4><span class="glyphicon glyphicon-comment"></span> <b>Kommentera</b> på intressanta inlägg.</h4>
            <br/>
            <h4><span class="glyphicon glyphicon-heart"></span> <b>Favoritmarkera inlägg</b> för lättare åtkomst.</h4>
            <br/>
            <h4><span class="glyphicon glyphicon-user"></span> <b>Gör dina kompisar till moderatorer</b> på din blogg.</h4>
            <br/>
            <h4><span class="glyphicon glyphicon-picture"></span> <b>Länka till</b> dina favoritbilder eller gifs.</h4>
        </div>
    </div>
    <div class="col-md-4">
        <?php $this->renderFeedbackMessages(); ?>

        <div class="panel panel-default" id="login">
            <div class="panel-heading"><h3 class="panel-title"><strong>Logga in </strong></h3>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#" onClick="$('#login').hide('fast'); $('#resetpassword').show('fast');">Glömt lösenordet?</a></div>
            </div>

            <div class="panel-body" id="login">
                <form action="<?php echo Config::get('URL'); ?>login/login" method="post">

                    <div style="margin-bottom: 12px" class="input-group">
                        <span class="input-group-addon inputpaddfix"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="user_name" value="" placeholder="Användarnamn eller e-post">
                    </div>

                    <div style="margin-bottom: 12px" class="input-group">
                        <span class="input-group-addon inputpaddfix"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="user_password" placeholder="Lösenord">
                    </div>

                    <div class="input-group">
                        <div class="checkbox" style="margin-top: 0px;">
                            <label>
                                <input id="login-remember" type="checkbox" name="set_remember_me_cookie"> Kom ihåg mig
                            </label>
                        </div>
                    </div>

                    <?php if (!empty($this->redirect)) { ?>
                        <input type="hidden" name="redirect" value="<?php echo $this->encodeHTML($this->redirect); ?>" />
                    <?php } ?>
                    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>" />

                    <button type="submit" class="btn btn-success">Logga in</button>

                    <hr style="margin-top:10px;margin-bottom:10px;" >

                    <div class="form-group">

                        <div style="font-size:85%">
                            Har du inget konto än?
                            <a href="#" onClick="$('#showregister').toggle('fast')">
                                Registera dig här
                            </a>
                        </div>

                    </div>
                </form>

            </div>
        </div>

        <div class="panel panel-default" id="resetpassword" style="display: none">
            <div class="panel-heading"><h3 class="panel-title"><strong>Återställ ditt lösenord </strong></h3>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#" onClick="$('#resetpassword').hide('fast'); $('#login').show('fast');">Logga in?</a></div>
            </div>

            <div class="panel-body">
                <form method="post" action="<?php echo Config::get('URL'); ?>login/requestPasswordReset_action">

                    <div style="margin-bottom: 12px" class="input-group">
                        <span class="input-group-addon inputpaddfix"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="user_name_or_email" value="" placeholder="Användarnamn eller e-post">
                    </div>
                    <div class="form-group">
                        <div id="recaptcha1"></div>
                    </div>
                    <button type="submit" class="btn btn-success">Återställ</button>

                </form>

            </div>
        </div>

        <div class="panel panel-default" id="showregister" style="display:none;">
            <div class="panel-heading"><h3 class="panel-title"><strong>Registrera dig </strong></h3></div>

            <div class="panel-body">
                <form method="post" action="<?php echo Config::get('URL'); ?>register/register_action">

                    <div style="margin-bottom: 12px" class="input-group">
                        <span class="input-group-addon inputpaddfix"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="user_name" value="" placeholder="Användarnamn">
                    </div>

                    <div style="margin-bottom: 12px" class="input-group">
                        <span class="input-group-addon inputpaddfix"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="login-username" type="email" class="form-control" name="user_email" value="" placeholder="E-post">
                    </div>

                    <div style="margin-bottom: 12px" class="input-group">
                        <span class="input-group-addon inputpaddfix"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="login-username" type="email" class="form-control" name="user_email_repeat" value="" placeholder="Repetera e-post">
                    </div>

                    <div style="margin-bottom: 12px" class="input-group">
                        <span class="input-group-addon inputpaddfix"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="user_password_new" placeholder="Lösenord">
                    </div>

                    <div style="margin-bottom: 12px" class="input-group">
                        <span class="input-group-addon inputpaddfix"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="user_password_repeat" placeholder="Repetera lösenordet">
                    </div>

                    <div class="form-group">
                        <div id="recaptcha2"></div>
                    </div>

                    <button type="submit" class="btn btn-success">Registrera</button>

                </form>
            </div>
        </div>


    </div>
</div>
