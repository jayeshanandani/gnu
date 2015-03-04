<?php
App::uses('FeedbackSystemAppModel', 'FeedbackSystem.Model');
/**
 * TicketManage Model
 *
 * @property Category $Category
 * @property Staff $Staff
 */
class FeedbackManage extends FeedbackSystemAppModel {

/**
 * Validation rules
 *
 * @var array
 */
public $validate = array(
     'category_id' => array(
        'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'You have to select category'
        ),
    ),
);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
 //public $belongsTo = ['Institution','Department','Staff'];
	public $belongsTo = array('FeedbackSystem.FeedbackCategory','Staff');//'FeedbackSystem.FeedbackManage'

}