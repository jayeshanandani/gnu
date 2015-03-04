<?php
echo $this->Html->css('navigation');
?>
<br><div class="navbar navbar-default navbar-static-top" style="background-color:#fff">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
             <p style="padding-left: 20px;">   <?php echo $this->Html->image('gnulogo.png', array('alt' => 'GNU', 'border' => '0')); ?></p>
             </div>
        <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      <li><?php echo $this->Html->link(__("Home"),array('plugin'=>false,'controller' => 'users', 'action' => 'dashboard')) ?></li>
      <li><?php echo $this->Html->link(__("Dashboard"),array('plugin'=>'feedback_system','controller' => 'pages', 'action' => 'dashboard')) ?></li>
      <li class="dropdown menu-large">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Feedback System<b class="caret"></b></a>       
        <ul class="dropdown-menu megamenu row">
          <li class="col-sm-3">
            <ul>
              <?php if(Auth::hasRoles(['stadmin','superadmin'])) {?>
              <li class="dropdown-header">Feedback Categories & Events</li>
              <li><?php echo $this->Html->link(__("New General Category",true),array('plugin'=>'feedback_system','controller' => 'feedback_categories', 'action' => 'add')) ?></li>
              <li><?php echo $this->Html->link(__("View General Categories",true),array('plugin'=>'feedback_system','controller' => 'feedback_categories', 'action' => 'index'))  ?></li>
                <li><?php echo $this->Html->link(__("New Event",true),array('plugin'=>'feedback_system','controller' => 'feedback_events', 'action' => 'add'))  ?></li>
                 <li><?php echo $this->Html->link(__("View  Events",true),array('plugin'=>'feedback_system','controller' => 'feedback_events', 'action' => 'index'))  ?></li>


              <li class="divider"></li>
              <?php } ?>
              
              <li class="dropdown-header">Manage Staff</li>
              <li><?php echo $this->Html->link(__("New  Staff"),array('plugin'=>false,'controller' => 'staffs', 'action' => 'add')) ?></li>
                      <li><?php echo $this->Html->link(__("View all Staffs"), array('plugin'=>false,'controller' => 'staffs', 'action' => 'index'))?></li>
                 <?php if(Auth::hasRoles(['stcoordinator','user'] && !Auth::hasRoles(['stadmin']))) {?>
                         <li class="divider"></li>
                       <?php } ?>
                
            </ul>
          </li>
           <li class="col-sm-3">
            <ul>
             <li class="dropdown-header">Feedback Form</li>
              <li><?php echo $this->Html->link(__("Student General Feedback Form",true),array('plugin'=>'feedback_system','controller' => 'feedback_answers', 'action' => 'add')) ?></li>
              <li><?php echo $this->Html->link(__("Student  Event Feedback Form",true),array('plugin'=>'feedback_system','controller' => 'feedback_event_answers', 'action' => 'add')) ?></li>
              
               <li class="dropdown-header">Manages questions</li>
              <li><?php if(Auth::hasRoles(['stadmin','stcoordinator','superadmin']))  echo $this->Html->link(__("New questions for General Feedback"),array('plugin'=>'feedback_system','controller' => 'feedback_questions', 'action' => 'add')) ?></li>
                      <li><?php if(Auth::hasRoles(['stadmin','stcoordinator','superadmin'])) echo $this->Html->link(__("View all General questions "),array('plugin'=>'feedback_system','controller' => 'feedback_questions', 'action' => 'index')) ?></li>
                      <li><?php  if(Auth::hasRoles(['stadmin','stcoordinator','superadmin'])) echo $this->Html->link(__("New questions for Event"),array('plugin'=>'feedback_system','controller' => 'feedback_event_questions', 'action' => 'add')) ?></li>
                      <li><?php  if(Auth::hasRoles(['stadmin','stcoordinator','superadmin'])) echo $this->Html->link(__("View all questions for Event"),array('plugin'=>'feedback_system','controller' => 'feedback_event_questions', 'action' => 'index')) ?></li>
                      

               </ul>       
              </li>
               <?php if(Auth::hasRoles(['stadmin','superadmin'])) {?>
              <li class="col-sm-3">
              <ul>
             
              <li class="dropdown-header">Manage Coordinators</li>
              <li><?php echo $this->Html->link(__("New General Coordinator",true),array('plugin'=>'feedback_system','controller' => 'feedback_manages', 'action' => 'add')) ?></li>
                      <li><?php echo $this->Html->link(__("View General Coordinators"),array('plugin'=>'feedback_system','controller' => 'feedback_manages', 'action' => 'index')) ?></li>
                      <li><?php echo $this->Html->link(__("New Event Coordinator"),array('plugin'=>'feedback_system','controller' => 'feedback_event_manages', 'action' => 'add')) ?></li>
                      <li><?php echo $this->Html->link(__("View Event Coordinators"),array('plugin'=>'feedback_system','controller' => 'feedback_event_manages', 'action' => 'index')) ?></li>
            </ul>
          </li>
          <?php } ?>
          

          <?php if(Auth::hasRoles(['stadmin','superadmin'])) {?>
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">View</li>
          
             <li><?php if(Auth::hasRoles(['stadmin','stcoordinator','superadmin'])) { echo $this->Html->link(__("Settings"),array('plugin'=>'feedback_system','controller' => 'feedback_settings', 'action' => 'index')); } ?></li>
              <?php } ?>      
            </ul>

          </li>
            <?php if(Auth::hasRoles(['stcoordinator','user'] && !Auth::hasRoles(['stadmin']))) {?>
       <li><?php echo $this->Html->link(__("Logout",true),array('controller' => 'users' ,'action'=>'logout' ,'plugin'=>false)) ?></li> 
<?php } ?>
        </ul>
        
      </li>
      <?php if(Auth::hasRoles(['stadmin','superadmin'])) {?>
        <li><?php echo $this->Html->link(__("Logout",true),array('controller' => 'users' ,'action'=>'logout' ,'plugin'=>false)) ?></li> 
        <?php } ?>
    </ul>
    </div>
      </div>
    </div>