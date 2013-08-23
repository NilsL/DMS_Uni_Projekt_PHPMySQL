<h1>Verzeichnis</h1>

<?php
$this->load->model('search_model');
foreach ($all_Documents as $row) {
   echo '<div class="document">';
   echo '<strong>Titel: ' . $row->title . '</strong>';
   echo br(1);
   $author = $this->search_model->get_Author($row->author_id);
   echo 'Author: ' . $author['name'];
   echo br(1);
   $project = $this->search_model->get_Project($row->project_id);
   echo 'Projekt: ' . $project['name'];
   echo '</div>';
}
?>
</div>
