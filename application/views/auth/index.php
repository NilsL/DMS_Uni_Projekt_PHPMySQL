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
    <?php if ($message) { ?>
        <div class = "row">
            <div class = "col-lg-12">
                <div class = "alert alert-success" id = "infoMessage"><?= $message ?></div>
            </div>
        </div>
    <?php } ?>
    <div class = "row">
        <div class = "col-lg-12">
            <fieldset>
                <legend><?php echo lang('index_heading');?></legend>
                <p><?php echo lang('index_subheading');?></p>

                <div id="infoMessage"><?php echo $message;?></div>

                <table class = "table table-hover" cellpadding=0 cellspacing=10>
                    <tr>
                        <th><?php echo lang('index_fname_th');?></th>
                        <th><?php echo lang('index_lname_th');?></th>
                        <th><?php echo lang('index_email_th');?></th>
                        <th><?php echo lang('index_groups_th');?></th>
                        <th><?php echo lang('index_status_th');?></th>
                        <th><?php echo lang('index_action_th');?></th>

                        <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user->first_name; ?></td>
                        <td><?php echo $user->last_name; ?></td>
                        <td><?php echo mailto($user->email, $user->email); ?></td>
                        <td><?php $i = 1;
                                foreach ($user->groups as $group) {
                                    $sep = ($i++ != count($user->groups)) ? ',' : '';
                                    echo anchor("auth/edit_group/" . $group->id, $group->name) . $sep;
                                } ?></td>
                        <td>
                            <div class = "btn-group">
                                <a class = "btn dropdown-toggle btn-xs btn-<?php echo ($user->active) ? 'success' : 'danger'; ?>"
                                   data-toggle = "dropdown" href = "#">
                                    <?php echo ($user->active) ? '<span class = "glyphicon glyphicon-info-sign"></span> Active' : '<span class = "glyphicon glyphicon-info-sign"></span> Disabled'; ?>
                                    <span class = "caret"></span>
                                </a>
                                <ul class = "dropdown-menu">
                                    <?php if ($user->active): ?>
                                        <li>
                                            <?php echo anchor("auth/deactivate/".$user->id, 'Deactivate'); ?>
                                        </li>
                                    <?php else: ?>
                                        <li>
                                            <?php echo anchor("auth/activate/". $user->id, 'Activate'); ?>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo anchor("auth/edit_user/".$user->id, '<span
                                    class = "glyphicon glyphicon-pencil"></span> Edit', 'class="btn btn-primary btn-xs"') ;?></td>
                    </tr>
                    <?php }; ?>
                </table>
                    <?php echo anchor('auth/create_user', '<span class = "glyphicon glyphicon-user"></span> New User', 'class="btn btn-primary"')?>
                    &nbsp;
                    <?php echo anchor('auth/create_group', '<span class = "glyphicon glyphicon-folder"></span> New Group', 'class="btn btn-default"')?>
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


