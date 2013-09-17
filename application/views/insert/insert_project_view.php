<div id="content">
   <div id="insert">
      <h1>Create Project</h1>

      <?php echo form_open('insert/insert_project', array('class' => 'insert', 'onsubmit' => 'return validateInsert()')); ?>

      <p>
         <?php
         echo form_label('Project Name: ', 'project_name');
         echo form_input(array(
            'id'          => 'project_name',
            'name'        => 'project_name',
            'placeholder' => 'Project Name',
            'onkeyup'     => 'validating(this)'
         ));
         echo "<span id='check_project_name' style= 'border-width: 0;color: red'></span>";

         echo br(1);

         echo form_label('Project Number: ', 'project_number');
         echo form_input(array(
            'id'          => 'project_number',
            'name'        => 'project_number',
            'placeholder' => 'Project Number',
            'onkeyup'     => 'validating(this)'
         ));
         echo "<span id='check_project_number' style= 'border-width: 0;color: red'></span>";
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