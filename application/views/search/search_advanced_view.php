<div id="search">
   <?php

   echo form_fieldset('Erweiterte Suche', array('id' => 'search'));
   echo form_open('search/show_result?v=2', array('class' => 'search')); ?>

   <p>
      <?php
      echo form_label('Titel', 'title');
      echo form_input(array('id' => 'title', 'name' => 'title', 'placeholder' => 'Titel des Dokuments', 'autofocus' => 'autofocus'));
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
      echo form_input(array('id' => 'project', 'name' => 'project', 'placeholder' => 'Projektsuche', 'onkeyup' => 'javascript:showHint(this)'))
      ?>
   </p>

   <p>
      <?php
      echo form_label('Projektauswahl', 'projects');
      $attributes = 'id="projects" onclick="javascript:putSelected(this)"';
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
