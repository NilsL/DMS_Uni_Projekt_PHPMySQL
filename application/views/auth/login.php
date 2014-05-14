<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    $this->load->view('header.php'); ?>

<div class = "container">
    <?php if ($message) { ?>
        <div class = "row">
            <div class = "col-lg-12">
                <div class = "alert alert-success"><?= $message ?></div>
            </div>
        </div>
    <?php } ?>
    <div class = "row">
        <div class = "col-lg-4 col-lg-offset-4">
            <fieldset>
                <legend><?php echo lang('login_heading'); ?></legend>
                <p><?php echo lang('login_subheading'); ?></p>

                <?php echo form_open('auth/login', array('id' => 'inputLoginForm')); ?>
                <div class = "form-group">
                    <?php echo lang('login_identity_label', 'identity'); ?>
                    <?php echo form_input($identity); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('login_password_label', 'password'); ?>
                    <?php echo form_input($password); ?>
                </div>

                <div class = "checkbox">
                    <?php echo lang('login_remember_label', 'remember'); ?>
                    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                </div>
                <button type = "submit" class = "btn btn-primary"
                        name = "submit"><span class = "glyphicon glyphicon-log-in"></span> <?= lang('login_submit_btn'); ?>
                </button>
                </form>
                <a href = "forgot_password"><?php echo lang('login_forgot_password'); ?></a>
            </fieldset>
        </div>
    </div>
</div>
<!-- /.container -->

<!-- JavaScript -->
<script src = "<?= base_url(); ?>js/jquery-1.10.2.js"></script>
<script src = "<?= base_url(); ?>js/bootstrap.js"></script>
<script src = "<?= base_url(); ?>/js/bootstrapValidator.js"></script>
<script type = "application/javascript">
    $(document).ready(function () {
        $('#inputLoginForm').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                identity: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and can\'t be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and can\'t be empty'
                        }
                    }
                }
            }
        });
    });
</script>

</body>

</html>
