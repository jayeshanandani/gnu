<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');
/**
 * ReferredCompany Model
 *
 */
class ReferredCompany extends TrainingAndPlacementAppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'referred_companies';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'companyname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'location' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'website' => array(
			'notEmpty' => array(
				'rule' => array('url'),
				'message' => 'Your Web url is invalid',
				//'allowEmpty' => false,
				'required' => true,
				'url' => 'url',
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'referance' => array(
			'notEmpty' => array(
				'rule' => array('isUnique'),
				'message' => 'reference is already registered',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
