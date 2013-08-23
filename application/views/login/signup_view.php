<div id="signup">
   <h1>Create an Account</h1>

   <legend>Personal Information</legend>

   <?php echo form_open('login/validate_signup', array('class' => 'signup')); ?>
   <p>
      <?php echo form_label('First Name: ', 'first_name'); ?>
      <?php echo form_input(array('id' => 'first_name', 'name' => 'first_name', 'placeholder' => 'Jon')); ?>
   </p>

   <p>
      <?php echo form_label('Last Name: ', 'last_name'); ?>
      <?php echo form_input(array('id' => 'last_name', 'name' => 'last_name', 'placeholder' => 'Doe')); ?>
   </p>

   <p>
      <?php echo form_label('Email: ', 'email'); ?>
      <?php echo form_input(array('id' => 'email', 'name' => 'email', 'placeholder' => 'jondoe@jondoe.com')); ?>
   </p>

   <legend>Login Info</legend>

   <p>
      <?php echo form_label('Username: ', 'username'); ?>
      <?php echo form_input(array('id' => 'username', 'name' => 'username', 'placeholder' => 'jondoe')); ?>
   </p>

   <p>
      <?php echo form_label('Password: ', 'password'); ?>
      <?php echo form_password(array('id' => 'password', 'name' => 'password', 'placeholder' => 'at least 6 characters')); ?>
   </p>

   <p>
      <?php echo form_label('Confirm: ', 'password_confirm'); ?>
      <?php echo form_password(array('id' => 'password_confirm', 'name' => 'password_confirm', 'placeholder' => 'must match the choosen password')); ?>
   </p>

   <p id="login-submit">
      <?php echo form_button(array('class' => 'signup-button', 'type' => 'submit', 'content' => 'Create Account', 'onClick' => 'return confirm(\'Sind alle Angaben korrekt?\')')); ?>
   </p>

   <?php echo form_close(); ?>

   <?php echo validation_errors('<p class="error">'); ?>
</div>
