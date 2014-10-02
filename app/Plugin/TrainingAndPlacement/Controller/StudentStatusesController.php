<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class StudentStatusesController extends TrainingAndPlacementAppController {

/**
 * index method
 *
 * @return void
 */
	
	function import() {
		if ($this->request->is('post')) {
          	
          	$filename = 'C:\Apache24\htdocs\cakephp\app\tmp\uploads\StudentStatus\\'.$this->data['StudentStatuses']['file']['name']; 
          	$file = $this->data['StudentStatuses']['file']['name'];
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension == 'csv'){
        	    if (move_uploaded_file($this->data['StudentStatus']['file']['tmp_name'],$filename)) {
            	$messages = $this->StudentStatus->import($this->data['StudentStatus']['file']['name']);
            	/* save message to session */
            	$this->Session->setFlash('File uploaded successfuly. You can view it <a href="C:\Apache24\htdocs\cakephp\app\tmp\uploads\StudentStatus\\'.$this->data['StudentStatuses']['file']['name'].'">here</a>.');
            	/* redirect */
            	$this->redirect(array('action' => 'index'));
        		}
        		else {
            	/* save message to session */
            	$this->Session->setFlash('There was a problem uploading file. Please try again.');
        		}
     		}
     		else{
     			$this->Session->setFlash("Extension error");
     		}
     	}
    }

	public function student_status_form() {
		
		if ($this->request->is('post') && $this->request->data['StudentStatus']['academic_year_id']!=0) {
			$institute = $this->request->data['StudentStatus']['institution_id'];
			$department = $this->request->data['StudentStatus']['department_id'];
			$degree = $this->request->data['StudentStatus']['degree_id'];
			return $this->redirect(array('action' => 'index', $institute, $department,$degree));
		}
		unset($this->request->data['StudentStatus']['institution_id']);
		$this->loadModel('Institution');
		$institutions = $this->Institution->find('list');
		$departments = array();
		$degrees = array();
		$academic_years = array();
		$this->set(compact('institutions', 'departments', 'degrees','academic_years'));	

	}
	
	public function index($institute = null, $department = null, $degree = null) {
		$student_list = $this->StudentStatus->Student->find('list',array('conditions' => array('Student.institution_id' => $institute,'Student.degree_id' => $degree),'fields' => ['Student.id']));
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain'=>['Student'=>['conditions'=>['Student.id'=>$student_list]]],
			'conditions' => ['StudentStatus.student_id' => $student_list]
			);
		$this->set('studentStatuses', $this->Paginator->paginate());
	}

	public function display($student_id = null) {
		$student_id = $this->Auth->user('student_id');
		$student_status = $this->StudentStatus->find('all',[
			'conditions' => ['StudentStatus.student_id' => $student_id]	
			]);
		if($student_status == null)
		{
			return $this->redirect(array('action' => 'add'));
		}
		$this->set('studentStatuses',$student_status);			
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->StudentStatus->exists($id)) {
			throw new NotFoundException(__('Invalid student'));
		}
		$student_status = $this->StudentStatus->find('all',[
			'conditions' => ['StudentStatus.student_id' => $id]	
			]);
		$this->set('studentStatuses',$student_status);	
	}
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->StudentStatus->create();
			$student_id = $this->Auth->user('student_id');
			$this->request->data['StudentStatus']['flag'] = 1;
			$this->request->data['StudentStatus']['student_id'] = $student_id;
			if ($this->StudentStatus->save($this->request->data)) {
				$this->Session->setFlash('The Training/Job Status has been saved.');
				return $this->redirect(array('action' => 'display'));
			} else {
				$this->Session->setFlash(__('The Training/Job Status could not be saved. Please, try again.'));
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
	public function edit($id = null) {
		if (!$this->StudentStatus->exists($id)) {
			throw new NotFoundException(__('Invalid Training/Job Status'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['StudentStatus']['id'] = $id;
			if ($this->StudentStatus->save($this->request->data,true,array('id','modifier_id','student_id','trainingAt','companyname','project_title','project','training','job','post','salary'))) {
				$this->Session->setFlash(__('The Training/Job Status has been saved.'));
				return $this->redirect(array('action' => 'display'));
			} else {
				$this->Session->setFlash(__('The Training/Job Status could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('StudentStatus.' . $this->StudentStatus->primaryKey => $id));
			$this->request->data = $this->StudentStatus->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->StudentStatus->id = $id;
		if (!$this->StudentStatus->exists()) {
			throw new NotFoundException(__('Invalid stu status'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->StudentStatus->delete()) {
			$this->Session->setFlash(__('The stu status has been deleted.'));
		} else {
			$this->Session->setFlash(__('The stu status could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
}
