<div class="container-fluid">

    <?php
    include 'sidebar.php';
    Session::get('user_id');
    ?>

    <div class="col-md-9">
        <?php $this->renderFeedbackMessages(); ?>
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <h1>Admin/index</h1>
                    </h4>
                </div>
                <div class="panel-body panel-nopadding">
                    <div>
                        <table class="overview-table">
                            <thead>
                            <tr>
                                <td>Id</td>
                                <td>Avatar</td>
                                <td>Username</td>
                                <td>User's email</td>
                                <td>Activated ?</td>
                                <td>Link to user's profile</td>
                                <td>suspension Time in days</td>
                                <td>Day when suspension ends</td>
                                <td>Soft delete</td>
                                <td>Submit</td>
                            </tr>
                            </thead>
                            <?php foreach ($this->users as $user) { ?>
                                <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'active'); ?>">
                                    <td><?= $user->user_id; ?></td>
                                    <td class="avatar">
                                        <?php if (isset($user->user_avatar_link)) { ?>
                                            <img src="<?= $user->user_avatar_link; ?>" height="80px" width="80px"/>
                                        <?php } ?>
                                    </td>
                                    <td><?= $user->user_name; ?></td>
                                    <td><?= $user->user_email; ?></td>
                                    <td><?= ($user->user_active == 0 ? 'No' : 'Yes'); ?></td>
                                    <td>
                                        <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>">Profile</a>
                                    </td>
                                    <form action="<?= config::get("URL"); ?>admin/actionAccountSettings" method="post">
                                        <td><input type="number" name="suspension"/></td>
                                        <td>
                                            <?php
                                            if (isset($user->user_suspension_timestamp)) {
                                                echo date('d-m-Y h:i A', $user->user_suspension_timestamp);
                                            }
                                            ?>
                                        </td>
                                        <td><input type="checkbox"
                                                   name="softDelete" <?php if ($user->user_deleted) { ?> checked <?php } ?> />
                                        </td>
                                        <td>
                                            <input type="hidden" name="user_id" value="<?= $user->user_id; ?>"/>
                                            <input type="submit"/>
                                        </td>
                                    </form>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>