<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    $this->load->view('header.php'); ?>

<div class = "container">
    <div class = "row">
        <div class = "col-lg-4">
            <fieldset>
                <legend><?php echo lang('change_password_heading');?></legend>
                <p><?php echo lang('create_user_subheading');?></p>

                <div id="infoMessage"><?php echo $message; ?></div>

                <?php echo form_open("auth/change_password"); ?>

                <div class = "form-group">
                    <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
                    <?php echo form_input($old_password);?>
                </div>

                <div class = "form-group">
                    <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
                    <?php echo form_input($new_password);?>
                </div>

                <div class = "form-group">
                    <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                    <?php echo form_input($new_password_confirm);?>
                </div>

                <div class = "form-group">
                    <?php echo form_input($user_id);?>
                </div>

                <button type = "submit" class = "btn btn-primary" name = "submit">
                    <span class = "glyphicon glyphicon-floppy-disk"></span> <?= lang('change_password_submit_btn'); ?>
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
