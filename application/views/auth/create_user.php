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
    <div class = "row">
        <div class = "col-lg-4">
            <fieldset>
                <legend><?php echo lang('create_user_heading');?></legend>
                <p><?php echo lang('create_user_subheading');?></p>

                <div id = "infoMessage"><?php echo $message; ?></div>

                <?php echo form_open("auth/create_user"); ?>

                <div class = "form-group">
                    <?php echo lang('create_user_fname_label', 'first_name'); ?> <br/>
                    <?php echo form_input($first_name); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_lname_label', 'last_name'); ?> <br/>
                    <?php echo form_input($last_name); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_company_label', 'company'); ?> <br/>
                    <?php echo form_input($company); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_email_label', 'email'); ?> <br/>
                    <?php echo form_input($email); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_phone_label', 'phone'); ?> <br/>
                    <?php echo form_input($phone); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_password_label', 'password'); ?> <br/>
                    <?php echo form_input($password); ?>
                </div>

                <div class = "form-group">
                    <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> <br/>
                    <?php echo form_input($password_confirm); ?>
                </div>

                <button type = "submit" class = "btn btn-primary" name = "submit">
                    <span class = "glyphicon glyphicon-floppy-disk"></span> <?= lang('create_user_submit_btn'); ?>
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
