<script type="text/javascript">
$(function() {
  
      function exportTableToCSV($table, filename) {

        var $rows = $table.find('tr'),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            csv1 = '"' + $rows.map(function (i, row) {
            	if( i < 1 ) {
                var $row = $(row),
                    $cols = $row.find('th') ; 

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace('"', '""'); // escape double quotes

                }).get().join(tmpColDelim);
            }

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td') ; 

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace('"', '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv1+csv);

        $(this)
            .attr({
            'download': filename,
                'href': csvData,
                'target': '_blank'
        });
    }

    // This must be a hyperlink
    $(".export").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#CompanyVisit'), 'export.csv']);
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });

});
</script>
<div class="table-responsive">
<div class="companyVisits index">
	<h3><?php echo __('Company Visits'); ?></h3>
	<a href="#" class="export" text="Download as Excel">Download</button>
	<table cellpadding="0" cellspacing="0" class="table table-striped" id="CompanyVisit">
	<tr>

			
			<th><?php echo $this->Paginator->sort('campus_id'); ?></th>
			<th><?php echo $this->Paginator->sort('pptdate', 'Talk Date'); ?></th>
			<th><?php echo $this->Paginator->sort('visitdate1', 'Visit Date 1'); ?></th>
			<th><?php echo $this->Paginator->sort('visitdate2', 'Visit Date 2'); ?></th>
			<th><?php echo $this->Paginator->sort('visitdate3', 'Visit Date 3'); ?></th>
			<th><?php echo $this->Paginator->sort('lastdate','Last Date'); ?></th>
			<th><?php echo $this->Paginator->sort('placementtype', 'Placement Type'); ?></th>
			<th><?php echo $this->Paginator->sort('placementvenue', 'Placement Venue'); ?></th>
			<th><?php echo $this->Paginator->sort('recstatus','Status'); ?></th>
			<th class="actions"><?php
			if (Auth::hasRoles(array('tpadmin'))){
			echo __('Actions'); }?></th>
	</tr>
	<?php foreach ($companyVisits as $companyVisit): ?>
	<tr>
		
		
		<td>
			<?php echo $this->Html->link($companyVisit['CompanyCampus']['CompanyMaster']['name'], array('controller' => 'company_master', 'action' => 'view', $companyVisit['CompanyCampus']['CompanyMaster']['id'])); ?>
		</td>
		<td><?php echo h($this->Time->format('F jS,Y', $companyVisit['CompanyVisit']['pptdate'])); ?>&nbsp;</td>
		<td><?php echo h($this->Time->format('F jS,Y', $companyVisit['CompanyVisit']['visitdate1'])); ?>&nbsp;</td>
		<td><?php echo h($this->Time->format('F jS,Y', $companyVisit['CompanyVisit']['visitdate2'])); ?>&nbsp;</td>
		<td><?php echo h($this->Time->format('F jS,Y', $companyVisit['CompanyVisit']['visitdate3'])); ?>&nbsp;</td>
		<td><?php echo h($this->Time->format('F jS,Y', $companyVisit['CompanyVisit']['lastdate'])); ?>&nbsp;</td>
		<td><?php echo h($companyVisit['CompanyVisit']['placementtype']); ?>&nbsp;</td>
		<td><?php echo h($companyVisit['CompanyVisit']['placementvenue']); ?>&nbsp;</td>
		<td><?php 
		if($companyVisit['CompanyVisit']['recstatus'] == 1){
			echo "Active";	
		} else{
			echo "Not Active";
		}  ?>
	    &nbsp;</td>
	    <?php 
	    if (Auth::hasRoles(array('tpadmin'))){?>
		<td class="actions">
			<?php echo $this->Html->link(__('', true), array('action' => 'view', $companyVisit['CompanyVisit']['id']), array('class' => 'glyphicon glyphicon-search')); ?>
			<?php echo $this->Html->link(__('', true), array('action' => 'edit', $companyVisit['CompanyVisit']['id']), array('class' => 'glyphicon glyphicon-edit')); ?>
			<?php 
			if($companyVisit['CompanyVisit']['recstatus'] == 0){
				echo $this->Form->postLink(__('', true), array('action' => 'activate', $companyVisit['CompanyVisit']['id']), array('class' => 'glyphicon glyphicon-ok', 'escape' => false), null, __('Are you sure you want to Activate # %s?', $companyVisit['CompanyVisit']['id'])); 
			}
		?>
		<?php 
			if($companyVisit['CompanyVisit']['recstatus'] == 1){
				echo $this->Form->postLink(__('',true), array('action' => 'deactivate', $companyVisit['CompanyVisit']['id']), array('class' => 'glyphicon glyphicon-remove', 'escape' => false), null, __('Are you sure you want to Deactivate # %s?', $companyVisit['CompanyVisit']['id'])); 
			}
			?>
		</td>
		<?php } ?>
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
</div></div>
