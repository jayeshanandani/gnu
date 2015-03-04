
<h4><?php echo __('Student Feedback Form '); ?></h4>
<div class="row">
<div class="page-header">
<?php echo $this->Form->create('FeedbackEventAnswer', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>


<table cellpadding="0" cellspacing="0" class="table table-striped">
  <h4>
  <?php
   echo $this->Form->input('feedback_event_question_id', array(
    'id' => 'feedback_event_questions',
    'legend' => false,
     'options' => $answers,
     
     'div' => false

));?> </h4>
<?php
       echo $this->Form->input('answer',array(  
				'type'=> 'radio',
				  'legend' => false,
				  
                  'options'=>array( 5 => 'Excellent' , 4 =>'Very Good', 3=>'Good',2=>'Bad',1=>'Worst')));
	?>
	<br>
	<br>
       <?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
</table>
			</div>
		</div>

