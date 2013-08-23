<div id="usercontrol">
   <h1>User Overview</h1>
   <h4><?= $users->num_rows(); ?> &Sigma;</h4>

   <?php

   if (isset($message)) {
      echo '<p class="alert">' . $message . '</p>';
   }

   foreach ($users->result() as $user) {
      $hidden = array('user_id' => $user->users_id);
      echo form_open('usercontrol/show_User', array('class' => 'user'), $hidden);
      echo '<p><strong>User ID:</strong> ' . $user->users_id . '</p>';
      echo '<p><strong>First Name:</strong> ' . $user->first_name . '</p>';
      echo '<p><strong>Last Name:</strong> ' . $user->last_name . '</p>';
      echo '<p><strong>Username:</strong> ' . $user->username . '</p>';
      echo '<p><strong>Email:</strong> ' . $user->email . '</p>';
      echo '<p><strong>Role:</strong> ' . $user->role . '</p>';
      echo form_button(array('class' => 'user-button', 'type' => 'submit', 'content' => 'choose User'));
      echo form_close();

   }
   ?>

</div>
