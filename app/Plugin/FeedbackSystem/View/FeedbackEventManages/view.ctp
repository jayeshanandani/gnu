<div class="table-responsive">
<div class="feedbackEventManages view">
<h2><?php echo __('Feedback Event'); ?></h2>
	<table class="table table-striped">
		<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($feedbackEventManage['FeedbackEventManage']['id']); ?>
			&nbsp;
		</td>
		</tr>
		
		
		<tr>
		<th><?php echo __('Recstatus'); ?></th>
		<td>
		  <?php
			 if($feedbackEventManage['FeedbackEventManage']['recstatus'] == 1){
                echo $this->Form->postLink(__('activate') );
            }
            else {
                 echo $this->Form->postLink(__('deactivate') );	
            }
        ?>
		</td>
		</tr>
		<tr>
		<th><?php echo __('Event'); ?></th>
		<td>
			<?php echo $this->Html->link($feedbackEventManage['FeedbackEvent']['name'], array('controller' => 'feedback_events', 'action' => 'view', $feedbackEventManage['FeedbackEvent']['id'])); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Staff'); ?></th>
		<td>
			<?php echo $this->Html->link($feedbackEventManage['Staff']['name'], array('controller' => 'staffs', 'action' => 'view', $feedbackEventManage['Staff']['id'])); ?>
			&nbsp;
		</td>
		</tr>
	</table>
</div>
</div>