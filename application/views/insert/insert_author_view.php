<div id="content">
	<div id="insert">
		<h1>Create Author</h1>

      <?php echo form_open('insert/validate_i_author', array('class' => 'login')); ?>

   <p>
      <?php
     		$this->table->add_row(form_label ( 'Name: ', 'i_author_name' ), form_input ( array (
					'id' => 'i_author_name',
					'name' => 'i_author_name',
					'placeholder' => 'New Author' 
			) ));
     		
     		$this->table->add_row(form_label ( 'Email: ', 'i_author_mail'),form_input( array (
					'id' => 'i_author_mail',
					'name' => 'i_author_mail',
					'placeholder' => 'Emailadress'			
			)));
     		
     		echo $this->table->generate();
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