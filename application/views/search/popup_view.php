<div id="popup">
   <h1><?= $document->title; ?></h1>
   <?php 
	echo '<p>';
	echo 'Classification: ' . $document->classification;
	echo br(1);
	echo 'Project: ' . $document->project;
	echo br(1);
	//authors bedarf ja mehr platz
	echo 'Authors: ';
	foreach ($authors->result() as $row) {
		echo $row->a_name;
		echo nbs(2);
	}
	echo br(1);
	
	//das gleiche betrifft keywords
	echo 'Keywords: ';
	foreach ($keywords->result() as $row) {
		echo $row->k_name.",";
		echo nbs(2);
	}
	echo br(1);
	echo '</p>';
	?>
	
	<div id="popup-abstract">
	<p>
	<? echo 'Abstract: '. $document->abstract; echo br(1);?>
	</p>
	 
   <?php 
		foreach ($files->result() as $row) {
			echo anchor('search/dl_file/'.$row->f_id, $row->f_name);
			echo nbs(1);
			echo 'MD5: $row->f_md5';
			echo nbs(2);
		}
	?>
</div>