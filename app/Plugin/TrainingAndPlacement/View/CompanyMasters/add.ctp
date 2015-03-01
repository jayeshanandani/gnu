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
		echo $this->Form->input('name', ['label' => 'Comapany Name', 'placeholder' => 'Full name of company']);
		echo $this->Form->input('email', ['placeholder' => 'Company email id']);
		echo $this->Form->input('User.username', ['placeholder' => 'Company username.']);
		echo $this->Form->input('institution_id',array('options'=>$institutions));
	?>
	<div class="col col-md-9 col-md-offset-3">
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
			<button type="reset" class="btn btn-default">Cancel</button>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div></div>


 