<div id="content">
   <div id="insert">
      <h1>Add Attachment</h1>

      <?php echo form_open_multipart('insert/validate_i_file', array('class' => 'login')); ?>

      <p>
         <?php
         if (isset($documents)) {
            foreach ($documents as $row) {
               $options1[$row->id] = $row->title;
            }
         }
         $documents = form_dropdown('documents', $options1, 1);
         $this->table->add_row(array('To Document: ', $documents));

         $this->table->add_row(array('File: ', form_upload(array('id' => 'i_file', 'name' => 'i_file'))));

         echo $this->table->generate();

         echo br(1);
         ?>
      </p>

      <p id="insert_submit">
         <?php echo form_submit('add_file', 'Add File'); ?>
      </p>

      <?php
      echo form_close();
      if (isset ($error)) {
         ?>
         <p class="error" id="insert_error"><?php echo $error; ?></p>
      <?php } ?>

      <?php echo validation_errors('<p class="error">'); ?>

   </div>
</div>