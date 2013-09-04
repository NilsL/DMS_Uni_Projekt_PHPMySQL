<div id="right-sidebar" class="span-5 last">
   <div id="recent-books">
      <h3 class="caps">Recent Uploads</h3>

      <div class="box">
          <?php
          $recent_Uploads = $this->sidebar_model->get_recent_Uploads();
          if($recent_Uploads) {
              foreach ($recent_Uploads->result() as $row) {
                echo anchor_popup('search/popup?doc_id=' . $row->id, '<strong>' . $row->title . '</strong>');
                echo br(2);
              }
          }
          ?>
      </div>
   </div>

   <div class="prepend-top" id="recent-reviews">
      <h3 class="caps">Last Edited</h3>

      <div class="box">
        <?php
        $last_Edited = $this->sidebar_model->get_last_Edited();
        if($last_Edited) {
            foreach ($last_Edited->result() as $row) {
              echo anchor_popup('search/popup?doc_id=' . $row->id, '<strong>' . $row->title . '</strong>');
                echo br(2);
            }
        }
        ?>
      </div>
   </div>
</div>
