<div class="container-fluid">

    <?php include 'sidebar.php'; ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>
        <a href="<?php echo Config::get('URL');echo $value->slug;?>/manage/addpost" class="btn btn-primary btn-xs pull-right" style="margin:8px 8px 0px 0px">Skriv nytt inlägg</a>
        <div class="panel panel-default">
            <div class="panel-heading">Dina inlägg</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Synlighet</th>
                        <th>Skapade</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tr>
                        <td>1</td>
                        <td>News</td>
                        <td>News Cate</td>
                        <td class="text-center"><a class='btn btn-info btn-xs' href="#"><span class="glyphicon glyphicon-edit"></span> Ändra</a> <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Products</td>
                        <td>Main Products</td>
                        <td class="text-center"><a class='btn btn-info btn-xs' href="#"><span class="glyphicon glyphicon-edit"></span> Ändra</a> <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Blogs</td>
                        <td>Parent Blogs</td>
                        <td class="text-center"><a class='btn btn-info btn-xs' href="#"><span class="glyphicon glyphicon-edit"></span> Ändra</a> <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

</div>