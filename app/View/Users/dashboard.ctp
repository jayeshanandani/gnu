<br>
<p>
<?php print "Welcome {$fullname}"; ?>
</p>
<p>
<?php print  "Your last login was at ".$this->Time->nice($modified); ?></p>
<p>
<?php    echo $this->Html->link('Logout',['controller' => 'users' ,'action'=>'logout']); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
    if (Auth::hasRoles(array('company'))) {
    echo $this->Html->link('Change Password',['controller' => 'users' ,'action'=>'change_password_company']); 
    }
?>
    </p>
<p>
 <?php
 //Just  added ! here so that the comapny cant view support ticket
 if (!Auth::hasRoles(array('company'))) {
echo $this->Html->link(
    $this->Html->image('support-ticket.png', ['alt' => 'support-ticket']),
    [
        'plugin' => 'support_ticket_system',
        'controller' => 'pages',
        'action' => 'dashboard',
    ],['escape' => false]
);
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if (Auth::hasRoles(array('tpadmin'))) {
echo $this->Html->link(
    $this->Html->image('placement.gif', ['alt' => 'training_and_placement']),
    [
        'plugin' => 'training_and_placement',
        'controller' => 'company_campuses',
        'action' => 'home',
    ],['escape' => false]
);
}
//Code ADDED HERE:
elseif (Auth::hasRoles(array('company'))) {
    if(AuthComponent::user('first_login'))
    {
        
        echo $this->Html->link($this->Html->image('placement.gif', ['alt' => 'training_and_placement']),
    [
           'plugin' => 'training_and_placement',
           'controller' => 'company_masters',
           'action' => 'comp_detail',
           
    ],['escape' => false]
);}
else
{
    echo $this->Html->link(
     $this->Html->image('placement.gif', ['alt' => 'training_and_placement']),
    [
           'plugin' => 'training_and_placement',
           'controller' => 'company_campuses',
           'action' => 'com_home',
    ],['escape' => false]
);
}
} 
else {
  echo $this->Html->link(
    $this->Html->image('placement.gif', ['alt' => 'training_and_placement']),
    [
        'plugin' => 'training_and_placement',
        'controller' =>'placement_results',
        'action' => 'student_home',
    ],['escape' => false]
);  
}
?>
</p>