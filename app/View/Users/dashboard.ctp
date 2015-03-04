<div>
<?php print "Welcome {$fullname}"; ?>
</div>

<div>
<?php print  "Your last login was at ".$this->Time->nice($modified); ?>
</div>
<br>
<p>
<?php
    if (Auth::hasRoles(array('company'))) {
        echo $this->Html->link('Change Password',array('controller' => 'users' ,'action'=>'change_password_company')); 
    }
?>
</p>

<div class="row">
<?php
 if (!Auth::hasRoles(array('company'))) {
  echo "<div class='col-md-3'>";
  echo $this->Html->link(
    $this->Html->image('support-ticket.png', ['alt' => 'support-ticket','height'=>'179 px','width'=>'215 px']),
    [
        'plugin' => 'support_ticket_system',
        'controller' => 'pages',
        'action' => 'dashboard',
    ],['escape' => false]
); 
  echo "</div>";
}?>


 <?php
 if (!Auth::hasRoles(array('company'))) {
    echo "<div class='col-md-3'>";
    
    echo $this->Html->link(
    $this->Html->image('feedback.png', ['alt' => 'feedback_system']),
    [
        'plugin' => 'feedback_system',
        'controller' => 'pages',
        'action' => 'dashboard',
    ],['escape' => false]
);
    echo "</div>";
}?>


<?php
echo "<div class='col-md-3'>";
if (Auth::hasRoles(array('tpadmin'))) {
    echo $this->Html->link(
        $this->Html->image('placement.gif', ['alt' => 'training_and_placement']),
        [
            'plugin' => 'training_and_placement',
            'controller' => 'company_campuses',
            'action' => 'home',
        ],['escape' => false]
    );
} else if (Auth::hasRoles(['company'])) {
    if(AuthComponent::user('first_login')) {
        echo $this->Html->link($this->Html->image('placement.gif', ['alt' => 'training_and_placement']),
                              [
                                     'plugin' => 'training_and_placement',
                                     'controller' => 'company_masters',
                                     'action' => 'comp_detail',
                                     
                              ],['escape' => false]
    );
  } else {
        echo $this->Html->link(
         $this->Html->image('placement.gif', ['alt' => 'training_and_placement']),
                            [
                                   'plugin' => 'training_and_placement',
                                   'controller' => 'company_campuses',
                                   'action' => 'com_home',
                            ],['escape' => false]
        );
  }
} else {
  echo $this->Html->link(
    $this->Html->image('placement.gif', ['alt' => 'training_and_placement']),
    [
        'plugin' => 'training_and_placement',
        'controller' =>'placement_results',
        'action' => 'student_home',
    ],['escape' => false]
  );  
}
echo "</div>";
?>
</div>
</p>