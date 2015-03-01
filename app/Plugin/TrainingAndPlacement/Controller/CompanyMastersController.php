<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');
App::uses('CakeEmail', 'Network/Email');
class CompanyMastersController extends TrainingAndPlacementAppController {

public $helpers = array('Js','Html','Form');

	public function import() {
		if ($this->request->is('post')) {
          	$filename = 'C:\Apache24\htdocs\cakephp\app\tmp\uploads\CompanyMaster\\'.$this->data['CompanyMasters']['file']['name'];
          	$file = $this->request->data['CompanyMaster']['file']['name'];
          	$length = $this->CompanyMaster->check_file_uploaded_length($file);
          	$name = $this->CompanyMaster->name($file);
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension === 'csv' && $length && $name){
        	    if (move_uploaded_file($this->request->data['CompanyMaster']['file']['tmp_name'],$filename)) {
            	$messages = $this->CompanyMaster->import($file);
            	/* save message to session */
            	$this->Session->setFlash('File uploaded successfuly.');
            	/* redirect */
            	$this->redirect(array('action' => 'index'));
        	} else {
            	/* save message to session */
            	$this->Session->setFlash('There was a problem uploading file. Please try again.', 'alert', array(
   										 'class' => 'alert-danger'));
        	}
     	} else{
     			$this->Session->setFlash("Extension error", 'alert', array(
    									'class' => 'alert-danger'));
     		}
     	}
    }

/**
 * export_all method : Export all company details(Not : visit dates,jobs,eligibility,campus) 
 *
 * @return void
 */
public function export_all() {         
 	$this->set('companyMasters', $this->CompanyMaster->find('all',[ 
		'fields' => ['CompanyMaster.name','CompanyMaster.website','CompanyMaster.location','CompanyMaster.category','CompanyMaster.email','CompanyMaster.contactno','CompanyMaster.training','CompanyMaster.job'] 	
  	]));
    $this->layout = null;
   	$this->autoLayout = false;
}

public function index() {
		
		$this->Paginator->settings = array('limit' => 5,'page' => 1);
		$this->CompanyMaster->recursive = 0;

		$this->loadModel('User');
		$creator = $this->CompanyMaster->find('list',['fields' => ['CompanyMaster.creator_id']]);
		$modifier = $this->CompanyMaster->find('list',['fields' => ['CompanyMaster.modifier_id']]);
		$creator_name = $this->User->find('all',['conditions' => ['User.id' => $creator]]);
		$modifier_name = $this->User->find('all',['conditions' => ['User.id' => $modifier]]);
		
		$this->set('creator_name',$creator_name);
		$this->set('modifier_name',$modifier_name);
		$this->set('companyMasters', $this->Paginator->paginate());	
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function view($id = null) {
		if (!$this->CompanyMaster->exists($id)) {
			throw new NotFoundException(__('Invalid company master'));
		}
		$options = array('conditions' => array('CompanyMaster.' . $this->CompanyMaster->primaryKey => $id));
		$this->set('companyMaster', $this->CompanyMaster->find('first', $options));
	}
	
	
/**
 * add method
 *
 * @return void
 */

	public function add() {
		if ($this->request->is('post')) {
			$this->CompanyMaster->create();
			$password_gen = 'hello';
			$first_login = 1;

			if(!empty($this->request->data)){
				$this->request->data['CompanyMaster']['name'] = strtoupper($this->request->data['CompanyMaster']['name']);
				$this->request->data['User']['email'] = $this->request->data['CompanyMaster']['email'];
				$this->request->data['User']['fullname'] = $this->request->data['CompanyMaster']['name'];
				$this->request->data['User']['first_login'] = $first_login;
				$this->request->data['User']['password'] = AuthComponent::password($password_gen);
				
				if($this->CompanyMaster->User->save($this->request->data,true,array('email','username','fullname','password','first_login'))) {
					$last_id = $this->CompanyMaster->User->getLastInsertID();
					$this->request->data['CompanyMaster']['user_id'] = $last_id;
					$institution_id = $this->request->data['CompanyMaster']['institution_id'];
					$options = array('conditions' => array('AcademicYear.institution_id' => $institution_id), 'order' => array('AcademicYear.name DESC'), 'recursive' => -1);
					$data = $this->CompanyMaster->AcademicYear->find('first',$options);
					$academic_year_id = $data['AcademicYear']['id'];
					$this->request->data['CompanyMaster']['academic_year_id'] = $academic_year_id;
					debug($academic_year_id);
					if($this->CompanyMaster->save($this->request->data,true,array('name','email','institution_id','user_id','academic_year_id'))) {
						$this->Session->setFlash('Data saved');	
        				$this->CompanyMaster->User->Role->UserRole->create();
						$this->request->data['UserRole']['user_id'] = $last_id;
						$this->request->data['UserRole']['role_id'] = '6';
						if($this->CompanyMaster->User->Role->UserRole->save($this->request->data,true,array('user_id','role_id'))) {
							$user = $this->request->data['User']['username'];
					        $email_to = $this->request->data['CompanyMaster']['email'];
					        $subject = 'Welcome to GNU';
						$message = 'Your username is '.$user.' and password is '.$password_gen;
						CakeEmail::deliver($email_to, $subject, $message);
						$this->Session->setFlash('Email Sent');
						return $this->redirect('/users/dashboard');
					} 
					else {
							$this->Session->setFlash(__('Data not saved, please try again'));
					}
				}
			}
		}
	}
		$institutions = $this->CompanyMaster->Institution->find('list');
        $this->set(compact('institutions'));

	}

public function comp_detail()
	{
		
		$data = $this->CompanyMaster->find('first',array('conditions' => array('CompanyMaster.user_id' => $this->Auth->user('id')),'fields'=>array('id')));
		$id = $data['CompanyMaster']['id'];
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['CompanyMaster']['id'] = $id;
			if ($this->CompanyMaster->save($this->request->data,true,array('id','profile','website','location','category','contactno','job','training'))) {
				$this->Session->setFlash(__('The company details have been saved.'));
				return $this->redirect('/users/dashboard');
			} else {
				$this->Session->setFlash(__('The company details could not be saved. Please, try again.'));
			}
		}
		else {
				$options = array('conditions' => array('CompanyMaster.' . $this->CompanyMaster->primaryKey => $id));
				$this->request->data = $this->CompanyMaster->find('first', $options);
			} 
		}

	public function generatePassword ()
	{
        $length = 8;
        $password = "";
        $i = 0;
        $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
        while ($i < $length){
            $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
            if (!strstr($password, $char)) { 
                $password .= $char;
                $i++;
            }
        }
        return $password;
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$user_id = AuthComponent::user('id');
		if (!$this->CompanyMaster->exists($id)) {
			throw new NotFoundException(__('Invalid company master'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['CompanyMaster']['id']=$id;
			$this->request->data['CompanyMaster']['modifier_id'] = $user_id;
			if ($this->CompanyMaster->save($this->request->data,true,array('modifier_id','recstatus','name','profile','website','location','category','email','contactno','job','training'))) {
				$this->Session->setFlash(__('The company master has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company master could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CompanyMaster.' . $this->CompanyMaster->primaryKey => $id));
			$this->request->data = $this->CompanyMaster->find('first', $options);
		}
	}

	public function deactivate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyMaster->id = $id;
		if (!$this->CompanyMaster->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyMaster']['id']=$id;
		$this->request->data['CompanyMaster']['recstatus']= 0;

		if ($this->CompanyMaster->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been deactivated.'));
		} else {
			$this->Session->setFlash(__('The company could not be deactivated. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function activate($id = null) {
		if ($this->request->is(array('post', 'put'))){
			$this->CompanyMaster->id = $id;
		if (!$this->CompanyMaster->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->request->data['CompanyMaster']['id']=$id;
		$this->request->data['CompanyMaster']['recstatus']= 1;
		if ($this->CompanyMaster->save($this->request->data,true,array('id','recstatus'))) {
			$this->Session->setFlash(__('The company has been activated.'));
		} else {
			$this->Session->setFlash(__('The company could not be activated. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
		}
	}	
}
