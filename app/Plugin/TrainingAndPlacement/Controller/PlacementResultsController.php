<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class PlacementResultsController extends TrainingAndPlacementAppController {

	public $helpers = array('Js');


	public function import() {
		if ($this->request->is('post')) {      	
          	$filename = 'C:\Apache24\htdocs\cakephp\app\tmp\uploads\PlacementResult\\'.$this->data['PlacementResults']['file']['name']; 
          	$file = $this->data['PlacementResults']['file']['name'];
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension == 'csv'){
        	    if (move_uploaded_file($this->data['PlacementResults']['file']['tmp_name'],$filename)) {
            		$messages = $this->PlacementResult->import($this->data['PlacementResults']['file']['name']);
            		/* save message to session */
            		$this->Session->setFlash('File uploaded successfuly. You can view it <a href="C:\Apache24\htdocs\cakephp\app\tmp\uploads\PlacementResult\\'.$this->data['PlacementResults']['file']['name'].'">here</a>.');
            		/* redirect */
            		$this->redirect(['action' => 'index']);
        		} else {
            		/* save message to session */
            		$this->Session->setFlash('There was a problem uploading file. Please try again.');
        		}
     		} else{
     			$this->Session->setFlash("Extension error");
     		}
     	}
    }
	
	public function form1() {
		if ($this->request->is('post')  && $this->request->data['PlacementResult']['degree_id']!=0) {
			$institute 		= $this->request->data['PlacementResult']['institution_id'];
			$department 	= $this->request->data['PlacementResult']['department_id'];
			$degree 		= $this->request->data['PlacementResult']['degree_id'];
			$company 		= $this->request->data['PlacementResult']['company_master_id'];
			return $this->redirect(['action' => 'index',$institute,$department,$degree,$company]);
		}
		unset($this->request->data['PlacementResult']['institution_id']);

		$this->loadModel('Institution');
		$institutions 		= $this->Institution->find('list');
		$departments 		= [];
		$degrees 			= [];
		
		$this->loadModel('CompanyMaster');
		$companyMasters 	= $this->CompanyMaster->find('list');
		$this->set(compact('institutions', 'departments', 'degrees', 'companyMasters'));	
	}

	public function selected_students($institute = null,$department = null,$degree = null,$company = null) {
		$data = $this->PlacementResult->find('all', [
    		'contain'	=> ['Student' => [
        	'fields'	=> ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]]      
        	],'conditions' => ['PlacementResult.company_campus_id' => $company, 'PlacementResult.status' => 'Appointed']
    	]);

    	$campus_ids = $this->PlacementResult->find('list', [
    		'conditions' 	=> ['PlacementResult.status' => 'Appointed'],
    		'fields' 		=> ['PlacementResult.company_campus_id']
    	]);

    	$this->loadModel('TrainingAndPlacement.CompanyCampus');
    	$this->loadModel('TrainingAndPlacement.CompanyMaster');

    	$company_ids = $this->CompanyCampus->find('list', [
    		'conditions' 	=> ['CompanyCampus.id' => $campus_ids],
    		'fields' 		=> ['CompanyCampus.company_master_id']
    	]);
    	
    	$company = $this->CompanyMaster->find('all', [
    		'conditions' 	=> ['CompanyMaster.id' => $company_ids],
    		'fields' 		=> ['CompanyMaster.name']
    	]);

    	$this->set('data',$data);
    	$this->set('company',$company);
    	$this->set($this->Paginator->paginate());	
	}

	public function index($institute = null, $department = null, $degree = null, $company = null) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain' => [
        		'Student' => [
        		'fields' => ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]
        		]	      
        	],'conditions' => ['PlacementResult.company_campus_id' => $company]
		);
		$this->set('PlacementResults', $this->Paginator->paginate());

		$this->loadModel('Institution');
		$this->loadModel('Department');
		$this->loadModel('Degree');
		$this->loadModel('TrainingAndPlacement.CompanyMaster');
		
		$company_institute		= $this->Institution->find('all', array('conditions' => array('Institution.id' => $institute), 'field' => array('Institution.name')));
		$company_department		= $this->Department->find('all', array('conditions' => array('Department.id' => $department), 'field' => array('Department.name')));	
		$company_degree			= $this->Degree->find('all', array('conditions' => array('Degree.id' => $degree), 'field' => array('Degree.name')));	
		$company_name			= $this->CompanyMaster->find('all',['conditions'=>['CompanyMaster.id'=>$company],'fields'=>['CompanyMaster.name']]);
		
		$this->set('company_name',$company_name);
 		$this->set('company_department',$company_department);
		$this->set('company_institute',$company_institute);
		$this->set('company_degree',$company_degree);

		$this->set('company',$company);
 		$this->set('department',$department);
		$this->set('institute',$institute);
		$this->set('degree',$degree);

	}
public function student_list($institute = null,$department = null,$degree = null,$company = null) {
		$this->loadModel('Setting');
		$data				= $this->Setting->find('first');
		$pagination_value 	= $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain'	=> ['Student' => [
        	'fields'	=> ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]
        		]      
        	],'conditions' => ['PlacementResult.company_campus_id' => $company]
		);
		$this->set('PlacementResults', $this->Paginator->paginate());

		$this->loadModel('Institution');
		$this->loadModel('Department');
		$this->loadModel('Degree');
		$this->loadModel('TrainingAndPlacement.CompanyMaster');

		$institute 		= $this->Institution->find('all', array('conditions' => array('Institution.id' => $institute), 'field' => array('Institution.name')));
		$branch 		= $this->Department->find('all', array('conditions' => array('Department.id' => $department), 'field' => array('Department.name')));	
		$degree 		= $this->Degree->find('all', array('conditions' => array('Degree.id' => $degree), 'field' => array('Degree.name')));	
		$company_name 	= $this->CompanyMaster->find('all',['conditions'=>['CompanyMaster.id'=>$company],'fields'=>['CompanyMaster.name']]);
		
		$this->set('company_name',$company_name);
		$this->set('branch',$branch);
		$this->set('institute',$institute);
		$this->set('department',$department);
		$this->set('degree',$degree);
		$this->set($this->Paginator->paginate());
	}

	public function appointed_status($institute = null,$department = null,$degree = null,$company = null) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain' => [
        		'Student' => [
        			'fields' => ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]
        		]      
        	],'conditions' => ['PlacementResult.company_campus_id' => $company,'PlacementResult.status' => 'Appointed']
		);
		$this->set('PlacementResults', $this->Paginator->paginate());

		$this->loadModel('Institution');
		$this->loadModel('Department');
		$this->loadModel('Degree');
		$this->loadModel('TrainingAndPlacement.CompanyMaster');

		$institute = $this->Institution->find('all', array('conditions' => array('Institution.id' => $institute), 'field' => array('Institution.name')));
		$branch = $this->Department->find('all', array('conditions' => array('Department.id' => $department), 'field' => array('Department.name')));	
		$degree = $this->Degree->find('all', array('conditions' => array('Degree.id' => $degree), 'field' => array('Degree.name')));	
		$company_name = $this->CompanyMaster->find('all',['conditions'=>['CompanyMaster.id'=>$company],'fields'=>['CompanyMaster.name']]);
		
		$this->set('company_name',$company_name);
		$this->set('branch',$branch);
		$this->set('institute',$institute);
		$this->set('department',$department);
		$this->set('degree',$degree);
	}

	public function notqualified_status($institute = null, $department = null, $degree = null, $company = null) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain' => [
        		'Student' => [
        			'fields' => ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]
        		]      
        	],'conditions' => ['PlacementResult.company_campus_id' => $company,'PlacementResult.status' => 'Not Qualified']
		);
		$this->set('PlacementResults', $this->Paginator->paginate());

		$this->loadModel('Institution');
		$this->loadModel('Department');
		$this->loadModel('Degree');
		$this->loadModel('TrainingAndPlacement.CompanyMaster');

		$institute = $this->Institution->find('all', array('conditions' => array('Institution.id' => $institute), 'field' => array('Institution.name')));
		$branch = $this->Department->find('all', array('conditions' => array('Department.id' => $department), 'field' => array('Department.name')));	
		$degree = $this->Degree->find('all', array('conditions' => array('Degree.id' => $degree), 'field' => array('Degree.name')));	
		$company_name = $this->CompanyMaster->find('all',['conditions'=>['CompanyMaster.id'=>$company],'fields'=>['CompanyMaster.name']]);
		
		$this->set('company_name',$company_name);
		$this->set('branch',$branch);
		$this->set('institute',$institute);
		$this->set('department',$department);
		$this->set('degree',$degree);
	}

	public function pending_status($institute = null, $department = null, $degree = null, $company = null) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain' => [
        		'Student' => [
        			'fields' => ['id','firstname','lastname'],'conditions' => ['Student.institution_id' => $institute, 'Student.degree_id' => $degree]
        	]      
        ],'conditions' => ['PlacementResult.company_campus_id' => $company,'PlacementResult.status' => 'Pending']);
		
		$this->set('PlacementResults', $this->Paginator->paginate());

	$this->loadModel('Institution');
	$this->loadModel('Department');
	$this->loadModel('Degree');
	$this->loadModel('TrainingAndPlacement.CompanyMaster');

	$institute = $this->Institution->find('all', array('conditions' => array('Institution.id' => $institute), 'field' => array('Institution.name')));
	$branch = $this->Department->find('all', array('conditions' => array('Department.id' => $department), 'field' => array('Department.name')));	
	$degree = $this->Degree->find('all', array('conditions' => array('Degree.id' => $degree), 'field' => array('Degree.name')));	
	$company_name = $this->CompanyMaster->find('all',['conditions'=>['CompanyMaster.id'=>$company],'fields'=>['CompanyMaster.name']]);

	$this->set('institute',$institute);
	$this->set('branch',$branch);
	$this->set('degree',$degree);
	$this->set('company_name',$company_name);
	
}

public function display() {
	$student_id = $this->Auth->user('student_id');
	$this->loadModel('Setting');
	$data = $this->Setting->find('first');
	$pagination_value = $data['Setting']['pagination_value'];
	
	$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
        'contain' => [
        	'CompanyCampus' => [ 
        		'fields' => ['id','company_master_id'],
            	'CompanyMaster' => [
                	'fields' => ['id','name']
            	]
         	],
        	'Student' => [
        		'fields' => ['id','firstname','lastname']
        	]      
        ],'conditions'=>['PlacementResult.student_id'=>$student_id]);

		$this->set('PlacementResults', $this->Paginator->paginate());
	
}

public function student_home() {
	$this->loadModel('Student');
	$student_id = $this->Auth->user('student_id');
	$degree_id = $this->Student->find('list',[
		'conditions' => ['Student.id' => $student_id],
		'fields' => ['Student.degree_id']
	]);

	$data = $this->PlacementResult->find('all', [
    	'contain' => [
        	'CompanyCampus' => [ 
        		'fields' => ['id','company_master_id'],
            	'CompanyMaster' => [
                	'fields' => ['id','name']
            	]
        	],
        	'Student' => [
        		'fields' => ['id','firstname','lastname']
        	]      
    	],'conditions'=>['PlacementResult.student_id'=> $student_id ]]
	);
	$this->loadModel('CompanyMaster');
	
	$company_id = $this->PlacementResult->CompanyCampus->find('list',[
		'fields' => ['CompanyCampus.company_master_id'],
		'conditions'=>['CompanyCampus.degree_id' => $degree_id,'CompanyCampus.recstatus' => 1]
	]);
		
	$companies = $this->CompanyMaster->find('all',['conditions' => ['CompanyMaster.id' => $company_id,'CompanyMaster.recstatus' => 1],'field' => ['CompanyMaster.name']]);
	$training = $this->CompanyMaster->find('all',['conditions' => ['CompanyMaster.id' => $company_id,'CompanyMaster.recstatus' => 1,'CompanyMaster.training' => 1],'field' => ['CompanyMaster.name']]);
	$job = $this->CompanyMaster->find('all',['conditions' => ['CompanyMaster.id' => $company_id,'CompanyMaster.recstatus' => 1,'CompanyMaster.job' => 1],'field' => ['CompanyMaster.name']]);

	$this->set('data',$data);
	$this->set('companies',$companies);
	$this->set('training',$training);
	$this->set('job',$job);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PlacementResult->exists($id)) {
			throw new NotFoundException(__('Invalid placement result'));
		}
		$options = array('conditions' => array('PlacementResult.' . $this->PlacementResult->primaryKey => $id));
		$this->set('placementResult', $this->PlacementResult->find('first', $options));
	}

	public function apply_company($company_campus_id, $student_id) {
		$user_id = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$this->PlacementResult->create();
			$this->request->data['PlacementResult']['student_id'] = $student_id;
			$this->request->data['PlacementResult']['status'] = 'Not Qualified';
			$this->request->data['PlacementResult']['company_campus_id'] = $company_campus_id;
			$this->request->data['PlacementResult']['stu_campus'] = $company_campus_id.''.$student_id;
			if ($this->PlacementResult->save($this->request->data)) {
					$this->Session->setFlash('You are successfully applied for Company.');
				} else {
					$this->Session->setFlash(__('You are already applied for this company'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null, $institute = null, $department = null, $degree = null, $company = null) {
		$user_id = AuthComponent::user('id');	
		if (!$this->PlacementResult->exists($id)) {
			throw new NotFoundException(__('Invalid placement result'));
		}
		if ($this->request->is(array('post', 'put'))) {
					
			$this->request->data['PlacementResult']['id']=$id;
			
			if ($this->PlacementResult->save($this->request->data,true,array('modifier_id','company_master_id','verbal','aptitude','interview','gd','hr','status'))) {
				$this->Session->setFlash(__('The placement result has been saved.'));
				return $this->redirect(array('action' => 'index',$institute,$department,$degree,$company));
			} else {
				$this->Session->setFlash(__('The placement result could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PlacementResult.' . $this->PlacementResult->primaryKey => $id));
			$this->request->data = $this->PlacementResult->find('first', $options);
		}
		
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */ // Not yet used
/*	public function delete($id = null) {
		$this->PlacementResult->id = $id;
		if (!$this->PlacementResult->exists()) {
			throw new NotFoundException(__('Invalid placement result'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PlacementResult->delete()) {
			$this->Session->setFlash(__('The placement result has been deleted.'));
		} else {
			$this->Session->setFlash(__('The placement result could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
}
