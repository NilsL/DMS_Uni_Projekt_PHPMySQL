<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    $this->load->view('header.php'); ?>

<div class = "container">
    <?php if (isset($message)) { ?>
        <div class = "row">
            <div class = "col-lg-12">
                <div class = "alert alert-success"><?= $message ?></div>
            </div>
        </div>
    <?php } ?>
    <div class = "row">
        <fieldset>
            <legend>Author hinzufügen</legend>
            <div class = "col-lg-6">
                <form role = "form" action = "<?= site_url(); ?>/author/save" id="inputAuthorForm" method = "post">
                    <div class = "form-group">
                        <label for = "inputVorname">Vorname</label>
                        <input type = "text" class = "form-control" name = "inputVorname" id = "inputVorname"
                               placeholder = "Enter first name">
                    </div>
                    <div class = "form-group">
                        <label for = "inputNachname">Nachname</label>
                        <input type = "text" class = "form-control" name = "inputNachname" id = "inputNachname"
                               placeholder = "Enter last name">
                    </div>
                    <div class = "form-group">
                        <label for = "inputEmail">Email Adresse</label>
                        <input type = "email" class = "form-control" name = "inputEmail" id = "inputEmail"
                               placeholder = "Enter email">
                    </div>
                    <button type = "submit" class = "btn btn-primary"><span class = "glyphicon glyphicon-floppy-disk"></span> Speichern</button>
                </form>
            </div>
        </fieldset>
    </div>
</div>
<!-- /.container -->

<!-- JavaScript -->
<script src = "<?= base_url(); ?>/js/jquery-1.10.2.js"></script>
<script src = "<?= base_url(); ?>/js/bootstrap.js"></script>
<script src = "<?= base_url(); ?>/js/bootstrapValidator.js"></script>
<script type = "application/javascript">
    $(document).ready(function () {
        $('#inputAuthorForm').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                inputVorname: {
                    validators: {
                        notEmpty: {
                            message: 'The first name is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z]+$/,
                            message: 'The first name can only consist of alphabetical'
                        }
                    }
                },
                inputNachname: {
                    validators: {
                        notEmpty: {
                            message: 'The last name is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z]+$/,
                            message: 'The last can only consist of alphabetical'
                        }
                    }
                },
                inputEmail: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and can\'t be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                }
            }
        });
    });
</script>

</body>

</html>
