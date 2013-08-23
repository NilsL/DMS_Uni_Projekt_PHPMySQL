<?php $this->load->view('template/header'); ?>

<?php $this->load->view('template/left_sidebar'); ?>

   <div id="content" class="span-16">
      <?php $this->load->view($view); ?>
   </div>

<?php $this->load->view('template/right_sidebar'); ?>

<?php $this->load->view('template/footer'); ?>