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
    <link href = "<?= base_url(); ?>css/bootstrapValidator.css" rel = "stylesheet">

    <!-- Add custom CSS here -->
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
