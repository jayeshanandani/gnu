<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');
/**
 * CompanyJob Model
 *
 * @property CompanyMaster $CompanyMaster
 */
class CompanyJob extends TrainingAndPlacementAppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'company_jobs';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'TrainingAndPlacement.CompanyMaster'
	);
    public function getListByCompany($cid = null) {
        if (empty($cid)) {
            return array();
        }
        return $this->find('list', array(
            'conditions' => array($this->alias . '.company_master_id' => $cid),
            //'order' => array($this->alias.'.name'=>'ASC')
        ));
    }
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'probationperiod' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'salary' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);

		function import($filename) {
        // to avoid having to tweak the contents of
        // $data you should use your db field name as the heading name
        // eg: Post.id, Post.title, Post.description
 
        // set the filename to read CSV from
        $filename = TMP . 'uploads' . DS . 'CompanyJob' . DS . $filename;
         
        // open the file
        $handle = fopen($filename, "r");
         
        // read the 1st row as headings
        $header = fgetcsv($handle);
         
        // create a message container
        $return = array(
            'messages' => array(),
            'errors' => array(),
        );
 		$i=0;
 		$error = null;
        // read each data row in the file
        while (($row = fgetcsv($handle)) !== FALSE) {
            $i++;
            $data = array();
 
            // for each header field
            foreach ($header as $k=>$head) {
                // get the data field from Model.field
                if (strpos($head,'.')!==false) {
                    $h = explode('.',$head);
                    $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
                }
                // get the data field from field
                else {
                    $data['CompanyJob'][$head]=(isset($row[$k])) ? $row[$k] : '';
                }
            }
 
            // see if we have an id            
            $id = isset($data['CompanyJob']['id']) ? $data['CompanyJob']['id'] : 0;
 
            // we have an id, so we update
            if ($id) {
                // there is 2 options here,
                  
                // option 1:
                // load the current row, and merge it with the new data
                //$this->recursive = -1;
                //$post = $this->read(null,$id);
                //$data['Post'] = array_merge($post['Post'],$data['Post']);
                 
                // option 2:
                // set the model id
                $this->id = $id;
            }
             
            // or create a new record
            else {
                $this->create();
            }
             
            // see what we have
            // debug($data);
             
            // validate the row
            $this->set($data);
            if (!$this->validates()) {
                //$this->setFlash(,'warning');
                $return['errors'][] = __(sprintf('Post for Row %d failed to validate.',$i), true);
            }
 
            // save the row
            if (!$error && !$this->save($data)) {
                $return['errors'][] = __(sprintf('Post for Row %d failed to save.',$i), true);
            }
 
            // success message!
            if (!$error) {
                $return['messages'][] = __(sprintf('Post for Row %d was saved.',$i), true);
            }
        }
         
        // close the file
        fclose($handle);
         
        // return the messages
        return $return;
         
    }
}
