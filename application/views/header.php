<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang = "de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Nils Lutz">
    <meta name="mail" content="mail.nlutz@gmail.com">
    <meta name="publisher" content="Jade Hochschule">
    <meta name="copyright" content="Nils Lutz/Jade Hochschule">
    <meta name="description" content="A document management system written in PHP and MySQL.Upload, search, tags are possible.">
    <meta name="keywords" content="php,mysql,dms,jade, hs,university,pdf,upload,search,tags,management,system,document">
    <meta name="page-topic" content="Bildung">
    <meta name="page-type" content="Katalog Verzeichnis">
    <meta name="audience" content="Studenten">
    <meta http-equiv="content-language" content="de">
    <meta name="robots" content="index, nofollow">
    <meta name="version" content="0.2">

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
                <li><a href = "http://www.jade-hs.de" target = "_blank">Jade Hochschule</a></li>
            </ul>
            <?php if ($this->ion_auth->logged_in()) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><p class="navbar-text">Signed is as <a href="<?= site_url(); ?>/auth" class="navbar-link">
                                <strong><?= $user_info->username ?></strong></a></p>
                    </li>
                    <li><a href="<?= site_url(); ?>/auth/logout" class="navbar-link"><span class="glyphicon glyphicon-off"></span> Logout</a>
                    </li>
                </ul>
            <?php } ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
