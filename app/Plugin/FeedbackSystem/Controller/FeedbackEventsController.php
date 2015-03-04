<?php
App::uses('FeedbackSystemAppController', 'FeedbackSystem.Controller');
/**
 * FeedbackEvents Controller
 *
 */
class FeedbackEventsController extends FeedbackSystemAppController {

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
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1);
		$this->set('events', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->FeedbackEvent->exists($id)) {
			throw new NotFoundException(__('Invalid Feedback Event'));
		}
		$options = array('conditions' => array('FeedbackEvent.' . $this->FeedbackEvent->primaryKey => $id));
		$this->set('feedbackevent', $this->FeedbackEvent->find('first', $options));
	}
	
	public function add() {
		if ($this->request->is('post')) {
			$this->FeedbackEvent->create();
			$this->request->data['FeedbackEvent']['name'] = ucfirst(strtolower($this->request->data['FeedbackEvent']['name']));
			if ($this->FeedbackEvent->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback event has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback event could not be saved.'));
			}
		}
		$institutions = $this->FeedbackEvent->Institution->find('list');
		$this->set(compact('institutions'));
		
	}
	public function edit($id = null) {
		if (!$this->FeedbackEvent->exists($id)) {
			throw new NotFoundException(__('Invalid feedback event'));
		}
		$this->request->data['FeedbackEvent']['id'] = $id;
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FeedbackEvent->save($this->request->data,true,array('id','name'))) {
				$this->Session->setFlash(__('The feedback event has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback event could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FeedbackEvent.' . $this->FeedbackEvent->primaryKey => $id));
			$this->request->data = $this->FeedbackEvent->find('first', $options);
		}
		
	}

		

	public function deactivate($id = null) {
        if ($this->request->is(array('post', 'put'))) {
            $this->FeedbackEvent->id = $id;
            if (!$this->FeedbackEvent->exists()) {
                throw new NotFoundException(__('Invalid Event'));
            }
            $this->request->data['FeedbackEvent']['id'] = $id;
            $this->request->data['FeedbackEvent']['recstatus'] = 0;
            if ($this->FeedbackEvent->save($this->request->data,true,array('id','recstatus'))) {
                $this->Session->setFlash(__('The Event has been deactivated.'), 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash(__('The Event cannot be deactivated. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
        }
    }
    
    public function activate($id = null) {
        if ($this->request->is(array('post', 'put'))) {
            $this->FeedbackEvent->id = $id;
            if (!$this->FeedbackEvent->exists()) {
                throw new NotFoundException(__('Invalid Event'));
            }
            $this->request->data['FeedbackEvent']['id'] = $id;
            $this->request->data['FeedbackEvent']['recstatus'] = 1;
            if ($this->FeedbackEvent->save($this->request->data,true,array('id','recstatus'))) {
                $this->Session->setFlash(__('The Event has been activated.'), 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash(__('The Event cannot be activated. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
        }
    }




}
