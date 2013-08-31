<div class="document">
   <h1>Main Directory</h1>

   <?php
   if (isset ($documents)) {
      $this->table->set_heading('Title', 'Classification', 'Project');

      $atts = array(
         'width'      => '500',
         'height'     => '400',
         'scrollbars' => 'no',
         'screenx'    => '500',
         'screeny'    => '500'
      );

      //sess abfragen zur bestimmung ob popupfenster aufrufbar sein soll
      if ($this->session->userdata('is_logged_in')) {
	      foreach ($documents->result() as $row) {
	         $this->table->add_row(anchor_popup('search/popup?doc_id=' . $row->id, '<strong>' . $row->title . '</strong>', $atts), $row->classification, $row->project);
	      }
      } else {
      	foreach ($documents->result() as $row) {
      		$this->table->add_row('<strong>' . $row->title . '</strong>', $row->classification, $row->project);
      	}
      }

      echo $this->table->generate();
   }
   ?>
</div>

