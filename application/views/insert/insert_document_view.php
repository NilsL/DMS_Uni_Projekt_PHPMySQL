<div id="content">
   <div id="insert">
      <h1>Insert Document</h1>

      <?php echo form_open('insert/validate_i_document', array('class' => 'insert', 'onsubmit' => 'return validateInsert()')); ?>

      <?php
      //title eingabefeld
      echo form_label('Title: ', 'title');
      echo form_input(array('id' => 'title', 'name' => 'title', 'placeholder' => 'Title', 'autofocus' => 'autofocus', 'onkeyup' => 'validating(this)'));
      echo "<span id='check_title' style= 'border-width: 0;color: red'></span>";
      echo br(1);

      if(!$projects) {
          //pruefen, ob ueberhaupt project vorhanden ist
          echo form_label('Project: ', 'project');
          echo "Currently exists no project!";
          echo br(1);
      } else {
          //projekt eingabefeld
          echo form_label('Project: ', 'project');
          echo form_input(array('name' => 'project', 'id' => 'project', 'onkeyup' => 'javascript:showHint(this)'));
          echo br(1);

          // projekt dropdown
          echo form_label('Projektauswahl: ', 'projects');
          $attributes = 'id="projects" onclick="javascript:putSelected(this)"';
          echo form_dropdown('projects', $projects, array(), $attributes);
          echo br(1);
      }

      //class dropdown
      echo form_label('Classificationauswahl: ', 'classifications');
      $attributes = 'id="classifications"';
      echo form_dropdown('classifications', $classifications, array(), $attributes);
      echo br(1);

      //author eingabefeld
      echo form_label('Author: ', 'author');
      echo form_input(array('name' => 'author', 'id' => 'author', 'onkeyup' => 'javascript:showHint(this)'));
      echo br(1);

      // author dropdown
      echo form_label('Authorauswahl: ', 'authors');
      $attributes = 'id="authors" onclick="javascript:putSelected(this)"';
      echo form_dropdown('authors', $authors, array(), $attributes);
      echo br(1);

      //keyword eingabefeld
      echo form_label('Keyword: ', 'keywords');
      echo br(1);
      echo form_textarea(array('id' => 'keywords', 'name' => 'keywords', 'placeholder' => 'delimited by comma'));
      echo br(1);

      //abstract eingabefeld
      echo form_label('Abstract: ', 'abstract');
      echo br(1);
      echo form_textarea(array('id' => 'abstract', 'name' => 'abstract', 'placeholder' => 'Please type your abstract text here'));
      echo br(1);

      echo form_submit('add_doc', 'Add Document');
      ?>


      <?php  echo form_close();
      if (isset ($error)) {
         ?>
         <p class="error" id="insert_error"><?php echo $error; ?></p>
      <?php } ?>

      <?php echo validation_errors('<p class="error">'); ?>

   </div>
</div>