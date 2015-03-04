<?php
App::uses('FeedbackSystemAppController', 'FeedbackSystem.Controller');
/**
 * FeedbackManages Controller
 *
 * @property FeedbackManage $FeedbackManage
 * @property PaginatorComponent $Paginator
 */
class FeedbackManagesController extends FeedbackSystemAppController {

/**
 * Components *
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
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1, 'contain' => ['FeedbackCategory','Staff']);
		$this->set('feedbackManages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FeedbackManage->exists($id)) {
			throw new NotFoundException(__('Invalid feedback manage'));
		}
		$options = array('conditions' => array('FeedbackManage.' . $this->FeedbackManage->primaryKey => $id),'recursive'=>-1,'contain'=>['FeedbackCategory','Staff']);
		$this->set('feedbackManage', $this->FeedbackManage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */

//add method(Super-admin will add Coordinator)ie:superadmin_add_coordinator
	public function add() {
		if ($this->request->is('post') && $this->request->data['FeedbackManage']['staff_id'] != 0) {
			$this->FeedbackManage->create();
			
			if ($this->FeedbackManage->save($this->request->data,true,array('feedback_category_id','staff_id','institution_id','creator_id'))) {
				$this->request->data['FeedbackCategory']['id'] = $this->request->data['FeedbackManage']['feedback_category_id'];
			    $this->request->data['FeedbackCategory']['flag'] = 1;
				if($this->FeedbackManage->FeedbackCategory->save($this->request->data,true,['id','flag','modifier_id'])) {
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$staffid = $this->request->data['FeedbackManage']['staff_id'];
			    	$data = $this->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]);
			    	$this->request->data['UserRole']['user_id'] = $data['User']['id'];
			    	$this->request->data['UserRole']['role_id'] = 6;
			    	//$institutionid= $this->request->data['FeedbackManage']['institution_id'];
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The feedback coordinator has been saved.'), 'default', array('class' => 'alert alert-success'));
						return $this->redirect(array('action' => 'index'));
					}	
				}
			} else {
				$this->Session->setFlash(__('The feedback coordinator could not be saved. Please, try again.'));
			}
		}
		
		 unset($this->request->data['FeedbackManage']['feedback_category_id']);
		$institutions = $this->FeedbackManage->Staff->Institution->find('list');
		$feedbackCategories = $this->FeedbackManage->FeedbackCategory->find('list',['conditions' => ['FeedbackCategory.recstatus' => 1,
																					'FeedbackCategory.flag'=>0]]);
		$departments = [];
		$staffs = [];
		$this->set(compact('institutions','departments', 'staffs','feedbackCategories'));
		//$institutionid= $this->request->data['FeedbackManage']['institution_id'];
	}



//Admin will add Coordinator to category
public function add_adm_coordinator() {
		if ($this->request->is('post') && $this->request->data['FeedbackManage']['staff_id'] != 0) {
			$this->FeedbackManage->create();
			
			if ($this->FeedbackManage->save($this->request->data,true,array('feedback_category_id','staff_id','creator_id'))) {
				$this->request->data['FeedbackCategory']['id'] = $this->request->data['FeedbackManage']['feedback_category_id'];
			    $this->request->data['FeedbackCategory']['institution_id']=$this->Session->read('institution_id');
			    $this->request->data['FeedbackCategory']['flag'] = 1;
				if($this->FeedbackManage->FeedbackCategory->save($this->request->data,true,['id','flag','modifier_id'])) {
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$staffid = $this->request->data['FeedbackManage']['staff_id'];
			    	$data = $this->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]);
			    	$this->request->data['UserRole']['user_id'] = $data['User']['id'];
			    	$this->request->data['UserRole']['role_id'] = 6;
			    	//$institutionid= $this->request->data['FeedbackManage']['institution_id'];
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The feedback coordinator has been saved.'), 'default', array('class' => 'alert alert-success'));
						return $this->redirect(array('action' => 'index'));
					}	
				}
			} else {
				$this->Session->setFlash(__('The feedback coordinator could not be saved. Please, try again.'));
			}
		}
		
		 unset($this->request->data['FeedbackManage']['feedback_category_id']);
		//$institutions = $this->FeedbackManage->Staff->Institution->find('list');
		$feedbackCategories = $this->FeedbackManage->FeedbackCategory->find('list',['conditions' => ['FeedbackCategory.recstatus' => 1,
																					'FeedbackCategory.flag'=>0]]);
		$departments = $this->FeedbackManage->Institution->Department->find('list');
		$staffs = [];
		$this->set(compact('departments', 'staffs','feedbackCategories'));
		//$institutionid= $this->request->data['FeedbackManage']['institution_id'];
	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	/*public function edit($id = null) {
		if (!$this->FeedbackManage->exists($id)) {
			throw new NotFoundException(__('Invalid feedback manage'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FeedbackManage->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback manage has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback manage could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('FeedbackManage.' . $this->FeedbackManage->primaryKey => $id));
			$this->request->data = $this->FeedbackManage->find('first', $options);
		}
		$createdBies = $this->FeedbackManage->CreatedBy->find('list');
		$modifiedBies = $this->FeedbackManage->ModifiedBy->find('list');
		$this->set(compact('createdBies', 'modifiedBies'));
	}
*/
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
*/
public function list_categories() {
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        if (!$id) {
          throw new NotFoundException();
        }
	  	$this->disableCache();
		$categories = $this->FeedbackCategory->getListByCompany($id);
        $this->set(compact('categories'));
        $this->set('_serialize', array('categories'));
    }
    public function deactivate($id = null) {
        if ($this->request->is(['post', 'put'])) {
            $this->FeedbackManage->id = $id;
            if (!$this->FeedbackManage->exists()) {
                throw new NotFoundException(__('Invalid FeedbackManage'));
            }
            $this->request->data['FeedbackManage']['id'] = $id;
            $this->request->data['FeedbackManage']['recstatus'] = 0;
            if ($this->FeedbackManage->save($this->request->data,true,['id','recstatus','modifier_id'])) {
            	$data = $this->FeedbackManage->find('first',['conditions'=>['FeedbackManage.id'=>$id]]);
            	$feedback_category_id = $data['FeedbackManage']['feedback_category_id'];
            	$this->request->data['FeedbackCategory']['id'] = $feedback_category_id;
			    $this->request->data['FeedbackCategory']['flag'] = 0;
			    if($this->FeedbackManage->FeedbackCategory->save($this->request->data,true,['id','flag','modifier_id'])){
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$staffid = $data['FeedbackManage']['staff_id'];
			    	$data = $this->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]);
			    	$this->request->data['UserRole']['user_id'] = $data['User']['id'];
			    	$data1 = $this->UserRole->find('first',['conditions'=>['UserRole.user_id'=>$data['User']['id'],
			    														  'UserRole.recstatus'=>1]]);
			    	$this->request->data['UserRole']['id'] = $data1['UserRole']['id'];
			    	$this->request->data['UserRole']['recstatus'] = 0;
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The Manager has been deactivated.'), 'default', array('class' => 'alert alert-success'));
						return $this->redirect(array('action' => 'index'));
					}	
            	}
            } else {
                $this->Session->setFlash(__('The Manager cannot be deactivated. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
    }
    
    public function activate($id = null) {
        if ($this->request->is(['post', 'put'])) {
            $this->FeedbackManage->id = $id;
            if (!$this->FeedbackManage->exists()) {
                throw new NotFoundException(__('Invalid FeedbackManage'));
            }
           
            $this->request->data['FeedbackManage']['id'] = $id;
            $this->request->data['FeedbackManage']['recstatus'] = 1;
            if ($this->FeedbackManage->save($this->request->data,['id','recstatus','modifier_id'])) {
                $this->Session->setFlash(__('The Manager has been activated.'), 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash(__('The Manager cannot be activated. Please, try again.'));
            }
           return $this->redirect(['action' => 'index']);
        }
    }

}
