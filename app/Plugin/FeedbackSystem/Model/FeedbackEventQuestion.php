<?php
App::uses('FeedbackSystemAppModel', 'FeedbackSystem.Model');
/**
 * FeedbackEventQuestion Model
 *
 */
class FeedbackEventQuestion extends FeedbackSystemAppModel {

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
public $belongsTo = ['FeedbackEvent'];

}
