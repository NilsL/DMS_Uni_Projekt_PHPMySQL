<div id="left-sidebar" class="span-3">

   <ul id="sidebar">
      <li><?= anchor('home/index', 'Home'); ?></li>
      <?= br(1); ?>

      <?php
      if ($this->session->userdata('is_logged_in')) {
         if ($this->session->userdata('role') == 1) {
            ?>
            <li><?= anchor('usercontrol', 'User Control');
         } ?></li>

         <li><?= anchor('search', 'Search'); ?></li>
         <li><?= anchor('insert', 'Insert'); ?></li>
         <?= br(1); ?>
         <li><?= anchor('login/logout', 'Logout'); ?></li>
      <?php
      }

      else {
         ?>
         <li><?= anchor('login', 'Login'); ?></li>
      <?php } ?>

   </ul>
</div>
