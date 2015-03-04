
<?php echo $this->Html->script('FeedbackSystem.index');?>
<div id='wrapper'>
   <div id='origin1' class='fquestion'>
	<h3><?php echo __('FeedbackQuestions'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
		

			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Question'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ( $feedbackQuestions as $feedbackQuestion ): ?>	
	<tr>
       
       <td>
			<?php echo $this->Html->link($feedbackQuestion['FeedbackCategory']['name'], array('plugin'=>'feedback_system','controller' => 'feedback_categories', 'action' => 'view', $feedbackQuestion['FeedbackCategory']['id'])); ?>
		</td>
        <td ><?php echo h($feedbackQuestion['FeedbackQuestion']['text']); ?>&nbsp;</td>

		<td class="actions">
			
			<?php echo $this->Html->link(__('',true), array('action' => 'edit', $feedbackQuestion['FeedbackQuestion']['id']),array('class' => 'glyphicon glyphicon-edit')); ?>
			<?php
            if($feedbackQuestion['FeedbackQuestion']['recstatus'] == 1){
                echo $this->Form->postLink(__('',true), array('action' => 'deactivate', $feedbackQuestion['FeedbackQuestion']['id']),array('class' => 'glyphicon glyphicon-remove', 'escape' => false),null, __('Are you sure you want to deactivate # %s?', $feedbackQuestion['FeedbackQuestion']['id']));
            }
        ?>
        <?php
            if($feedbackQuestion['FeedbackQuestion']['recstatus'] == 0){
                echo $this->Form->postLink(__('',true), array('action' => 'activate', $feedbackQuestion['FeedbackQuestion']['id']),array('class' => 'glyphicon glyphicon-ok', 'escape' => false),null, __('Are you sure you want to activate # %s?', $feedbackQuestion['FeedbackQuestion']['id']));
            }
        ?>
		</td>
	</tr>
	
<?php endforeach; ?>
	</table>

	</div>
</div>


<div id='drop' class='fquestion'>



	<h3><?php echo __('Feedback Form'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
	       
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('question'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	
	</table>
</div>
