<?php
App::uses('AppModel', 'Model');
/**
 * Institution Model
 *
 * @property Department $Department
 */
class Institution extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
public $actsAs = ['WhoDidIt'];


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = ['Department','Staff','FeedbackSystem.FeedbackCategory'];

}
