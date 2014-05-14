<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    $this->load->view('header.php'); ?>

<div class = "container">
    <div class = "row">
        <fieldset>
            <legend>Dokument finden</legend>
            <div class = "col-lg-3">
                <form role = "form" action = "<?= site_url(); ?>/dokument/find/1" id="inputTitleForm" method = "post">
                    <div class = "form-group">
                        <label for = "inputTitel">Titel</label>
                        <input type = "text" class = "form-control" name="inputTitel" id = "inputTitel" placeholder = "Enter title" />
                    </div>
                    <button type = "submit" class = "btn btn-primary"><span class = "glyphicon glyphicon-search"></span> Finden</button>
                </form>
            </div>

            <div class = "col-lg-3">
                <form role = "form" action = "<?= site_url(); ?>/dokument/find/2" method = "post">
                    <div class = "form-group">
                        <label for = "inputProjektId">Projekt</label>
                        <select class = "form-control" name = "inputProjektId" id = "inputProjektId">
                            <?php if (isset($projekte) && is_array($projekte)) {
                                foreach ($projekte as $projekt) { ?>
                                    <option value = "<?= $projekt->id; ?>"><?= $projekt->name; ?></option>
                                <?php
                                }
                            }?>
                        </select>
                    </div>
                    <button type = "submit" class = "btn btn-primary"><span class = "glyphicon glyphicon-search"></span> Finden</button>
                </form>
            </div>

            <div class = "col-lg-3">
                <form role = "form" action = "<?= site_url(); ?>/dokument/find/3" method = "post">
                    <div class = "form-group">
                        <label for = "inputAuthorId">Author</label>
                        <select class = "form-control" name = "inputAuthorId" id = "inputAuthorId">
                            <?php if (isset($authoren) && is_array($authoren)) {
                                foreach ($authoren as $author) { ?>
                                    <option value = "<?= $author->id; ?>"><?= $author->vorname . " " . $author->nachname; ?></option>
                                <?php
                                }
                            }?>
                        </select>
                    </div>
                    <button type = "submit" class = "btn btn-primary"><span class = "glyphicon glyphicon-search"></span> Finden</button>
                </form>
                </div>

            <div class = "col-lg-3">
                <form role = "form" action = "<?= site_url(); ?>/dokument/find/4" method = "post">
                    <div class = "form-group">
                        <label for = "inputKeywords">Keywords</label>
                        <input type = "text" class = "form-control" id = "inputKeywords" name= "inputKeywords" placeholder = "Enter keywords separated by return" data-role = "tagsinput" />
                    </div>
                    <button type = "submit" class = "btn btn-primary"><span class = "glyphicon glyphicon-search"></span> Finden</button>
                </form>
            </div>
            <!-- /.col-lg-6 -->
    </div>
    </fieldset>
</div>
</div>
<!-- /.container -->

<!-- JavaScript -->
<script src = "<?= base_url(); ?>/js/jquery-1.10.2.js"></script>
<script src = "<?= base_url(); ?>/js/bootstrap.js"></script>
<script src = "<?= base_url(); ?>/js/bootstrap-tagsinput.js"></script>
<script src = "<?= base_url(); ?>/js/bootstrapValidator.js"></script>
<script type = "application/javascript">
    $(document).ready(function () {
        $('#inputTitleForm').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                inputTitel: {
                    message: 'The title is not valid!',
                    validators: {
                        notEmpty: {
                            message: 'The username is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'The username can only consist of alphabetical, number, dot and underscore'
                        }
                    }
                }
            }
        });
    });
</script>

</body>

</html>
