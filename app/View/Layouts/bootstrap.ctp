<!DOCTYPE html>
<html lang="en">
  <head>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<?php
		echo $this->Html->meta('icon');
	?>

  <?php
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->script('jquery.min');
    echo $this->Html->script('fade');
    echo $this->Html->script('bootstrap.min');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
  </head>
  <body>
    <div class="row" style="width:100%;">
      <div class="span4">
        <?php 
            if($this->Session->check('Auth.User.id')) {
                echo $this->Element('navigation');
            } else {
                echo $this->Element('login');
            }
        ?>
       </div>
    </div>
    
    <div class="container">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
    </div>
  </body>
</html>
