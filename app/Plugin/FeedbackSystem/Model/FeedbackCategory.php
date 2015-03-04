<?php
App::uses('FeedbackSystemAppModel', 'FeedbackSystem.Model');
/**
 * FeedbackCategory Model
 *
 * @property Creator $Creator
 * @property Modifier $Modifier
 */
class FeedbackCategory extends FeedbackSystemAppModel {

/**
 * Validation rules
 *
 * @var array
 */
public $displayField = 'name';
	public $validate = array(
    'name' => array(
        'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'You must enter a category.'
        ),
        'unique' => array(
            'rule'    => 'isUnique',
            'message' => 'This category already exists'
        ),
    ),
);
	//The Associations below have been created with all possible keys, those that are not needed can be removed


	public $hasMany = ['FeedbackSystem.FeedbackManage','FeedbackSystem.FeedbackQuestion'];

    public $belongsTo = array('FeedbackSystem.FeedbackCategory','Staff','Institution');


}
