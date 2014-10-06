<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');

/**
 * CompanyVisit Model
 *
*/
class CompanyVisit extends TrainingAndPlacementAppModel {

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
    */
    public $belongsTo = ['TrainingAndPlacement.CompanyMaster'];

    /**
     * hasmany associations
     *
     * @var array
    */
    public $validate = [
    	'pptdate'          => ['notempty' => ['rule' => ['notempty'],'required' => true]],
        'visitdate1'       => ['notempty' => ['rule' => ['notempty'],'required' => true]],
    	'visitdate2'       => ['notempty' => ['rule' => ['notempty'],'required' => true]],
    	'visitdate3'       => ['notempty' => ['rule' => ['notempty'],'required' => true]],
    	'lastdate'         => ['notempty' => ['rule' => ['notempty'],'required' => true]],
    	'placementtype'    => ['notEmpty' => ['rule' => ['notEmpty','required' => true]],
    	'placementvenue'   => ['notEmpty' => ['rule' => ['notEmpty','required' => true]],
    ];

    /**
     * Import companyvisit data using csv file
     *
    */
    public function import($filename) {
        /** to avoid having to tweak the contents of
        * $data you should use your db field name as the heading name
        * eg: Post.id, Post.title, Post.description
        * set the filename to read CSV from
        */
        $filename = TMP . 'uploads' . DS . 'CompanyVisit' . DS . $filename;
         
        // open the file
        $handle = fopen($filename, "r");
         
        // read the 1st row as headings
        $header = fgetcsv($handle);
         
        // create a message container
        $return = []
            'messages' => []),
            'errors' => []),
        );
    		$i=0;
    		$error = null;
        // read each data row in the file
        while (($row = fgetcsv($handle)) !== FALSE) {
            $i++;
            $data = []);

            // for each header field
            foreach ($header as $k=>$head) {
                // get the data field from Model.field
                if (strpos($head,'.')!==false) {
                    $h = explode('.',$head);
                    $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
                }
                // get the data field from field
                else {
                    $data['CompanyVisit'][$head]=(isset($row[$k])) ? $row[$k] : '';
                }
            }

            // see if we have an id            
            $id = isset($data['CompanyVisit']['id']) ? $data['CompanyVisit']['id'] : 0;

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
