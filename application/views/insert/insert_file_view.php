<div id="content">
<div id="insert">
<h1>Add Attachment</h1>

      <?php echo form_open_multipart('insert/validate_i_file', array('class' => 'login')); ?>

   <p>
      <?php
	      $data = array(
	      		'name'        => 'filename',
	      		'id'          => 'i_file',
	      		'style'       => 'width: 330px',
	      		'onfocus'     => "showDivStation(this, true,'documents')",
	      		'onclick'     => "removeNull(this)",
	      		'onkeyup'     => "similarFind(this,'documents')",
	      		'value'       => '--no choice--',
	      );
	      $inputtext = form_input($data);
	      $options1 = array(0 => '--no choice--');
			if(isset($all_d)) {
      			foreach ($all_d as $row) {
					$options1[$row->document_id] = $row->title;
				}
      		}
      		$data = 'size="6" style="display: none; width: 330px;" onclick="selectStation(this, '."'documents'".')"';
      		$documents = form_dropdown('documents', $options1, 0, $data);
      		$inputplusdocuments = $inputtext.br(1).$documents;
      		$this->table->add_row(array('To Document: ', $inputplusdocuments));
      		
			$this->table->add_row(array('File: ', form_upload ( array ('id' => 'i_file', 'name' => 'i_file') )));
			
			echo $this->table->generate();
			?>
   </p>
   
   <p id="insert_submit">
      <?php echo form_submit('add_file', 'Add File'); ?>
   </p>
   
   <?php
			echo form_close ();
			if (isset ( $error )) {
				?>
         <p class="error" id="insert_error"><?php echo $error; ?></p>
    <?php } ?>
    
    <?php echo validation_errors('<p class="error">'); ?>
      
   </div>
</div>