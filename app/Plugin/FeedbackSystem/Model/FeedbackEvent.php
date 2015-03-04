<?php
App::uses('FeedbackSystemAppModel', 'FeedbackSystem.Model');
/**
 * FeedbackEvent Model
 *
 * @property Created $Created
 * @property Modifier $Modifier
 * @property Event $Event
 */
class FeedbackEvent extends FeedbackSystemAppModel {

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
            'message' => 'You must enter a event.'
        ),
        'unique' => array(
            'rule'    => 'isUnique',
            'message' => 'This category already exists'
        ),
    ),
);

    public $belongsTo = ['Institution'];
}
