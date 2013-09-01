<div id="popup">
    <?php
    echo '<h1>'. $document->title .'</h1>';
	echo '<p>';
	echo 'Classification: ' . $document->classification;
	echo br(1);
	echo 'Project: ' . $document->project;
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
	echo '</p>';
	?>
	
	<div id="popup-abstract">
	<p>
	<? echo 'Abstract: '. $document->abstract; echo br(1);?>
	</p>

   <p>
   <?php 
		foreach ($files->result() as $row) {
			echo anchor('search/dl_file/'.$row->f_id, $row->f_name);
			echo nbs(1);
			echo 'MD5: ' . $row->f_md5;
			echo nbs(2);
		}
	?>
   </p>
</div>