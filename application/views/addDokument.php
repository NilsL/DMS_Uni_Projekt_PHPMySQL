<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "">
    <meta name = "author" content = "">

    <title>Dokumentenarchiv</title>

    <!-- Bootstrap core CSS -->
    <link href = "<?= base_url(); ?>css/bootstrap.css" rel = "stylesheet">

    <!-- Add custom CSS here -->
    <link href = "<?= base_url(); ?>css/bootstrapValidator.css" rel = "stylesheet">
    <style>
        body {
            margin-top: 60px;
        }
    </style>

</head>

<body>

<nav class = "navbar navbar-inverse navbar-fixed-top" role = "navigation">
    <div class = "container">
        <div class = "navbar-header">
            <button type = "button" class = "navbar-toggle" data-toggle = "collapse"
                    data-target = ".navbar-ex1-collapse">
                <span class = "sr-only">Toggle navigation</span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
            </button>
            <a class = "navbar-brand active" href = "<?= site_url(); ?>/">Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class = "collapse navbar-collapse navbar-ex1-collapse">
            <ul class = "nav navbar-nav">
                <li><a href = "<?= site_url(); ?>/home/searchDokument">Suchen</a></li>
                <li class = "dropdown">
                    <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Hinzufügen <b class = "caret"></b></a>
                    <ul class = "dropdown-menu">
                        <li><a href = "<?= site_url(); ?>/home/addDokument">Dokument </a></li>
                        <li><a href = "<?= site_url(); ?>/home/addProjekt">Projekt </a></li>
                        <li><a href = "<?= site_url(); ?>/home/addAuthor">Author </a></li>
                    </ul>
                </li>
                <li><a href = "http://about.me/nlutz" target = "_blank">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><p class="navbar-text">Signed is as <a href = "<?= site_url(); ?>/auth" class="navbar-link"><strong><?= $user_info->username ?></strong></a></p></li>
                <li><a href = "<?= site_url(); ?>/auth/logout" class="navbar-link"><span class = "glyphicon glyphicon-off"></span> Logout</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<div class = "container">
    <?php if (isset($message)) { ?>
        <div class = "row">
            <div class = "col-lg-12">
                <div class = "alert alert-success"><?= $message ?></div>
            </div>
        </div>
    <?php } ?>
    <?php if (isset($error)) { ?>
        <div class = "row">
            <div class = "col-lg-12">
                <div class = "alert alert-danger"><?= $error ?></div>
            </div>
        </div>
    <?php } ?>
    <div class = "row">
        <fieldset>
            <legend>Dokument hinzufügen</legend>
            <div class = "col-lg-6">
                <form role = "form" action = "<?= site_url(); ?>/dokument/save" id="inputDocumentForm" method = "post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class = "form-group">
                        <label for = "inputTitel">Titel</label>
                        <input type = "text" class = "form-control" name = "inputTitel" id = "inputTitel"
                               placeholder = "Enter title">
                    </div>
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
                    <div class = "form-group">
                        <label for = "inputKeywords">Keywords</label>
                        <input type = "text" class = "form-control" name = "inputKeywords" id = "inputKeywords"
                               placeholder = "Enter keywords comma separated">
                    </div>
                    <div class = "form-group">
                        <label for = "inputAbstrakt">Abstrakt</label>
                        <textarea class = "form-control" name = "inputAbstrakt" id = "inputAbstrakt" rows = "3"
                                  placeholder = "Enter abstract"></textarea>
                    </div>
                    <div class = "form-group">
                        <label for = "inputDatei">Datei upload</label>
                        <input type = "file" name = "inputDatei" id = "inputDatei">
                    </div>
                    <button type = "submit" class = "btn btn-primary"><span class = "glyphicon glyphicon-floppy-disk"></span> Speichern</button>
                </form>
            </div>
            <!-- /.col-lg-6 -->
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
        $('#inputDocumentForm').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                inputTitel: {
                    validators: {
                        notEmpty: {
                            message: 'The title is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z_\. ]+$/,
                            message: 'The title can only consist of alphabetical'
                        }
                    }
                },
                inputKeywords: {
                    validators: {
                        notEmpty: {
                            message: 'The keywords are required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ,]+$/,
                            message: 'The keywords can only consist of alphabetical'
                        }
                    }
                },
                inputAbstrakt: {
                    validators: {
                        notEmpty: {
                            message: 'The abstract is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ,\.]+$/,
                            message: 'The abstract can only consist of alphabetical'
                        }
                    }
                },
                inputDatei: {
                    validators: {
                        notEmpty: {
                            message: 'The file is required and can\'t be empty'
                        }
                    }
                }
            }
        });
    });
</script>

</body>

</html>
