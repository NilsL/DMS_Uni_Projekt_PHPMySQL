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
