<div id="content">
<div id="insert">
<h1>Add Attachment</h1>

      <?php echo form_open_multipart('insert/validate_i_file', array('class' => 'login')); ?>

   <p>
      <?php
	        //projekt eingabefeld
      		echo form_label('Project: ', 'project');
      		$data = array(
      				'name'        => 'i_document_projects',
      				'id'          => 'i_document_projects',
      				'style'       => 'width: 330px',
      				'onkeyup'     => 'javascript:showHint(this.value)',
      		);
      		echo form_input($data);
      		$data = 'size="6" style="display: none; width: 330px;" onclick="javascript:putSelected()"';
      		echo form_dropdown('projects', $all_p, 0, $data);
      		
			echo form_label('File: ', 'file');
			echo form_upload ( array ('id' => 'i_file', 'name' => 'i_file'));
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