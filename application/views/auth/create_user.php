<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    $this->load->view('header.php'); ?>

<div class = "container">
    <div class = "row">
        <div class = "col-lg-4">
            <fieldset>
                <legend><?php echo lang('create_user_heading');?></legend>
                <p><?php echo lang('create_user_subheading');?></p>

                <div id = "infoMessage"><?php echo $message; ?></div>

                <?php echo form_open("auth/create_user"); ?>

                <div class = "form-group">
                    <?php echo lang('create_user_fname_label', 'first_name'); ?> <br/>
                    <?php echo form_input($first_name); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_lname_label', 'last_name'); ?> <br/>
                    <?php echo form_input($last_name); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_company_label', 'company'); ?> <br/>
                    <?php echo form_input($company); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_email_label', 'email'); ?> <br/>
                    <?php echo form_input($email); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_phone_label', 'phone'); ?> <br/>
                    <?php echo form_input($phone); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_password_label', 'password'); ?> <br/>
                    <?php echo form_input($password); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> <br/>
                    <?php echo form_input($password_confirm); ?>
                </div>

                <button type = "submit" class = "btn btn-primary" name = "submit">
                    <span class = "glyphicon glyphicon-floppy-disk"></span> <?= lang('create_user_submit_btn'); ?>
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
