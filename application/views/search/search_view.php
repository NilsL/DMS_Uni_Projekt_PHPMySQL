<div id="search">
   <?php

   echo form_fieldset('Suche', array('id' => 'search'));
   echo form_open('search/show_result', array('class' => 'search')); ?>

   <p>
      <?php
      echo form_label('Titel', 'title');
      echo form_input(array('id' => 'title', 'name' => 'title', 'placeholder' => 'Titel des Dokuments'));
      ?>
   </p>

   <p>
      <?php
      echo form_label('Keywords', 'keywords');
      echo form_input(array('id' => 'keywords', 'name' => 'keywords', 'placeholder' => 'Keywords durch Komma getrennt'));
      ?>
   </p>

   <p>
      <?php echo form_button(array('class' => 'search-button', 'type' => 'submit', 'content' => 'Search')); ?>
   </p>

   <?php echo form_close(); ?>

   <p>
      <?php echo anchor('search/search_advanced', 'erweiterte Suche...', array('id' => 'search-advanced')); ?>
   </p>

   <?php if (isset($error)) { ?>
      <p class="error" id="search_error"><?php echo $error; ?></p>
   <?php
   }

   echo form_fieldset_close();
   ?>
</div>
