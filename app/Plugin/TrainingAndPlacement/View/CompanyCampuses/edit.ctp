<div class="companyVisits form">
<?php echo $this->Form->create('CompanyVisit'); ?>
	<fieldset>
		<legend><?php echo __('Edit Company Visit'); ?></legend>
	<?php
$url             = $this->Html->url(array(
    'controller' => 'departments',
    'action' => 'list_departments',
    'ext' => 'json'
));
$urla            = $this->Html->url(array(
    'controller' => 'degrees',
    'action' => 'list_degrees',
    'ext' => 'json'
));
$urlb            = $this->Html->url(array(
    'controller' => 'semesters',
    'action' => 'list_semesters',
    'ext' => 'json',
    'plugin' => 'training_and_placement'
));
$emptyDepartment = count($departments) > 0 ? Configure::read('Select.defaultAfter') : array(
    '0' => Configure::read('Select.naBefore') . __('Select Institution First') . Configure::read('Select.naAfter')
);
$emptyDegree     = count($degrees) > 0 ? Configure::read('Select.defaultAfter') : array(
    '0' => Configure::read('Select.naBefore') . __('Select Department First') . Configure::read('Select.naAfter')
);
$emptySemester     = count($semesters) > 0 ? Configure::read('Select.defaultAfter') : array(
    '0' => Configure::read('Select.naBefore') . __('Select Degree First') . Configure::read('Select.naAfter')
);

echo $this->Form->input('institution_id', array(
    'id' => 'institutions',
    'empty' => 'Please Select First',
    'rel' => $url
));
echo $this->Form->input('department_id', array(
    'id' => 'departments',
    'empty' => $emptyDepartment,
    'rel' => $urla
));
echo $this->Form->input('degree_id', array(
    'id' => 'degrees',
    'empty' => $emptyDegree,
    'rel' => $urlb
));
echo $this->Form->input('semester_id', array(
    'id' => 'semesters',
    'empty' => $emptySemester
));
	
		echo $this->Form->input('company_master_id');
		echo $this->Form->input('academic_year_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

