<div id="insert">
   <h1>What do you want to insert?</h1>
   <?php
   echo anchor('insert?v=author', 'New Author');
   echo br(1);

   if ($this->session->userdata('role') == 1) {
      echo anchor('insert?v=class', 'New Classification');
      echo br(1);
   }

   echo anchor('insert?v=project', 'New Project');
   echo br(1);
   echo anchor('insert?v=document', 'New Document');
   echo br(1);
   echo anchor('insert?v=file', 'Attach a file to a document');
   ?>
</div>
