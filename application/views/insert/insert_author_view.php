<div id="content">
	<div id="insert">
		<h1>Create Author</h1>

      <?php echo form_open('insert/validate_i_author', array('class' => 'login')); ?>

   <p>
      <?php
     		echo form_label ( 'Name: ', 'input_author_name' );
     		echo form_input ( array (
					'id' => 'input_author_name',
					'name' => 'input_author_name',
					'placeholder' => 'New Author' 
			) );
     		
     		echo br(1);
     		
     		echo form_label ( 'Email: ', 'input_author_mail');
     		echo form_input( array (
					'id' => 'input_author_mail',
					'name' => 'input_author_mail',
					'placeholder' => 'Emailadress'			
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