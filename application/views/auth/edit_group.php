<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    $this->load->view('header.php'); ?>

<div class = "container">
    <div class = "row">
        <div class = "col-lg-4">
            <fieldset>
                <legend><?php echo lang('edit_group_heading');?></legend>
                <p><?php echo lang('edit_group_subheading');?></p>

                <div id = "infoMessage"><?php echo $message; ?></div>

                <?php echo form_open(current_url());?>

                <div class = "form-group">
                    <?php echo lang('create_group_name_label', 'group_name');?> <br />
                    <?php echo form_input($group_name);?>
                </div>

                <div class = "form-group">
                    <?php echo lang('edit_group_desc_label', 'description');?> <br />
                    <?php echo form_input($group_description);?>
                </div>

                <button type = "submit" class = "btn btn-primary" name = "submit">
                    <span class = "glyphicon glyphicon-floppy-disk"></span> <?= lang('edit_group_submit_btn'); ?>
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
