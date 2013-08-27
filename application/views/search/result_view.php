<div id="result">
   <h1><?= $documents->num_rows(); ?> Results...</h1>

   <?php
   // helper array for popup window details
   $atts = array(
      'width'      => '500',
      'height'     => '400',
      'scrollbars' => 'no',
      'screenx'    => '500',
      'screeny'    => '500'
   );

   echo anchor('search', 'New Search', array('id' => 'new-search'));
   echo br(2);

   // ausgabe der suchergebnisse
   foreach ($documents->result() as $document) {
      echo '<p>';
      echo anchor_popup('search/popup?doc_id=' . $document->id, '<strong>Titel: ' . $document->title . '</strong>', $atts);
      echo br(1);
      echo 'Author: ' . $document->author;
      echo br(1);
      echo 'Projekt: ' . $document->project;
      echo br(1);
      echo 'Klassifizierung: ' . $document->classification;
      echo '</p>';
      echo br(1);

   }
   ?>
</div>
