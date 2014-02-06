<div id="content">
   <div id="insert">
      <h1>Create Classification</h1>

       <?php echo form_open('insert/validate_i_class', array('class' => 'insert', 'onsubmit' => 'return validateInsert()')); ?>

      <p>
         <?php
         echo form_label('Name: ', 'classification_name');
         echo form_input(array(
            'id'          => 'classification_name',
            'name'        => 'classification_name',
            'placeholder' => 'New Classification',
            'onkeyup'     => 'validating(this)'
         ));
         echo "<span id='check_classification_name' style= 'border-width: 0;color: red'></span>";
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