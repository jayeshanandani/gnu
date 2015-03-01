<style type = "text/css">
.dept{
	height:300px !important;
	width:100%;
}
</style>

<div class="row">
            <h4>Please select the department(s) on which you are interested for the Campus Placement<br>(Select multiple department using CTRL)</h4>
<?php echo $this->Form->create('Department', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
    ),
    'class' => 'well form-horizontal'
)); ?> 
    <fieldset>
        
<?php

echo $this->Form->input('Department',array('class' => 'dept'));
echo $this->Form->submit('Submit', array(
        'div' => 'form-group',
        'class' => 'btn btn-primary'
    ));
?>
</fieldset>
<?php
echo $this->Form->end();
?>
</div>