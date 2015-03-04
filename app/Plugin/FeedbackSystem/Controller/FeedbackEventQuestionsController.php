<?php
App::uses('FeedbackSystemAppController', 'FeedbackSystem.Controller');
/**
 * FeedbackEventQuestions Controller
 *
 * @property FeedbackEventQuestion $FeedbackEventQuestion
 * @property PaginatorComponent $Paginator
 */
class FeedbackEventQuestionsController extends FeedbackSystemAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->FeedbackEventQuestion->recursive = 0;
		$this->set('feedbackEventQuestions', $this->Paginator->paginate());*/
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1, 'contain' => ['FeedbackEvent']);
		$this->set('feedbackEventQuestions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FeedbackEventQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid feedback event question'));
		}
		$options = array('conditions' => array('FeedbackEventQuestion.' . $this->FeedbackEventQuestion->primaryKey => $id));
		$this->set('feedbackEventQuestion', $this->FeedbackEventQuestion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
	if ($this->request->is('post')) {
			$this->FeedbackEventQuestion->create();
			if ($this->FeedbackEventQuestion->save($this->request->data,true,array('feedback_event_id','text','creator_id'))) {
				$this->request->data['FeedbackEvent']['id'] = $this->request->data['FeedbackQuestion']['feedback_event_id'];
			    $this->request->data['FeedbackEvent']['flag'] = 1;
				if($this->FeedbackEventQuestion->FeedbackEvent->save($this->request->data,true,['id','flag','modifier_id'])) {
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$this->request->data['UserRole']['role_id'] = 6;
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The feedback question has been saved.'), 'default', array('class' => 'alert alert-success'));
						return $this->redirect(array('action' => 'index'));
					}	
				}
			} else {
				$this->Session->setFlash(__('The feedback question could not be saved. Please, try again.'));
			}
		}
		unset($this->request->data['FeedbackEventQuestion']['feedback_event_id']);
		
        $events = $this->FeedbackEventQuestion->FeedbackEvent->find('list');
	
		$this->set(compact('events'));
		}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FeedbackEventQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid feedback event question'));
		}
		$this->request->data['FeedbackEventQuestion']['id'] = $id;
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FeedbackEventQuestion->save($this->request->data,true,array('id','text'))) {
				$this->Session->setFlash(__('The feedback event question has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback event question could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('FeedbackEventQuestion.' . $this->FeedbackEventQuestion->primaryKey => $id));
			$this->request->data = $this->FeedbackEventQuestion->find('first', $options);
		}
		$createdBies = $this->FeedbackEventQuestion->CreatedBy->find('list');
		$modifiedBies = $this->FeedbackEventQuestion->ModifiedBy->find('list');
		$this->set(compact('createdBies', 'modifiedBies'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FeedbackEventQuestion->id = $id;
		if (!$this->FeedbackEventQuestion->exists()) {
			throw new NotFoundException(__('Invalid feedback event question'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FeedbackEventQuestion->delete()) {
			$this->Session->setFlash(__('The feedback event question has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The feedback event question could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function deactivate($id = null) {
        if ($this->request->is(['post', 'put'])) {
            $this->FeedbackEventQuestion->id = $id;
            if (!$this->FeedbackEventQuestion->exists()) {
                throw new NotFoundException(__('Invalid FeedbackEventQuestion'));
            }
            $this->request->data['FeedbackEventQuestion']['id'] = $id;
            $this->request->data['FeedbackEventQuestion']['recstatus'] = 0;
            if ($this->FeedbackEventQuestion->save($this->request->data,true,['id','recstatus','modifier_id'])) {
            	$data = $this->FeedbackEventQuestion->find('first',['conditions'=>['FeedbackEventQuestion.id'=>$id]]);
            	$feedback_event_id = $data['FeedbackEventQuestion']['feedback_event_id'];
            	$this->request->data['FeedbackEvent']['id'] = $feedback_event_id;
			    $this->request->data['FeedbackEvent']['flag'] = 0;
			    if($this->FeedbackEventQuestion->FeedbackEvent->save($this->request->data,true,['id','flag','modifier_id'])){
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			         $this->request->data['UserRole']['recstatus'] = 0;
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The question has been deactivated.'), 'default', array('class' => 'alert alert-success'));
						return $this->redirect(array('action' => 'index'));
					}	
            	}
            } else {
                $this->Session->setFlash(__('The question cannot be deactivated. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
    }
    public function activate($id = null) {
        if ($this->request->is(['post', 'put'])) {
            $this->FeedbackEventQuestion->id = $id;
            if (!$this->FeedbackEventQuestion->exists()) {
                throw new NotFoundException(__('Invalid FeedbackEventQuestion'));
            }
           
            $this->request->data['FeedbackEventQuestion']['id'] = $id;
            $this->request->data['FeedbackEventQuestion']['recstatus'] = 1;
            if ($this->FeedbackEventQuestion->save($this->request->data,['id','recstatus','modifier_id'])) {
                $this->Session->setFlash(__('The question has been activated.'), 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash(__('The question cannot be activated. Please, try again.'));
            }
           return $this->redirect(['action' => 'index']);
        }
    }

}