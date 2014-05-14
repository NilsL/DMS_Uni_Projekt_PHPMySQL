<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    $this->load->view('header.php'); ?>

<div class = "container">
    <div class = "row">
        <div class = "col-lg-4">
            <fieldset>
                <legend><?php echo lang('deactivate_heading');?></legend>
                <p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

                <?php echo form_open("auth/deactivate/".$user->id);?>

                <div class = "form-group">
                    <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
                    <input type="radio" name="confirm" value="yes" checked="checked" />
                    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
                    <input type="radio" name="confirm" value="no" />
                </div>

                <?php echo form_hidden($csrf); ?>
                <?php echo form_hidden(array('id'=>$user->id)); ?>

                <button type = "submit" class = "btn btn-primary" name = "submit">
                    <span class = "glyphicon glyphicon-floppy-disk"></span> <?= lang('deactivate_submit_btn');?>
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
