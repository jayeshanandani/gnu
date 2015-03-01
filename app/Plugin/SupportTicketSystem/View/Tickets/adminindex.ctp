
<div class="tickets index">
	<h2><?php echo __('View all Tickets'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('ticket_no'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('staff_id'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('instituion_id'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('status_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tickets as $ticket): ?>
	<tr>
		<td><?php echo h($ticket['Ticket']['ticket_no']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ticket['User']['fullname'], array('plugin'=>false,'controller' => 'users', 'action' => 'view', $ticket['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ticket['Staff']['firstname']." ".$ticket['Staff']['lastname'], array('controller' => 'staffs', 'action' => 'view', $ticket['Staff']['id'])); ?>
		</td>
		
		<td>
			<?php echo $this->Html->link($ticket['Category']['name'], array('controller' => 'categories', 'action' => 'view', $ticket['Category']['id'])); ?>
		</td>
		<td>
			<?php echo h($ticket['Category']['Institution']['name']); ?>&nbsp;
		</td>
		<td>
			<?php echo h($ticket['Category']['Department']['name']); ?>&nbsp;
		</td>
		<td>
			<?php echo h($ticket['Ticket']['subject']); ?>&nbsp;
		</td>
		<td>
			<?php echo $this->Html->link($ticket['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $ticket['Status']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ticket['Ticket']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ticket['Ticket']['id'])); ?>
			<?php echo $this->Html->link(__('Change Ticket Status'), array('action' => 'change_status', $ticket['Ticket']['id'])); ?>
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
