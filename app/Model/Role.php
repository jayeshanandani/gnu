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

//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 * @var array
 */ 
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
