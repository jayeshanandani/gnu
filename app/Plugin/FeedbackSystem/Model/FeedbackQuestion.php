<?php
App::uses('FeedbackSystemAppModel', 'FeedbackSystem.Model');
/**
 * FeedbackQuestion Model
 *
 * @property Creator $Creator
 * @property Modifier $Modifier
 * @property Category $Category
 * @property Inform $Inform
 */
class FeedbackQuestion extends FeedbackSystemAppModel {

/**
 * Validation rules
 *
 * @var array
 */
public $displayField = 'text';
	public $validate = array(
    'text' => array(
        'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'You must enter a question.'
        ),
        'unique' => array(
            'rule'    => 'isUnique',
            'message' => 'This question already exists'
        ),
    ),
);
var $paginate = array(
'limit' => 4,
'order' => array(
'FeedbackQuestion.text' => 'asc'
)
);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
public $belongsTo = ['FeedbackSystem.FeedbackCategory','FeedbackSystem.FeedbackManage','Staff'];
public $hasMany = ['FeedbackAnswer'];


 
}
