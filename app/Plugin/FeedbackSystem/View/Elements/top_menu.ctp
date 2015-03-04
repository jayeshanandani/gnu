	<div class="subheader">
<?php echo $this->Html->image('gnulogo.png'); ?>
   <div class="right" id="cssmenu">
	<ul>
      <li class='active'><?php echo $this->Html->link(__("Home"),array('plugin'=>false,'controller' => 'users', 'action' => 'dashboard')) ?></li>
   	<li class='active'><?php echo $this->Html->link(__("Dashboard"),array('plugin'=>'feedback_system','controller' => 'pages', 'action' => 'dashboard')) ?></li>
   	<?php if(Auth::hasRoles(['stadmin','superadmin'])) {?>
   	<li class='has-sub'><?php echo $this->Html->link(__("Feedback Categories & Events"),"") ?>
      <ul>
         <li><?php echo $this->Html->link(__("New General Category",true),array('plugin'=>'feedback_system','controller' => 'feedback_categories', 'action' => 'add')) ?>
         </li>
         <li><?php echo $this->Html->link(__("View General Category",true),array('plugin'=>'feedback_system','controller' => 'feedback_categories', 'action' => 'index'))  ?>
         </li>
         <li><?php echo $this->Html->link(__("New Event",true),array('plugin'=>'feedback_system','controller' => 'feedback_events', 'action' => 'add'))  ?>
         </li>
         <li><?php echo $this->Html->link(__("View Events",true),array('plugin'=>'feedback_system','controller' => 'feedback_events', 'action' => 'index'))  ?>
         </li>

      </ul>
   	</li>
         <li class='has-sub'><?php echo $this->Html->link(__("Feedback Form"),"") ?>
      <ul>
         <li><?php echo $this->Html->link(__("Student Feedback Form "),array('plugin'=>'feedback_system','controller' => 'feedback_answers', 'action' => 'add')) ?>
         </li>
        
      </ul>
      </li>
      	<?php } ?>
   	<li class='has-sub'><?php echo $this->Html->link(__("Tickets"),"") ?>
      <ul>
         <li><?php echo $this->Html->link(__("New "),array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'add')) ?>
         </li>
         <li><?php echo $this->Html->link(__("View Tickets"), array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'index'))?>
         </li>
          <li><?php if(Auth::hasRoles(['stadmin','stcoordinator','superadmin'])) { echo $this->Html->link(__("New General Questions"),array('plugin'=>'feedback_system','controller' => 'feedback_questions', 'action' => 'add')); } ?>
         </li>
         <li><?php if(Auth::hasRoles(['stadmin','stcoordinator','superadmin'])) { echo $this->Html->link(__("View all tickets"), array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'adminindex')); }?>
         </li>
      </ul>
   	</li>
   	<?php if(Auth::hasRoles(['stadmin','superadmin'])) {?>
      <li class='has-sub'><?php echo $this->Html->link(__("Manage Coordinator"),"") ?>
      <ul>
         <li><?php echo $this->Html->link(__("New Coordinator",true),array('plugin'=>'support_ticket_system','controller' => 'ticket_manages', 'action' => 'add')) ?>
         </li>
         <li><?php echo $this->Html->link(__("View Coordinators"),array('plugin'=>'support_ticket_system','controller' => 'ticket_manages', 'action' => 'index')) ?>
         </li>
      </ul>
      </li>
      <li class='has-sub'><?php echo $this->Html->link(__("Reports"),"") ?>
       <ul>
         <li><?php echo $this->Html->link(__("Column Charts"),array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'column_tickets')) ?>
         </li>
         <li><?php echo $this->Html->link(__("Pie Chart"),array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'pie_tickets')) ?>
         </li>
      </ul>
      </li>
      <?php } ?>
      <li class='has-sub'><?php echo $this->Html->link(__("View"),"") ?>
       <ul>
          <li ><?php if(Auth::hasRoles(['stadmin','superadmin'])) { echo $this->Html->link(__("Settings"),array('plugin'=>'support_ticket_system','controller' => 'settings', 'action' => 'index')); } ?></li>
      	<li ><?php if(Auth::user('student_id')) { echo $this->Html->link(__("View Profile"),array('plugin'=>'support_ticket_system','controller' => 'students', 'action' => 'view', AuthComponent::user('student_id'))); } ?></li>
      	<li ><?php if(Auth::user('staff_id')) { echo $this->Html->link(__("View Profile"),array('plugin'=>'support_ticket_system','controller' => 'staffs', 'action' => 'view', AuthComponent::user('staff_id'))); } ?></li>
      </li>
      </ul>
      </li>
     <li ><?php echo $this->Html->link(__("Logout",true),array('controller' => 'users' ,'action'=>'logout' ,'plugin'=>false)) ?>
	</ul>


	<div class="clear-both"></div>
</div>


