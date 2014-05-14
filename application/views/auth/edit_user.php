<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    $this->load->view('header.php'); ?>

<div class = "container">
    <div class = "row">
        <div class = "col-lg-4">
            <fieldset>
                <legend><?php echo lang('edit_user_heading');?></legend>
                <p><?php echo lang('edit_user_subheading');?></p>

                <div id = "infoMessage"><?php echo $message; ?></div>

                <?php echo form_open(uri_string()); ?>

                <div class = "form-group">
                    <?php echo lang('edit_user_fname_label', 'first_name'); ?> <br/>
                    <?php echo form_input($first_name); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('edit_user_lname_label', 'last_name'); ?> <br/>
                    <?php echo form_input($last_name); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('edit_user_company_label', 'company'); ?> <br/>
                    <?php echo form_input($company); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('edit_user_phone_label', 'phone'); ?> <br/>
                    <?php echo form_input($phone); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('edit_user_password_label', 'password'); ?> <br/>
                    <?php echo form_input($password); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?><br/>
                    <?php echo form_input($password_confirm); ?>
                </div>

                <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                <?php foreach ($groups as $group): ?>
                    <label class = "checkbox">
                        <?php
                            $gID = $group['id'];
                            $checked = NULL;
                            $item = NULL;
                            foreach ($currentGroups as $grp) {
                                if ($gID == $grp->id) {
                                    $checked = ' checked="checked"';
                                    break;
                                }
                            }
                        ?>
                        <input type = "checkbox" name = "groups[]"
                               value = "<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                        <?php echo $group['name']; ?>
                    </label>
                <?php endforeach ?>

                <?php echo form_hidden('id', $user->id); ?>
                <?php echo form_hidden($csrf); ?>

                <button type = "submit" class = "btn btn-primary" name = "submit">
                    <span class = "glyphicon glyphicon-floppy-disk"></span> <?= lang('edit_user_submit_btn'); ?>
                </button>

                <?php echo form_close(); ?>
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
