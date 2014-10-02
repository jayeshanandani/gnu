<?php
App::uses('AppModel', 'TrainingAndPlacement.Model');

class Student extends TrainingAndPlacementAppModel {

/**
 * Validation rules
 *
 * @var array
 */

public $validate = [];

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */

   public $belongsTo = ['Institution','Degree'];
   public $hasMany = ['TrainingAndPlacement.ResultBoard'];
}
