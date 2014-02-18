<div class = "modal-header">
    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>
    <h4 class = "modal-title" id = "myModalLabel">Dokument details - <?= $dokument->art; ?></h4>
</div>
<div class = "modal-body" id= "modal-body">
    <p><strong>Titel: </strong><?= $dokument->titel; ?></p>

    <p><strong>Projekt: </strong><?= $dokument->projekt; ?></p>

    <p><strong>Author: </strong><?= $dokument->author_vorname . ' ' . $dokument->author_nachname; ?></p>

    <p><strong>Abstrakt: </strong><?= $dokument->abstrakt; ?></p>

    <p><strong>Datei: </strong><?= $dokument->dateipfad . $dokument->dateiname; ?></p>

    <p><strong>MD5: </strong><?= $dokument->md5; ?></p>
</div>
<div class = "modal-footer">
    <a href = "<?= site_url(); ?>/dokument/download/<?= $dokument->id; ?>" class = "btn btn-sm btn-primary">
        <span class = "glyphicon glyphicon-floppy-save"></span> Download</a>
    <a href = "#" class = "btn btn-sm btn-default" data-dismiss = "modal">
        <span class = "glyphicon glyphicon-remove"></span> Close</a>
</div>
