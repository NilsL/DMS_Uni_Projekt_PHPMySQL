<div id="popup">
   <h1><?= $document->title; ?></h1>
   <h5><?= 'Author: ' . $document->author . ', Projekt: ' . $document->project . ', ' . $document->classification; ?></h5>

   <div id="popup-abstract">
      <p>
         <?= $document->abstract; ?>
      </p>
   </div>

   <?php
   foreach ($files as $row) {
      echo anchor('popup/dl_file/' . $row->f_id, $row->f_name);
      echo nbs(1);
      echo 'MD5: ' . $row->f_md5;
      echo nbs(2);
   }
   ?>
</div>