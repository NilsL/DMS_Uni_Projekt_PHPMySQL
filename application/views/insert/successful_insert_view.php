<div id="content">
   <div id="insert_author">
      <h1>Insert successfully operated!</h1>

      <h2>What do you want to do next?</h2>
      <?php echo anchor('home', 'Back to Home');
      echo br(1);
      echo anchor('insert?v=author', 'New Author');
      echo br(1);
      if ($this->session->userdata('role') == 1) {
         echo anchor('insert?v=class', 'New Classification');
         echo br(1);
      }
      echo anchor('insert?v=project', 'New Project');
      echo br(1);
      echo anchor('insert?v=document', 'New Document');
      ?>
   </div>
</div>