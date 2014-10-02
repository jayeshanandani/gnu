<?php
App::uses('AppModel', 'Model');
/**
 * Role Model
 *
 */
class Role extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'role';

  public $hasMany = [
    'UserRole' => [
      'className' => 'UserRole',
      'foreignKey' => 'role_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ]
  ];

}
