<?php
Router::parseExtensions();
Router::connect('/feedback_system/:controller', array('plugin'=>'feedback_system'));
Router::connect('/feedback_system', array('plugin'=>'feedback_system','controller' => 'feedback_categories', 'action' => 'index'));
//Router::connect('/tickets', array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'tickets'));
//Router::connect('/createticket', array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'add'));
//Router::connect('/status', array('plugin'=>'support_ticket_systemcontroller' => 'statuses', 'action' => 'index'));
