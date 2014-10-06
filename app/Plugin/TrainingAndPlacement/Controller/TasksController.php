<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

/**
 * Tasks Controller
 *
 */
class TasksController extends TrainingAndPlacementAppController {

	public $helpers = ['Js','Html', 'Form', 'Time'];

	/**
	 * import method
	 *
	 * @return void
	*/
	public function import() {
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

	/**
	 * index method
	 *
	 * @return void
	*/
	public function index() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		
		$this->Paginator->settings = ['limit' => $pagination_value,'page' => 1, 'order' => ['dateoftask' => 'asc']];
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
		$options = ['conditions' => ['Task.' . $this->Task->primaryKey => $id]];
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
				return $this->redirect(['action' => 'index']);
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
		if ($this->request->is(['post', 'put'])) {
			$this->request->data['Task']['id']=$id;
			if ($this->Task->save($this->request->data,true, ['id','modifier_id','title','dateoftask','done'])) {
				$this->Session->setFlash(__('The task has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Session->setFlash(__('The task could not be saved. Please, try again.'));
			}
		} else {
			$options = ['conditions' => ['Task.' . $this->Task->primaryKey => $id];
			$this->request->data = $this->Task->find('first', $options);
		}
	}
}
