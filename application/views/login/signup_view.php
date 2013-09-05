<div id="signup">
   <h1>Create an Account</h1>

   <legend>Personal Information</legend>

   <?php echo form_open('login/validate_signup', array('name' => 'signup', 'class' => 'signup', 'onsubmit' => 'return validateSignUp()')); ?>
   <p>
      <?php echo form_label('First Name: ', 'first_name'); ?>
      <?php echo form_input(array('id' => 'first_name', 'name' => 'first_name', 'placeholder' => 'Jon', 'autofocus' => 'autofocus')); ?>
   </p>

   <p>
      <?php echo form_label('Last Name: ', 'last_name'); ?>
      <?php echo form_input(array('id' => 'last_name', 'name' => 'last_name', 'placeholder' => 'Doe')); ?>
   </p>

   <p>
      <?php echo form_label('Email: ', 'email'); ?>
      <?php echo form_input(array('id' => 'email', 'name' => 'email', 'placeholder' => 'jondoe@jondoe.com', 'onblur' => 'validating(this)')); ?>
      <span id='check_email' style= "border-width: 0;color: red"></span>
   </p>

   <legend>Login Info</legend>

   <p>
      <?php echo form_label('Username: ', 'username'); ?>
      <?php echo form_input(array('id' => 'username', 'name' => 'username', 'placeholder' => 'jondoe', 'onkeyup' => 'validating(this)')); ?>
      <span id='check_username' style= "border-width: 0;color: red"></span>
   </p>

   <p>
      <?php echo form_label('Password: ', 'password'); ?>
      <?php echo form_password(array('id' => 'password', 'name' => 'password', 'placeholder' => 'at least 6 characters', 'onkeyup' => 'matching()')); ?>
   </p>

   <p>
      <?php echo form_label('Confirm: ', 'password_confirm'); ?>
      <?php echo form_password(array('id' => 'password_confirm', 'name' => 'password_confirm', 'placeholder' => 'must match the choosen password', 'onkeyup' => 'matching()')); ?>
      <span id='check_password_confirm' style= "border-width: 0;color: red"></span>
   </p>

   <p id="login-submit">
      <?php echo form_button(array('class' => 'signup-button', 'type' => 'submit', 'content' => 'Create Account')); ?>
   </p>

   <?php echo form_close(); ?>

   <?php echo validation_errors('<p class="error">'); ?>
</div>
