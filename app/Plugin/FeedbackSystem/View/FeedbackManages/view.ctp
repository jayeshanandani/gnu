<div class="table-responsive">
<div class="feedbackManages view">
<h2><?php echo __('Feedback Manage'); ?></h2>
	<table class="table table-striped">
		<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($feedbackManage['FeedbackManage']['id']); ?>
			&nbsp;
		</td>
		</tr>
		
		
		<tr>
		<th><?php echo __('Recstatus'); ?></th>
		<td>
		  <?php
			 if($feedbackManage['FeedbackManage']['recstatus'] == 1){
                echo $this->Form->postLink(__('activate') );
            }
            else {
                 echo $this->Form->postLink(__('deactivate') );	
            }
        ?>
		</td>
		</tr>
		<tr>
		<th><?php echo __('Category'); ?></th>
		<td>
			<?php echo $this->Html->link($feedbackManage['FeedbackCategory']['name'], array('controller' => 'feedback_categories', 'action' => 'view', $feedbackManage['FeedbackCategory']['id'])); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Staff'); ?></th>
		<td>
			<?php echo $this->Html->link($feedbackManage['Staff']['name'], array('controller' => 'staffs', 'action' => 'view', $feedbackManage['Staff']['id'])); ?>
			&nbsp;
		</td>
		</tr>
	</table>
</div>
</div>