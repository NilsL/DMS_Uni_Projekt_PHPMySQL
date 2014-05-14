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
            <legend>Projekt hinzufügen</legend>
            <div class = "col-lg-6">
                <form role = "form" action = "<?= site_url(); ?>/projekt/save" id="inputProjectForm" method = "post">
                    <div class = "form-group">
                        <label for = "inputName">Name</label>
                        <input type = "text" class = "form-control" name = "inputName" id = "inputName"
                               placeholder = "Enter project name">
                    </div>
                    <div class = "form-group">
                        <label for = "inputNummer">Nummer</label>
                        <input type = "text" class = "form-control" name = "inputNummer" id = "inputNummer"
                               placeholder = "Enter project number">
                    </div>
                    <div class = "form-group">
                        <label for = "inputArt">Art des Projekts</label>
                        <select class = "form-control" name = "inputArt" id = "inputArt">
                            <option>Forschungsprojekt</option>
                            <option>Studentisches Projekt</option>
                            <option>Sonstiges</option>
                        </select>
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
        $('#inputProjectForm').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                inputName: {
                    validators: {
                        notEmpty: {
                            message: 'The name is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z_\. ]+$/,
                            message: 'The name can only consist of alphabetical, dot and underscore'
                        }
                    }
                },
                inputNummer: {
                    validators: {
                        notEmpty: {
                            message: 'The number is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'The number can only consist of numeric'
                        }
                    }
                }
            }
        });
    });
</script>

</body>

</html>
