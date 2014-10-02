<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');
/**
 * Tasks Controller
 *
 * @property Task $Task
 * @property PaginatorComponent $Paginator
 */
class TasksController extends TrainingAndPlacementAppController {

public $helpers = array('Js','Html', 'Form', 'Time');

/**
 * index method
 *
 * @return void
 */
	function import() {
		if ($this->request->is('post')) {
          	
          	$filename = 'C:\Apache24\htdocs\cakephp\app\tmp\uploads\Task\\'.$this->data['Tasks']['file']['name']; 
          	$file = $this->data['Tasks']['file']['name'];
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension == 'csv'){
        	    if (move_uploaded_file($this->data['Tasks']['file']['tmp_name'],$filename)) {
            		$messages = $this->Task->import($this->data['Tasks']['file']['name']);
            		/* save message to session */
            		$this->Session->setFlash('File uploaded successfuly. You can view it <a href="C:\Apache24\htdocs\cakephp\app\tmp\uploads\Task\\'.$this->data['Tasks']['file']['name'].'">here</a>.');
            		/* redirect */
            		$this->redirect(array('action' => 'index'));
        		} else {
            	 /* save message to session */
            	 $this->Session->setFlash('There was a problem uploading file. Please try again.');
        		}
     		} else{
     			$this->Session->setFlash("Extension error");
     		}
     	}
    }

	public function index() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1, 'order' => array('dateoftask' => 'asc'));
		$this->set('tasks', $this->Paginator->paginate()); 
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
		$this->set('task', $this->Task->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Task->create();
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash('The task has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The task could not be saved. Please, try again.'));
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
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Task']['id']=$id;
			if ($this->Task->save($this->request->data,true,array('id','modifier_id','title','dateoftask','done'))) {
				$this->Session->setFlash(__('The task has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The task could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
			$this->request->data = $this->Task->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function delete($id = null) {
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid task'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Task->delete()) {
			$this->Session->setFlash(__('The task has been deleted.'));
		} else {
			$this->Session->setFlash(__('The task could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
}
