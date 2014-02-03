<div id="content">
   <div id="insert">
      <h1>Add Attachment</h1>

       <?php echo form_open_multipart('insert/validate_i_file', array('class' => 'insert', 'onsubmit' => 'return validateInsert()')); ?>

      <p>
         <?php
         //projekt eingabefeld
         echo form_label('Document: ', 'document');
         echo form_input(array('name' => 'document', 'id' => 'document', 'onkeyup' => 'javascript:showHint(this)'));
         echo br(1);

         echo form_label('Documentauswahl: ', 'documents');
         $attributes = 'id="documents" onclick="javascript:putSelected(this)"';
         echo form_dropdown('documents', $documents, array(), $attributes);
         echo br(1);

         echo form_label('File: ', 'file');
         echo form_upload(array('id' => 'file', 'name' => 'file'));
         ?>
      </p>

      <p id="insert_submit">
         <?php
         echo form_submit('add_file', 'Add File');
         echo form_close();
         ?>
      </p>

      <?php
      if (isset ($error)) { ?>
         <p class="error"><?= $error; ?></p>
      <?php }

      echo validation_errors('<p class="error">');
      ?>

   </div>
</div>