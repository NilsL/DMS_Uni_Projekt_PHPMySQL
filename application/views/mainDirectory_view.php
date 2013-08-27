<div class="document">
	<h1>Main Directory</h1>


<?php
if (isset ( $all_documents )) {
	$this->table->set_heading ( 'Title', 'Classification', 'Project' );
	
	foreach ( $all_documents as $row ) {
		$atts = array (
				'width' => '800',
				'height' => '600',
				'scrollbars' => 'yes',
				'status' => 'yes',
				'resizable' => 'no',
				'screenx' => '0',
				'screeny' => '0' 
		);
		$this->table->add_row ( anchor_popup ( 'search/popup?doc_id='. $row->document_id, '<strong>' . $row->title . '</strong>', $atts ), $row->c_name, $row->p_name );
	}
	
	echo $this->table->generate ();
}
?>
</div>

