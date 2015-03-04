
<div class="table-responsive">
<div class="staffs index">
	<h2><?php echo __('FeedbackEventStaffs'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
	        <th><?php echo $this->Paginator->sort('name'); ?></th>
	         <th><?php echo $this->Paginator->sort('institution_id'); ?></th>
	         <th><?php echo $this->Paginator->sort('department_id'); ?></th>
	         <th><?php echo $this->Paginator->sort('Actions'); ?></th>

			
	</tr>
	<?php foreach ($feedbackEventStaffs as $feedbackEventStaff): ?>
	<tr>
		
		<td><?php echo h($feedbackEventStaff['FeedbackEventStaff']['name']); ?>&nbsp;</td>
		
		<td>
			<?php echo $this->Html->link($feedbackEventStaff['Institution']['name'], array('controller' => 'institutions', 'action' => 'view', $feedbackEventStaff['Institution']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($feedbackEventStaff['Department']['name'], array('controller' => 'departments', 'action' => 'view', $feedbackEventStaff['Department']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('',true), array('action' => 'view', $feedbackEventStaff['FeedbackEventStaff']['id']),array('class' => 'glyphicon glyphicon-search')); ?>
			<?php echo $this->Html->link(__('',true), array('action' => 'edit', $feedbackEventStaff['FeedbackEventStaff']['id']),array('class' => 'glyphicon glyphicon-edit')); ?>
			
		</td>



		
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<ul class="pagination pagination-large pull-right">
                        <?php
                            echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                            echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                        ?>
                    </ul>
</div>
