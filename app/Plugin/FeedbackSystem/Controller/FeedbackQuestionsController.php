<?php
App::uses('FeedbackSystemAppController', 'FeedbackSystem.Controller');
/**
 * FeedbackQuestions Controller
 *
 */
class FeedbackQuestionsController extends FeedbackSystemAppController {


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
	
	    $this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1, 'contain' => ['FeedbackCategory']);
		$this->set('feedbackQuestions', $this->Paginator->paginate());
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FeedbackQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid feedback question'));
		}
		$options = array('conditions' => array('FeedbackQuestion.' . $this->FeedbackQuestion->primaryKey => $id));
		$this->set('feedbackQuestion', $this->FeedbackQuestion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
//Super-admin add question ie superadmin_add_question 
	public function add() {
		
	if ($this->request->is('post')) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
			$this->FeedbackQuestion->create();
			$this->request->data['FeedbackQuestion']['user_id'] = $this->Auth->user('id');
			$categoryid = $this->request->data['FeedbackQuestion']['feedback_category_id'];
			$staff = $this->FeedbackQuestion->FeedbackCategory->FeedbackManage->find('first',[
				                                                          'conditions'=>
				                                                                    ['FeedbackManage.feedback_category_id'=>$categoryid,
				                                                                           'FeedbackManage.recstatus'=>1]]);
			$this->request->data['FeedbackQuestion']['staff_id'] = $staff['FeedbackManage']['staff_id'];
			if ($this->FeedbackQuestion->save($this->request->data,true,array('feedback_category_id','text','creator_id','staff_id','user_id','institution_id'))) {
				$this->request->data['FeedbackCategory']['id'] = $this->request->data['FeedbackQuestion']['feedback_category_id'];
			    $this->request->data['FeedbackCategory']['flag'] = 1;
				if($this->FeedbackQuestion->FeedbackCategory->save($this->request->data,true,['id','flag','modifier_id'])) {
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$staffid = $this->request->data['FeedbackQuestion']['staff_id'];
			    	$data = $this->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]);
			    	$this->request->data['UserRole']['user_id'] = $data['User']['id'];
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
		unset($this->request->data['FeedbackQuestion']['feedback_category_id']);
		
      //  $categories = $this->FeedbackQuestion->FeedbackCategory->find('first');
		$institutions = $this->FeedbackQuestion->Staff->Institution->find('list');

		$categories = $this->FeedbackQuestion->FeedbackCategory->find('list',array('joins' => array(
           array(
              'table' => 'feedback_manages',
              'alias' => 'FeedbackManage',
              'type'  => 'right',
              'conditions' => array(
                 'FeedbackManage.feedback_category_id = FeedbackCategory.id',
                 'FeedbackManage.recstatus = 1'
              )
           )
        ),
			'conditions' => array('FeedbackCategory.recstatus' => 1)
			));

	
		$this->set(compact('institutions','categories'));
		}
    
	//Admin will add queestion of his institution
	public function add_adm_question() {
	if ($this->request->is('post')) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
			$this->FeedbackQuestion->create();
			$this->request->data['FeedbackQuestion']['user_id'] = $this->Auth->user('id');
			$categoryid = $this->request->data['FeedbackQuestion']['feedback_category_id'];
			$staff = $this->FeedbackQuestion->FeedbackCategory->FeedbackManage->find('first',[
				                                                          'conditions'=>
				                                                                    ['FeedbackManage.feedback_category_id'=>$categoryid,
				                                                                           'FeedbackManage.recstatus'=>1]]);
			$this->request->data['FeedbackQuestion']['staff_id'] = $staff['FeedbackManage']['staff_id'];
			if ($this->FeedbackQuestion->save($this->request->data,true,array('feedback_category_id','text','creator_id','staff_id','user_id','institution_id'))) {
				$this->request->data['FeedbackCategory']['id'] = $this->request->data['FeedbackQuestion']['feedback_category_id'];
				if($this->FeedbackQuestion->FeedbackCategory->save($this->request->data,true,['id','flag','modifier_id'])) {
			    	$this->request->data['FeedbackQuestion']['institution_id']=$this->Session->read('institution_id');
			    	$institutionid=$this->request->data['FeedbackQuestion']['institution_id'];
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$staffid = $this->request->data['FeedbackQuestion']['staff_id'];
			    	$data = $this->User->find('list',['conditions'=>['User.staff_id'=>$staffid]]);
			    	$this->request->data['UserRole']['user_id'] = $data['User']['id'];
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
		unset($this->request->data['FeedbackQuestion']['feedback_category_id']);
		
      //  $categories = $this->FeedbackQuestion->FeedbackCategory->find('first');
		//$institutions = $this->FeedbackQuestion->Staff->Institution->find('list');
		$categories = $this->FeedbackQuestion->FeedbackCategory->find('list',array('joins' => array(
           array(
              'table' => 'feedback_manages',
              'alias' => 'FeedbackManage',
              'type'  => 'right',
              'conditions' => array(
                 'FeedbackManage.feedback_category_id = FeedbackCategory.id',
                 'FeedbackManage.recstatus = 1','FeedbackManage.flag=0'
              )
           )
        ),
			'conditions' => array('FeedbackCategory.recstatus' => 1)
			));

	
		$this->set(compact('categories'));
		}
    

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FeedbackQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid feedback question'));
		}
		$this->request->data['FeedbackQuestion']['id'] = $id;

		if ($this->request->is(array('post', 'put'))) {
			if ($this->FeedbackQuestion->save($this->request->data,true,array('id','text'))) {
				$this->Session->setFlash(__('The feedback question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback question could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FeedbackQuestion.' . $this->FeedbackQuestion->primaryKey => $id));
			$this->request->data = $this->FeedbackQuestion->find('first', $options);
		}
			}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FeedbackQuestion->id = $id;
		if (!$this->FeedbackQuestion->exists()) {
			throw new NotFoundException(__('Invalid feedback question'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FeedbackQuestion->delete()) {
			$this->Session->setFlash(__('The feedback question has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The feedback question could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function deactivate($id = null) {
        if ($this->request->is(['post', 'put'])) {
            $this->FeedbackQuestion->id = $id;
            if (!$this->FeedbackQuestion->exists()) {
                throw new NotFoundException(__('Invalid FeedbackQuestion'));
            }
            $this->request->data['FeedbackQuestion']['id'] = $id;
            $this->request->data['FeedbackQuestion']['recstatus'] = 0;
            if ($this->FeedbackQuestion->save($this->request->data,true,['id','recstatus','modifier_id'])) {
            	$data = $this->FeedbackQuestion->find('first',['conditions'=>['FeedbackQuestion.id'=>$id]]);
            	$feedback_category_id = $data['FeedbackQuestion']['feedback_category_id'];
            	$this->request->data['FeedbackCategory']['id'] = $feedback_category_id;
			    $this->request->data['FeedbackEvent']['flag'] = 0;
			    if($this->FeedbackQuestion->FeedbackCategory->save($this->request->data,true,['id','flag','modifier_id'])){
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
            $this->FeedbackQuestion->id = $id;
            if (!$this->FeedbackQuestion->exists()) {
                throw new NotFoundException(__('Invalid FeedbackQuestion'));
            }
           
            $this->request->data['FeedbackQuestion']['id'] = $id;
            $this->request->data['FeedbackQuestion']['recstatus'] = 1;
            if ($this->FeedbackQuestion->save($this->request->data,['id','recstatus','modifier_id'])) {
                $this->Session->setFlash(__('The question has been activated.'), 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash(__('The question cannot be activated. Please, try again.'));
            }
           return $this->redirect(['action' => 'index']);
        }
    }

}
