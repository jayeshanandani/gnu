<div id="ticket">
  <div style="float:left;padding-left:50px"><?php echo $this->Html->link(__("Create new ticket",true),"/createticket") ?></div>
  <div style="float:left;padding-left:10px"><?php echo $this->Html->link(__("Open Tickets",true),"/staff") ?></div>
  <div style="float:left;padding-left:10px"><?php echo $this->Html->link(__("Closed tickets",true),"/categories") ?></div>
  <div style="float:left;padding-left:10px"><?php echo $this->Html->link(__("Overdue Tickets",true),"/tickets") ?></div>
  <div style="float:left;padding-left:10px"><?php echo $this->Html->link(__("Pending Tickets",true),"/staus") ?></div>
  <div style="float:left;padding-left:10px"><?php echo $this->Html->link(__("View my tickets",true),"/viewUser/")?></div>
  <div style="clear:both"></div>
</div>
