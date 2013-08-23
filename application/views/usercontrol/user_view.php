<div id="usercontrol">
   <h1>User Edit</h1>

   <?php
   echo '<div class="user">';
   $hidden = array('user_id' => $user->users_id);
   echo form_open('usercontrol/update_User', array('name' => 'usercontrol-form-update'), $hidden);
   echo '<p>';
   echo form_label('First Name: ', 'first_name');
   echo form_input(array('name' => 'first_name', 'value' => $user->first_name));
   echo '</p>';
   echo '<p>';
   echo form_label('Last Name: ', 'last_name');
   echo form_input(array('name' => 'last_name', 'value' => $user->last_name));
   echo '</p>';
   echo '<p>';
   echo form_label('Username: ', 'username');
   echo form_input(array('name' => 'username', 'value' => $user->username));
   echo '</p>';
   echo '<p>';
   echo form_label('Email: ', 'email');
   echo form_input(array('name' => 'email', 'value' => $user->email));
   echo '</p>';
   echo '<p>';
   echo form_label('Role: ', 'role');
   echo form_input(array('name' => 'role', 'value' => $user->role));
   echo '</p>';
   echo form_button(array('class' => 'user-button', 'type' => 'submit', 'content' => 'update User', 'onClick' => 'return confirm(\'Wirklich updaten?\')'));

   if (isset($success)) {
      ?>
      <p class="success"><?php echo $success; ?></p>
   <?php
   }
   echo form_close();

   $hidden2 = array('user_id' => $user->users_id);
   echo form_open('usercontrol/delete_User', array('name' => 'usercontrol-form-delete'), $hidden2);
   echo form_button(array('class' => 'user-button', 'type' => 'submit', 'content' => 'delete User', 'onClick' => 'return confirm(\'Wirklich löschen?\')'));
   echo form_close();

   echo '</div>';

   echo anchor('usercontrol', 'back');

   ?>

</div>
