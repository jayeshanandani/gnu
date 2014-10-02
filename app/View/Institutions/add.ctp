<?php
echo $this->Html->script('populatedropdowns');
?>
<div class="institutions form">
<?php
echo $this->Form->create('Institution');
?>
<fieldset>
<legend><?php
echo __('Add Institution');
?></legend>
<?php
$url             = $this->Html->url(array('controller' => 'departments',
'action' => 'list_departments',
'ext' => 'json'
));
$urla            = $this->Html->url(array('controller' => 'degrees',
'action' => 'list_degrees',
'ext' => 'json'
));
$emptyDepartment = count($departments) > 0 ? Configure::read('Select.defaultAfter') : array('0' => Configure::read('Select.naBefore') . __('Select Institution First') . Configure::read('Select.naAfter')
);
$emptyDegree     = count($degrees) > 0 ? Configure::read('Select.defaultAfter') : array('0' => Configure::read('Select.naBefore') . __('Select Department First') . Configure::read('Select.naAfter')
);
echo $this->Form->input('institution_id', array('id' => 'institutions',
'empty' => 'Please Select First',
'rel' => $url
));
echo $this->Form->input('department_id', array('id' => 'departments',
'empty' => $emptyDepartment,
'rel' => $urla
));
echo $this->Form->input('degree_id', array('id' => 'degrees',
'empty' => $emptyDegree
));

echo $this->Form->input('name');
print $this->Form->input('Group', array('label' => 'Groups', 'multiple' => 'checkbox'));
?>
</fieldset>
<?php
echo $this->Form->end(__('Submit'));
?>
</div>
<div class="actions">
<h3><?php
echo __('Actions');
?></h3>
<ul>

<li><?php
echo $this->Html->link(__('List Institutions'), array('action' => 'index'
));
?></li>
<li><?php
echo $this->Html->link(__('List Departments'), array('controller' => 'departments',
'action' => 'index'
));
?> </li>
<li><?php
echo $this->Html->link(__('New Department'), array('controller' => 'departments',
'action' => 'add'
));
?> </li>
</ul>
</div>
