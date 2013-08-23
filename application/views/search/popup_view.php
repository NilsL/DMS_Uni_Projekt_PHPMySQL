<div id="popup">
   <h1><?= $document->title; ?></h1>
   <h5><?= 'Author: ' . $document->author . ', Projekt: ' . $document->project . ', ' . $document->classification; ?></h5>

   <div id="popup-abstract">
      <p>
         <?= $document->abstract; ?>
      </p>
   </div>

   <?= anchor('PFAD_ZUM_DL_FILE', 'Gesamtes Dokument'); ?>
</div>