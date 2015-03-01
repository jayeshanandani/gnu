<div class="row">
          <div class="col-lg-6">
<div class="companyMasters form">
<?php echo $this->Form->create('CompanyMaster', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Add Company Details'); ?></legend>
	<?php
		    echo $this->Html->link('Add New Company Credentials',['plugin'=>'training_and_placement','controller' => 'companyMasters' ,'action'=>'Add']);
	?>
	<div class="col col-md-9 col-md-offset-3">
	</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div></div>