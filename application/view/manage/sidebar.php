<div class="col-md-3">
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href="<?php echo Config::get('URL');echo $value->slug;?>/manage"><span class="glyphicon glyphicon-folder-close"></span>Administration</a>
                </h4>
            </div>

                <div class="panel-body panel-nopadding">
                    <table class="nounderline table">
                        <tr>
                            <td>
                                <span class="glyphicon glyphicon-pencil text-primary"></span><a href="<?php echo Config::get('URL') . $this->blog->slug;?>/manage">Inlägg</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="glyphicon glyphicon-pencil text-primary"></span><a href="<?php echo Config::get('URL') . $this->blog->slug;?>/manage/pages">Sidor</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="glyphicon glyphicon-file text-info"></span><a href="<?php echo Config::get('URL') . $this->blog->slug;?>/manage/category">Kategori</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="glyphicon glyphicon-flash text-success"></span><a href="<?php echo Config::get('URL') . $this->blog->slug;?>/manage/mods">Hantera moderatorer</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="glyphicon glyphicon-pencil text-primary"></span><a href="<?php echo Config::get('URL') . $this->blog->slug;?>/manage/update">Uppdatera bloggen</a>
                            </td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>
</div>