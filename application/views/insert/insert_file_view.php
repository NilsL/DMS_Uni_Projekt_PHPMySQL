<div id="content">
<div id="insert">
<h1>Add Attachment</h1>

      <?php echo form_open_multipart('insert/validate_i_file', array('class' => 'login')); ?>

   <p>
      <?php
	        //projekt eingabefeld
      		echo form_label('Document: ', 'document');
      		$data = array(
      				'name'        => 'input_document_projects',
      				'id'          => 'document',
      				'style'       => 'width: 330px',
      				'onkeyup'     => 'javascript:showHint(this)',
      		);
      		echo form_input($data);
      		echo br(1);
      		echo form_label('Documentauswahl: ', 'document');
      		$attributes = 'id="documents" size="1" style=" width: 330px;" onclick="javascript:putSelected(this)"';
      		echo form_dropdown('documents', $documents, array(), $attributes);
      		echo br(1);
      		
			echo form_label('File: ', 'file');
			echo form_upload ( array ('id' => 'input_file', 'name' => 'input_file'));
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