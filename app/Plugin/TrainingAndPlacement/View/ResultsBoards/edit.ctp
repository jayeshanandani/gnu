<div class="resultsBoards form">
<?php echo $this->Form->create('ResultsBoard'); ?>
	<fieldset>
		<legend><?php echo __('Edit Results Board'); ?></legend>
	<?php
		echo $this->Form->input('board');
		echo $this->Form->input('total_marks');
		echo $this->Form->input('obtain_marks');
		echo $this->Form->input('percentages');
		echo $this->Form->input('attempts');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ResultsBoard.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ResultsBoard.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Results Boards'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>
