<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 *
 *
 */
class Sidebar extends CI_Controller {

   /**
    * evtl auch in einen helper auslagern und dann in den controllern callen
    *
    *
    */
   function get_right_sidebar_content() {
      $this->load->model('search_model');

      $recent_Uploads         = $this->search_model->get_recent_Uploads();
      $data['recent_Uploads'] = $recent_Uploads;

      $last_Edited         = $this->search_model->get_last_Edited();
      $data['last_Edited'] = $last_Edited;

      return $data;
   }
}
/* End of file sidebar.php */
/* Location: ./application/controllers/sidebar.php */