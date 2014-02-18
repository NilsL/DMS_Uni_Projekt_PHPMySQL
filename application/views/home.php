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
        <div class = "col-lg-12">
            <fieldset>
                <legend>Dokumente</legend>
                <table class = "table table-hover">
                    <tr>
                        <th class = "text-center"><strong>#</strong></th>
                        <th><strong>Titel</strong></th>
                        <th><strong>Projekt</strong></th>
                        <th><strong>Art</strong></th>
                        <th><strong>Aktion</strong></th>
                        <?php if (isset($dokumente) && is_array($dokumente)) {
                            foreach ($dokumente as $dokument){
                        ?>
                    <tr>
                        <td class = "text-center"><?= $dokument->id; ?></td>
                        <td><?= $dokument->titel; ?></td>
                        <td><?= $dokument->projekt; ?></td>
                        <td><?= $dokument->art; ?></td>
                        <td>
                            <a href = "<?= site_url() . '/dokument/open/' . $dokument->id; ?>" role = "button" class = "btn btn-xs btn-primary" data-toggle = "modal" data-target = "#modal">
                                <span class = "glyphicon glyphicon-eye-open"></span> Anzeigen</a>
                            <a href = "<?= site_url() . '/dokument/delete/' . $dokument->id; ?>" role = "button" class = "btn btn-xs btn-danger">
                                <span class = "glyphicon glyphicon-trash"></span> Löschen</a>
                        </td>
                    </tr>
                    <?php  }
                        }?>
                    </tr>
                </table>
            </fieldset>
        </div>
    </div>
</div>
<!-- /.container -->

<!-- Modal -->
<div id = "modal" class = "modal fade">
    <div class = "modal-dialog">
        <div class = "modal-content">
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src = "<?= base_url(); ?>js/jquery-1.10.2.js"></script>
<script src = "<?= base_url(); ?>js/bootstrap.js"></script>
<script src = "<?= base_url(); ?>js/custom.js"></script>

</body>

</html>
