<div class="row">
          <div class="col">
 
<h3><?php print "Welcome {$fullname}";?>! <br><br>Please enter the following details for Campus Placement!!!</h3>
<table class="table table-striped">
	
	<tr>
		<th><?php echo $this->Html->link(__('Select Departments for Placement Process'), array('controller' => 'CompanyCampuses', 'action' => 'select_department')); ?></th>		
	</tr> 
	<tr>
		<th><?php echo $this->Html->link(__('Add Visit Dates'), array('controller' => 'CompanyVisits', 'action' => 'add')); ?></th>
	</tr>
	<tr>
		<th><?php echo $this->Html->link(__('Add Job Details'), array('controller' => 'CompanyJobs', 'action' => 'add')); ?></th>
	</tr>
	<tr>
		<th><?php echo $this->Html->link(__('Add Job Eligibility'), array('controller' => 'CompanyJobEligibilities', 'action' => 'add')); ?></th>
	</tr>
	<tr>
		<th><?php echo $this->Html->link(__('Edit Company Details'),array('controller' => 'CompanyMasters' ,'action' => 'comp_detail'));  ?></th>
	</tr>
</table>

</div></div>