<div id="content">
<div id="insert">
<h1>Insert Document</h1>

      <?php echo form_open('insert/validate_i_document', array('class' => 'login')); ?>

      <?php 
      		//title eingabefeld
      		echo form_label('Title: ', 'title');
      		echo form_input(array('id' => 'title', 'name' => 'i_document_title', 'placeholder' => 'Title',  'size' => '50', 'autofocus' => 'autofocus'));
			echo br(1);
			
      		//projekt eingabefeld
      		echo form_label('Project: ', 'project');
      		$data = array(
      				'name'        => 'i_document_projects',
      				'id'          => 'project',
      				'style'       => 'width: 330px',
      				'onkeyup'     => 'javascript:showHint(this)',
      		);
      		echo form_input($data);
      		echo br(1);
      		echo form_label('Projektauswahl: ', 'projects');
      		$attributes = 'id="projects" size="1" style=" width: 330px;" onclick="javascript:putSelected(this)"';
      		echo form_dropdown('projects', $all_p, array(), $attributes);
      		echo br(1);
  
      		//class eingabefeld
      		echo form_label('Classification: ', 'classification');
      		$data = array(
      				'name'        => 'i_document_classification',
      				'id'          => 'classification',
      				'style'       => 'width: 330px',
      				'onkeyup'     => 'javascript:showHint(this)',
      		);
      		echo form_input($data);
      		echo br(1);
      		echo form_label('Classificationauswahl: ', 'classifications');
      		$attributes = 'id="classifications" size="1" style="width: 330px;" onclick="javascript:putSelected(this)"';
      		echo form_dropdown('classifications', $all_c, array(), $attributes);
      		echo br(1);
      		
      		//author eingabefeld
      		echo form_label('Author: ', 'author');
      		$data = array(
      				'name'        => 'i_document_authors',
      				'id'          => 'author',
      				'style'       => 'width: 330px',
      				'onkeyup'     => 'javascript:showHint(this)',
      		);
      		echo form_input($data);
      		echo br(1);
      		echo form_label('Authorauswahl: ', 'authors');
      		$attributes = 'id="authors" size="1" style="width: 330px;" onclick="javascript:putSelected(this)" onchange="showRow(this)"';
      		echo form_dropdown('authors', $all_a, array(), $attributes);
      		echo br(1);
      		//authors ist multichoice, daher diese table hier vorzubereiten
      		echo "<table id='tab'></table>";
      		
      		
      		//keyword eingabefeld
      		echo form_label('Keyword: ', 'keyword');
      		echo br(1);
      		echo form_textarea(array('id' => 'i_document_keywords', 'name' => 'i_document_keywords', 'placeholder' => 'delimited by comma'));
      		echo br(1);
      		
      		//abstract eingabefeld
      		echo form_label('Abstract: ', 'abstract');
      		echo br(1);
      		echo form_textarea(array('id' => 'i_document_abstract', 'name' => 'i_document_abstract', 'placeholder' => 'Please type your abstract text here'));
      		echo br(1);
      		
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