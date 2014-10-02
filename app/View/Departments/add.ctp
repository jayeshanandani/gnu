<style type="text/css">
   input[type=checkbox]{
       float: inherit;
   }
</style>
<?php
echo $this->Html->script('1');
?>
<?php $url             = $this->Html->url(array('plugin' => false,'controller' => 'departments',
'action' => 'list_departments',
'ext' => 'json'
));?>
<div class="departments form">
<?php echo $this->Form->create('Department'); ?>
	<fieldset>
		<legend><?php echo __('Add Department'); ?></legend>
	<?php
		 echo $this->Form->input('institution_id', array('id' => 'institutions',
'empty' => 'Please Select First',
'rel' => $url
));
		 echo $this->Form->input('name');
?>
<div id="checkboxes"></div>
		

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Departments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('controller' => 'institutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('controller' => 'institutions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Degrees'), array('controller' => 'degrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Degree'), array('controller' => 'degrees', 'action' => 'add')); ?> </li>
	</ul>
</div>
