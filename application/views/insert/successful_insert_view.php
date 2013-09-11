<div id="content">
   <div id="insert_author">
      <h1>Insert successfully operated!</h1>

      <h2>What do you want to do next?</h2>
      <?php echo anchor('home', 'Back to Home');
      echo br(1);
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
      echo anchor('insert/insert_file', 'Attach a file');?>
   </div>
</div>