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
    <link href = "<?= base_url(); ?>css/bootstrap-tagsinput.css" rel = "stylesheet">
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
