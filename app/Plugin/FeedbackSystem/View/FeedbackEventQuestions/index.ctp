
<?php echo $this->Html->script('FeedbackSystem.index');?>
<div id='wrapper'>
   <div id='origin1' class='fquestion'>
	<h3><?php echo __('FeedbackEventQuestions'); ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
		

			<th><?php echo $this->Paginator->sort('event_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Question'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ( $feedbackEventQuestions as $question ): ?>	
	<tr>
       
       <td>
			<?php echo $this->Html->link($question['FeedbackEvent']['name'], array('controller' => 'feedbackevents', 'action' => 'view', $question['FeedbackEvent']['id'])); ?>
		</td>
        <td ><?php echo h($question['FeedbackEventQuestion']['text']); ?>&nbsp;</td>
		<td class="actions">
			
			<?php echo $this->Html->link(__('',true), array('action' => 'edit', $question['FeedbackEventQuestion']['id']),array('class' => 'glyphicon glyphicon-edit')); ?>
			<?php
            if($question['FeedbackEventQuestion']['recstatus'] == 1){
                echo $this->Form->postLink(__('',true), array('action' => 'deactivate', $question['FeedbackEventQuestion']['id']),array('class' => 'glyphicon glyphicon-remove', 'escape' => false),null, __('Are you sure you want to deactivate # %s?', $question['FeedbackEventQuestion']['id']));
            }
        ?>
        <?php
            if($question['FeedbackEventQuestion']['recstatus'] == 0){
                echo $this->Form->postLink(__('',true), array('action' => 'activate', $question['FeedbackEventQuestion']['id']),array('class' => 'glyphicon glyphicon-ok', 'escape' => false),null, __('Are you sure you want to activate # %s?', $question['FeedbackEventQuestion']['id']));
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
	       
			<th><?php echo $this->Paginator->sort('event_id'); ?></th>
			<th><?php echo $this->Paginator->sort('question'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	
	</table>
</div>
