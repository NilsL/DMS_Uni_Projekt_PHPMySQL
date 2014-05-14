<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    $this->load->view('header.php'); ?>

<div class = "container">
    <div class = "row">
        <div class = "col-lg-4">
            <fieldset>
                <legend><?php echo lang('forgot_password_heading');?></legend>
                <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

                <div id = "infoMessage"><?php echo $message; ?></div>

                <?php echo form_open('auth/forgot_password');?>

                <div class = "form-group">
                    <label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label> <br />
                    <?php echo form_input($email);?>
                </div>

                <button type = "submit" class = "btn btn-primary" name = "submit">
                    <span class = "glyphicon glyphicon-floppy-disk"></span> <?= lang('forgot_password_submit_btn'); ?>
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
