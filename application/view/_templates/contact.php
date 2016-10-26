<div class="container">

    <div class="jumbotron jumbotron-sm">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <h1 class="h1">
                        Kontakt<small> -  Om du har några frågor, tveka inte att kontakta oss.</small></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <?php $this->renderFeedbackMessages(); ?>
            <div class="well well-sm">
                <form action="<?php echo Config::get('URL');?>index/contact_action" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Namn</label>
                                <input type="text" name="name" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="subject">
                                    E-post</label>
                                <input type="email" name="email" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="subject">
                                    Ämne</label>
                                <input type="text" name="subject" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Meddelande</label>
                                <textarea name="message" class="form-control" rows="9" cols="25" required ></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div id="recaptcha1"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Skicka</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>