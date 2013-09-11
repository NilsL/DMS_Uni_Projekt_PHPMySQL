<div id="popup">

   <h1><?= $document->title; ?></h1>

   <p>
      <?php
      echo 'Classification: ' . $document->classification;
      echo br(1);
      echo 'Project: ' . $document->project;
      echo br(1);
      echo 'Created: ' . mdate("%d-%m-%Y", $document->created);
      echo br(1);
      echo 'Last edited: ' . mdate("%d-%m-%Y", $document->last_edited);
      echo br(1);

      //authors bedarf ja mehr platz
      echo 'Authors: ';
      foreach ($authors->result() as $row) {
         if ($authors->num_rows() == 1) {
            echo $row->author_name;
            break;
         }
         echo $row->author_name . ', ';
      }
      echo br(1);

      //das gleiche betrifft keywords
      echo 'Keywords: ';
      foreach ($keywords->result() as $row) {
         if ($keywords->num_rows() == 1) {
            echo $row->keyword_name;
            break;
         }
         echo $row->keyword_name . ', ';
      }
      echo br(1);
      ?>
   </p>

   <p>
      <?php
      echo 'Abstract: ' . $document->abstract;
      echo br(1);
      ?>
   </p>

   <p>
      <?php
      if ($files) {
         foreach ($files->result() as $row) {
            echo anchor('search/dl_file/' . $row->f_id, $row->f_name);
            echo br(1);
            echo 'MD5: ' . $row->f_md5;
            echo br(2);
         }
      }
      ?>
   </p>