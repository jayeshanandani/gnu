<?php
App::uses('AppModel', 'Model');


/**
 * User Model
 */

class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */

public $validate = [

        'username' => [
            'required' => [
                'rule' => ['notEmpty'],
                'message' => 'You must enter a username.'
            ],
            'unique' => [
                'rule'    => 'isUnique',
                'message' => 'This username has already been taken.'
            ],
        ],
        'password' => [
            'required' => [
                'rule' => ['notEmpty'],
                'message' => 'Please Enter Password.'
            ],
        ],
        'fullname' => [
            'required' => [
                'rule' => ['notEmpty'],
                'message' => 'You must enter your fullname.'
            ],
        ],
        'email' => array(
            'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Provide an email address'
            ),
            'validEmailRule' => array(
                    'rule' => array('email'),
                    'message' => 'Invalid email address'
            ),
            'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Email already registered'
            ),
        ),

        'password_repeat' => array(
        'length' => array(
        'rule'      => array('between', 5, 40),
        'message'   => 'Your password must be between 8 and 40 characters.',
    ),
        'compare'    => array(
        'rule'      => array('validate_passwords'),
        'message' => 'The passwords you entered do not match.',
    )
)
    ];

     //The Associations below have been created with all possible keys, those that are not needed can be removed
/**
 * belongsTo associations
 * @var array
 */

    public $belongsTo = ['Student','Staff','CompanyMaster'];
/**
 * hasMany associations
 * @var array
 */

    public $hasMany = ['SupportTicketSystem.Ticket'];

/**
 * hasAndBelongsToManyo associations
 * @var array
 */
    public $hasAndBelongsToMany = [
        'Role' =>
            [
                'className' => 'Role',
                'joinTable' => 'user_roles',
                'foreignKey' => 'user_id',
                'associationForeignKey' => 'role_id',
                'unique' => true,
            ]
    ];
}
