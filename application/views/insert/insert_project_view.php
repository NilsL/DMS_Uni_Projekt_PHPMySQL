<div id="content">
<div id="insert">
<h1>Create Project</h1>

      <?php echo form_open('insert/validate_i_project', array('class' => 'login')); ?>

   <p>
      <?php
      		echo form_label ( 'Project Name: ', 'i_project_name' );
      		echo form_input ( array (
					'id' => 'i_project_name',
					'name' => 'i_project_name',
					'placeholder' => 'Project Name' 
			) );
			echo form_label ( 'Project Number: ', 'i_project_number');
			echo form_input( array (
					'id' => 'i_project_number',
					'name' => 'i_project_number',
					'placeholder' => 'Project Number'			
			));
			?>
   </p>
   
   <p id="insert_submit">
      <?php echo form_button(array('class' => 'login-button', 'type' => 'submit', 'content' => 'submit')); ?>
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