<div id="content">
   <div id="insert">
      <h1>Create Author</h1>

      <?php echo form_open('insert/insert_author', array('class' => 'login', 'onsubmit' => 'return validateInsert()')); ?>

      <p>
         <?php
         echo form_label('Name: ', 'author_name');
         echo form_input(array(
            'id'          => 'author_name',
            'name'        => 'author_name',
            'placeholder' => 'New Author',
            'onkeyup'     => 'validateInsertsWithDb(this)'
         ));
         echo "<span id='check_author_name' style= 'border-width: 0;color: red'></span>";
         echo br(1);

         echo form_label('Email: ', 'author_mail');
         echo form_input(array(
            'id'          => 'author_mail',
            'name'        => 'author_mail',
            'placeholder' => 'Emailadress',
            'onkeyup'     => 'validateInsertsWithDb(this)'
         ));
         echo "<span id='check_author_mail' style= 'border-width: 0;color: red'></span>";
         ?>
      </p>

      <p id="insert_submit">
         <?php echo form_button(array('class' => 'login-button', 'type' => 'submit', 'content' => 'submit')); ?>
      </p>

      <?php
      echo form_close();
      if (isset ($error)) {
         ?>
         <p class="error" id="insert_error"><?php echo $error; ?></p>
      <?php } ?>

      <?php echo validation_errors('<p class="error">'); ?>

   </div>
</div>