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
      echo 'Author: ' . $document->author;
      echo br(1);

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
            echo 'Filename: ' . anchor('search/dl_file/' . $document->file_id, $document->file_name);
            echo br(1);
            echo 'MD5: ' . $document->file_md5;
            echo br(2);
      ?>
   </p>