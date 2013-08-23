<div id="insert">
   <h1>What do you want to insert?</h1>
   <?php
   echo anchor('insert/insert_author', 'New Author');
   echo br(1);

   if ($this->session->userdata('role') == 1) {
      echo anchor('insert/insert_class', 'New Classification');
      echo br(1);
   }

   echo anchor('insert/insert_project', 'New Project');
   echo br(1);
   echo anchor('insert/insert_document', 'New Document');
   echo br(1);
   echo anchor('insert/insert_file', 'Attach a file');
   ?>
</div>
