<div id="search">
   <?php

   echo form_fieldset('Erweiterte Suche', array('id' => 'search'));
   echo form_open('site/show_advanced_result', array('class' => 'search')); ?>

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
      <?php
      echo form_label('Klassifizierung', 'classification');
      echo form_dropdown('classification', $classifications);
      ?>
   </p>

   <p>
      <?php
      echo form_label('Projekt', 'project');
      echo form_input(array('id' => 'project', 'name' => 'project', 'placeholder' => 'Projektsuche', 'onkeyup' => 'javascript:showHint(this.value)'))
      ?>
   </p>

   <p>
      <?php
      echo form_label('Projektauswahl', 'projects');
      $attributes = 'id="projects" size="1" onclick="javascript:putSelected()"';
      echo form_dropdown('projects', $projects, array(), $attributes);
      ?>
   </p>

   <p>
      <?php echo form_button(array('class' => 'search-button', 'type' => 'submit', 'content' => 'Search')); ?>
   </p>

   <?php echo form_close(); ?>

   <p>
      <?php echo anchor('search', 'einfache Suche...', array('id' => 'search')); ?>
   </p>

   <?php echo form_fieldset_close(); ?>

</div>
