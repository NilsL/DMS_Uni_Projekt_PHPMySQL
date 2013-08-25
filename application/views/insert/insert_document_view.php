<div id="content">
<div id="insert">
<h1>Insert Document</h1>

      <?php echo form_open('insert/validate_i_document', array('class' => 'login')); ?>

      <?php 
      		$this->table->add_row(array('Title: ', form_input(array('id' => 'i_document_title', 'name' => 'i_document_title', 'placeholder' => 'Title',  'size' => '50'))));
      		
      		$data = array(
      				'name'        => 'projectsname',
      				'id'          => 'i_document_projects',
      				'style'       => 'width: 330px',
      				'onfocus'     => "showDivStation(this, true,'projects')",
      				'onclick'     => "removeNull(this)",
      				'onkeyup'     => "similarFind(this,'projects')",
      				'value'       => '--no choice--',
      		);
      		$inputtext = form_input($data);
      		$options1 = array(0 => '--no choice--');
      		if(isset($all_p)) {
      			foreach ($all_p as $row) {
      				$options1[$row->id] = $row->name;
      			}
      		}
      		$data = 'size="6" style="display: none; width: 330px;" onclick="selectStation(this, '."'projects'".')"';
      		$projects = form_dropdown('projects', $options1, 0, $data);
      		$inputplusprojects = $inputtext.br(1).$projects;
      		$this->table->add_row(array('To Project: ', $inputplusprojects));
      		
      		$data = array(
      				'name'        => 'classificationname',
      				'id'          => 'i_document_classification',
      				'style'       => 'width: 330px',
      				'onfocus'     => "showDivStation(this, true,'classification')",
      				'onclick'     => "removeNull(this)",
      				'onkeyup'     => "similarFind(this,'classification')",
      				'value'       => '--no choice--',
      		);
      		$inputtext = form_input($data);
      		$options2 = array(0 => '--no choice--');
      		if(isset($all_c)) {
      			foreach ($all_c as $row) {
      				$options2[$row->id] = $row->name;
      			}
      		}
      		$data = 'size="6" style="display: none; width: 330px;" onclick="selectStation(this, '."'classification'".')"';
      		$classification = form_dropdown('classification', $options2, 0, $data);
      		$inputplusclassification = $inputtext.br(1).$classification;
      		$this->table->add_row(array('Classification: ', $inputplusclassification));
      		
      		$data = array(
      				'name'        => 'authorsname',
      				'id'          => 'i_document_authors',
      				'style'       => 'width: 330px',
      				'onfocus'     => "showDivStation(this, true,'authors')",
      				'onclick'     => "removeNull(this)",
      				'onkeyup'     => "similarFind(this,'authors')",
      				'value'       => '--no choice--',
      		);
      		$inputtext = form_input($data);
      		$options3 = array(0 => '--no choice--');
      		if(isset($all_a)) {
      			foreach ($all_a as $row) {
      				$options3[$row->id] = $row->name;
      			}
      		}
      		$data = 'size="6" style="display: none; width: 330px;" onclick="selectStation(this, '."'authors'".')" onchange="showRow(this)"';
      		$author = form_dropdown('authors', $options3, 0, $data);
      		$inputplusauthor = $inputtext.br(1).$author.br(1)."<table id='tab'></table>";
      		$this->table->add_row(array('From: ', $inputplusauthor));
      		
      		/* $options3 = array(0 => " ");
      		if(isset($all_a)) {
      			foreach ($all_a as $row) {
      				$options3[$row->id] = $row->name;
      			}
      		}
      		$size = 'size=9';
      		$authors = form_multiselect('authors[]', $options3, 0, $size);
      		$this->table->add_row(array('From: ', $authors)); */
      		
      		$keywords = form_textarea(array('id' => 'i_document_keywords', 'name' => 'i_document_keywords', 'placeholder' => 'delimited by comma'));
      		$this->table->add_row(array('Keywords: ', $keywords));
      		
      		$abstract = form_textarea(array('id' => 'i_document_abstract', 'name' => 'i_document_abstract', 'placeholder' => 'Please type your abstract text here'));
      		$this->table->add_row(array('Abstract: ', $abstract));
      		
      		echo $this->table->generate();
      		
      		echo form_submit('add_doc', 'Add Document'); 
      ?>
      
   
     <?php  echo form_close ();
			if (isset ( $error )) {
				?>
         <p class="error" id="insert_error"><?php echo $error; ?></p>
    <?php } ?>
    
    <?php echo validation_errors('<p class="error">'); ?>
      
   </div>
</div>