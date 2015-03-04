<?php
App::uses('FeedbackSystemAppController', 'FeedbackSystem.Controller');
/**
 * FeedbackEventManages Controller
 *
 */
class FeedbackEventManagesController extends FeedbackSystemAppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $components = array('Paginator');

public function index() {
		
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1, 'contain' => ['FeedbackEvent','Staff']);
		$this->set('feedbackEventManages', $this->Paginator->paginate());
	}
	public function view($id = null) {
		if (!$this->FeedbackEventManage->exists($id)) {
			throw new NotFoundException(__('Invalid feedback event manage'));
		}
		$options = array('conditions' => array('FeedbackEventManage.' . $this->FeedbackEventManage->primaryKey => $id),'recursive'=>-1,'contain'=>['FeedbackEvent','Staff']);
		$this->set('feedbackEventManage', $this->FeedbackEventManage->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post') && $this->request->data['FeedbackEventManage']['staff_id'] != 0) {
			$this->FeedbackEventManage->create();
			if ($this->FeedbackEventManage->save($this->request->data,true,array('feedback_event_id','staff_id','creator_id'))) {
				$this->request->data['FeedbackEvent']['id'] = $this->request->data['FeedbackEventManage']['feedback_event_id'];
			    $this->request->data['FeedbackEvent']['flag'] = 1;
			    if($this->FeedbackEventManage->FeedbackEvent->save($this->request->data,true,['id','flag','modifier_id'])) {
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$staffid = $this->request->data['FeedbackEventManage']['staff_id'];
			    	$data = $this->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]);
			    	$this->request->data['UserRole']['user_id'] = $data['User']['id'];
			    	$this->request->data['UserRole']['role_id'] = 6;
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The event coordinator has been saved.'), 'default', array('class' => 'alert alert-success'));
						return $this->redirect(array('action' => 'index'));
					}	
				}
			} else {
				$this->Session->setFlash(__('The event coordinator could not be saved. Please, try again.'));
			}

		}
       unset($this->request->data['FeedbackEventManage']['feedback_event_id']);
		$institutions = $this->FeedbackEventManage->Staff->Institution->find('list');
		$feedbackevents = $this->FeedbackEventManage->FeedbackEvent->find('list');
		$departments = [];//$this->FeedbackEventManage->Staff->Department->find('list');
		//$departments = $this->FeedbackEventManage->Staff->Department->find('list');
		$staffs = [];
		$this->set(compact('institutions', 'departments', 'staffs','feedbackevents'));
}

public function edit($id = null) {
		if (!$this->FeedbackEventManage->exists($id)) {
			throw new NotFoundException(__('Invalid event manage'));
		}
		if ($this->request->is(['post', 'put'])) {
			if ($this->FeedbackEventManage->save($this->request->data)) {
				$this->Session->setFlash(__('The event manage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event manage could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FeedbackEventManage.' . $this->FeedbackEventManage->primaryKey => $id));
			$this->request->data = $this->FeedbackEventManage->find('first', $options);
		}
		$events = $this->FeedbackEventManage->Category->find('list');
		$staffs = $this->FeedbackEventManage->Staff->find('list');
		$this->set(compact('events', 'staffs'));
	}

  public function deactivate($id = null) {
        if ($this->request->is(['post', 'put'])) {
            $this->FeedbackEventManage->id = $id;
            if (!$this->FeedbackEventManage->exists()) {
                throw new NotFoundException(__('Invalid FeedbackEventManage'));
            }
            $this->request->data['FeedbackEventManage']['id'] = $id;
            $this->request->data['FeedbackEventManage']['recstatus'] = 0;
            if ($this->FeedbackEventManage->save($this->request->data,true,['id','recstatus','modifier_id'])) {
            	$data = $this->FeedbackEventManage->find('first',['conditions'=>['FeedbackEventManage.id'=>$id]]);
            	$feedback_event_id = $data['FeedbackEventManage']['feedback_event_id'];
            	$this->request->data['FeedbackEvent']['id'] = $feedback_event_id;
			    $this->request->data['FeedbackEvent']['flag'] = 0;
			    if($this->FeedbackEventManage->FeedbackEvent->save($this->request->data,true,['id','flag','modifier_id'])){
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$staffid = $data['FeedbackEventManage']['staff_id'];
			    	$data = $this->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]);
			    	$this->request->data['UserRole']['user_id'] = $data['User']['id'];
			    	$data1 = $this->UserRole->find('first',['conditions'=>['UserRole.user_id'=>$data['User']['id'],
			    														  'UserRole.recstatus'=>1]]);
			    	$this->request->data['UserRole']['id'] = $data1['UserRole']['id'];
			    	$this->request->data['UserRole']['recstatus'] = 0;
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The coordinator has been deactivated.'), 'default', array('class' => 'alert alert-success'));
						return $this->redirect(array('action' => 'index'));
					}	
            	}
            } else {
                $this->Session->setFlash(__('The coordinator cannot be deactivated. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
    }
    
    public function activate($id = null) {
        if ($this->request->is(['post', 'put'])) {
            $this->FeedbackEventManage->id = $id;
            if (!$this->FeedbackEventManage->exists()) {
                throw new NotFoundException(__('Invalid FeedbackEventManage'));
            }
           
            $this->request->data['FeedbackEventManage']['id'] = $id;
            $this->request->data['FeedbackEventManage']['recstatus'] = 1;
            if ($this->FeedbackEventManage->save($this->request->data,['id','recstatus','modifier_id'])) {
                $this->Session->setFlash(__('The coordinator has been activated.'), 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash(__('The coordinator cannot be activated. Please, try again.'));
            }
           return $this->redirect(['action' => 'index']);
        }
    }
}