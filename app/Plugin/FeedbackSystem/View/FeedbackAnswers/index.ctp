<div class="feedbackAnswers form">
<h2><?php echo __('Student Feedback Form '); ?></h2>
<div class="row">
<div class="page-header">
<?php echo $this->Form->create('FeedbackAnswer', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>


<table cellpadding="0" cellspacing="0" class="table table-striped">
   <tr>
		<tr>
			 <legend><?php echo __('Question'); ?></legend>
		</tr>
			
	</tr>
	<?php foreach ($feedbackAnswers as $feedbackAnswer): ?>
	<tr>
		
			<?php echo $this->Html->link($feedbackAnswer['FeedbackQuestion']['text'], array('controller' => 'feedbackquestions', $feedbackAnswer['FeedbackQuestion']['id'])); ?>
			
       
	
	</tr>
<?php endforeach; ?>


</table>

<?php

       echo $this->Form->input('answer',
			array( 'type'=> 'radio',
		           'options'=>array(5 =>'Excellent' , 4 =>'Very Good', 3=>'Good',2=>'Bad',1=>'Worst')));
	?>
       <?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>



			</div>
		</div>
	</div>



	