<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    $this->load->view('header.php'); ?>

<div class = "container">
    <?php if ($message) { ?>
        <div class = "row">
            <div class = "col-lg-12">
                <div class = "alert alert-success" id = "infoMessage"><?= $message ?></div>
            </div>
        </div>
    <?php } ?>
    <div class = "row">
        <div class = "col-lg-12">
            <fieldset>
                <legend><?php echo lang('index_heading');?></legend>
                <p><?php echo lang('index_subheading');?></p>

                <div id="infoMessage"><?php echo $message;?></div>

                <table class = "table table-hover" cellpadding=0 cellspacing=10>
                    <tr>
                        <th><?php echo lang('index_fname_th');?></th>
                        <th><?php echo lang('index_lname_th');?></th>
                        <th><?php echo lang('index_email_th');?></th>
                        <th><?php echo lang('index_groups_th');?></th>
                        <th><?php echo lang('index_status_th');?></th>
                        <th><?php echo lang('index_action_th');?></th>

                        <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user->first_name; ?></td>
                        <td><?php echo $user->last_name; ?></td>
                        <td><?php echo mailto($user->email, $user->email); ?></td>
                        <td><?php $i = 1;
                                foreach ($user->groups as $group) {
                                    $sep = ($i++ != count($user->groups)) ? ',' : '';
                                    echo anchor("auth/edit_group/" . $group->id, $group->name) . $sep;
                                } ?></td>
                        <td>
                            <div class = "btn-group">
                                <a class = "btn dropdown-toggle btn-xs btn-<?php echo ($user->active) ? 'success' : 'danger'; ?>"
                                   data-toggle = "dropdown" href = "#">
                                    <?php echo ($user->active) ? '<span class = "glyphicon glyphicon-info-sign"></span> Active' : '<span class = "glyphicon glyphicon-info-sign"></span> Disabled'; ?>
                                    <span class = "caret"></span>
                                </a>
                                <ul class = "dropdown-menu">
                                    <?php if ($user->active): ?>
                                        <li>
                                            <?php echo anchor("auth/deactivate/".$user->id, 'Deactivate'); ?>
                                        </li>
                                    <?php else: ?>
                                        <li>
                                            <?php echo anchor("auth/activate/". $user->id, 'Activate'); ?>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo anchor("auth/edit_user/".$user->id, '<span
                                    class = "glyphicon glyphicon-pencil"></span> Edit', 'class="btn btn-primary btn-xs"') ;?></td>
                    </tr>
                    <?php }; ?>
                </table>
                    <?php echo anchor('auth/create_user', '<span class = "glyphicon glyphicon-user"></span> New User', 'class="btn btn-primary"')?>
                    &nbsp;
                    <?php echo anchor('auth/create_group', '<span class = "glyphicon glyphicon-folder"></span> New Group', 'class="btn btn-default"')?>
            </fieldset>
        </div>
    </div>
</div>
<!-- /.container -->

<!-- JavaScript -->
<script src = "<?= base_url(); ?>js/jquery-1.10.2.js"></script>
<script src = "<?= base_url(); ?>js/bootstrap.js"></script>

</body>

</html>


