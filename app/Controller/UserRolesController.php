<?php
App::uses('AppController', 'Controller');
/**
 * User Roles Controller
 *
 * @property UserRoles $Manageroles
 * @property PaginatorComponent $Paginator
 */
class UserRolesController extends AppController {

public $components = array('Paginator');

/**
*
* View , Index , Deactivate and Add Function Of SuperAdmin Starts From Here.
*
*/
public function view_superadmin($id = null) {
  if (!$this->UserRole->exists($id)) {
    throw new NotFoundException(__('Invalid Role'));
  }

  $options = array(
    'recursive' => - 1,
    'contain' => ['Staff','Institution','Department','Role'],
    'conditions' => array('UserRole.' . $this->UserRole->primaryKey => $id
    )
  );
  $this->set('superadmin', $this->UserRole->find('first', $options));
}

public function index_superadmin()
{
  $this->loadModel('Setting');
  $data = $this->Setting->find('first', array(
    'recursive' => - 1
  ));
  $pagination_value = $data['Setting']['pagination_value'];
  $this->Paginator->settings = array(
    'limit' => $pagination_value,
    'page' => 1,
    'contain' => ['Staff','Institution','Department','Role'],
    'conditions'=>['UserRole.role_id'=> array(Configure::read('superadmin'))]);
  $this->set('superadmins', $this->Paginator->paginate());
}

public function deactivate_superadmin($id = null)
{
  if ($this->request->is(array('post','put'))) {
      $this->UserRole->id = $id;
    if (!$this->UserRole->exists()) {
      throw new NotFoundException(__('Invalid Role'));
    }

    $this->request->data['UserRole']['id'] = $id;
    $this->request->data['UserRole']['recstatus'] = 0;
    if ($this->UserRole->save($this->request->data, true, array('id','recstatus')))
     {
      $this->Session->setFlash(__('It has been deactivated.') , 'alert', array(
        'class' => 'alert-success'
      ));
    }
    else {
      $this->Session->setFlash(__('It cannot be deactivated. Please, try again.') , 'alert', array(
        'class' => 'alert-success'
      ));
    }

    return $this->redirect(array('Controller' => 'manageroles','action' => 'index_superadmin'));
  }
}
public function add_superadmin()
{
  if($this->request->is('post') && $this->request->data['UserRole']['staff_id'] != 0){
      $this->UserRole->create();
                        $this->request->data['UserRole']['role_id'] = Configure::read('superadmin');
                         $this->request->data['UserRole']['recstatus'] = 1 ;
      if ($this->UserRole->save($this->request->data)){ 
        $staff_id = $this->request->data['UserRole']['staff_id']; 
          $data = $this->UserRole->Role->UserRole->User->find('first',['conditions'=>['User.staff_id'=>$staff_id]]);
          $this->request->data['UserRole']['user_id'] = $data['User']['id']; 
          $this->request->data['UserRole']['role_id'] = Configure::read('superadmin'); 
         if($this->UserRole->Role->UserRole->save($this->request->data)){
        
            $this->Session->setFlash(__('The Super Admin has been saved.'), 'alert', array(
     'class' => 'alert-success'
 ));        
      }
    }
      else  {
           $this->Session->setFlash(__('The Super Admin could not be saved. Please, try again.'), 'alert', array(
     'class' => 'alert-success'
 ));
            }
    }
            unset($this->request->data);  
                     $institutions = $this->UserRole->Institution->find('list');
                     $departments = [];
                  $staffs = [];
                $this->set(compact('institutions', 'departments', 'staffs'));
 
}

/**
*
* View, Index, Deactivate and Add Function Of Admin Starts From Here.
*
**/
public function view_admin($id = null)
{
  if (!$this->UserRole->exists($id)) {
    throw new NotFoundException(__('Invalid Role'));
  }

  $options = array(
    'recursive' => - 1,
    'contain' => ['Staff','Institution','Department','Role'],
    'conditions' => array('UserRole.' . $this->UserRole->primaryKey => $id
    )
  );
  $this->set('admin', $this->UserRole->find('first', $options));
}

public function index_admin_developer()
{
  $this->loadModel('Setting');
  $data = $this->Setting->find('first', array('recursive' => - 1));
  $pagination_value = $data['Setting']['pagination_value'];
  $this->Paginator->settings = array(
    'limit' => $pagination_value,
    'page' => 1,
    'contain' => ['Staff','Institution','Department','Role'],
    'conditions'=>['UserRole.role_id'=> array(Configure::read('stadmin'),Configure::read('tpadmin'),Configure::read('fbadmin'))]);
  $this->set('admins', $this->Paginator->paginate());
}

public function index_admin()
{
  $this->loadModel('Setting');
  $this->loadModel('Staff');
  $data = $this->Setting->find('first', array('recursive' => - 1));
  $staffid = $this->Auth->user('staff_id');
  $data1=$this->Staff->find('first',['conditions'=>['Staff.id'=>$staffid]]);
  $data2 = $data1['Staff']['institution_id'];
  $pagination_value = $data['Setting']['pagination_value'];
  $this->Paginator->settings = array(
    'limit' => $pagination_value,
    'page' => 1,
    'contain' => ['Staff','Institution','Department','Role'],
    'conditions'=> array('UserRole.role_id'=> array(Configure::read('stadmin'),Configure::read('tpadmin'),Configure::read('fbadmin')), 'UserRole.institution_id'=>$data2));
  $this->set('admins', $this->Paginator->paginate());
}

public function deactivate_admin_developer($id = null)
{
  if ($this->request->is(array('post','put'))) {
    $this->UserRole->id = $id;
    if (!$this->UserRole->exists()) {
      throw new NotFoundException(__('Invalid Role'));
    }

    $this->request->data['UserRole']['id'] = $id;
    $this->request->data['UserRole']['recstatus'] = 0;
    if ($this->UserRole->save($this->request->data, true, array('id','recstatus')))
     {
      $this->Session->setFlash(__('It has been deactivated.') , 'alert', array(
        'class' => 'alert-success'
      ));
    }
    else {
      $this->Session->setFlash(__('It cannot be deactivated. Please, try again.') , 'alert', array(
        'class' => 'alert-success'
      ));
    }

    return $this->redirect(array('Controller' => 'manageroles','action' => 'index_admin_developer'));
  }
}

public function deactivate_admin($id = null)
{
  if ($this->request->is(array('post','put'))) {
    $this->UserRole->id = $id;
    if (!$this->UserRole->exists()) {
      throw new NotFoundException(__('Invalid Role'));
    }

    $this->request->data['UserRole']['id'] = $id;
    $this->request->data['UserRole']['recstatus'] = 0;
    if ($this->UserRole->save($this->request->data, true, array('id','recstatus')))
     {
      $this->Session->setFlash(__('It has been deactivated.') , 'alert', array(
        'class' => 'alert-success'
      ));
    }
    else {
      $this->Session->setFlash(__('It cannot be deactivated. Please, try again.') , 'alert', array(
        'class' => 'alert-success'
      ));
    }

    return $this->redirect(array('Controller' => 'manageroles','action' => 'index_admin'));
  }
}
/**
* This Function is called when developer login and Institution DropDown is Shown.
**/
public function add_developer_admin()
{
  if($this->request->is('post') && $this->request->data['UserRole']['staff_id'] != 0){
      $this->UserRole->create();
      if ($this->UserRole->save($this->request->data)){ 
        $staffid = $this->request->data['UserRole']['staff_id']; //staff which we have selected itz id is stored in variable staffid
          $data = $this->UserRole->Role->UserRole->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]); // finding that id in USER table
          $this->request->data['UserRole']['user_id'] = $data['User']['id']; // appending the user id after findind itz User
          $this->request->data['UserRole']['role_id'] = $this->request->data['UserRole']['role_id'];//copy role_id value from managerole to userrole table
          if($this->UserRole->Role->UserRole->save($this->request->data)){ // save data in USERROLE table     
 
            $this->Session->setFlash(__('The  Admin has been saved.'), 'alert', array(
     'class' => 'alert-success'
     ));        
      }
    }
 
      else  {
           $this->Session->setFlash(__('The  Admin could not be saved. Please, try again.'), 'alert', array(
     'class' => 'alert-success'
 ));
            }
    }
        unset($this->request->data);
                                 $institutions = $this->UserRole->Institution->find('list');
                                 $departments = [];
                         $staffs = [];
                       $roles = $this->UserRole->Role->find('list',array(
                         'conditions'=>array('Role.id'=>array(Configure::read('stadmin'),Configure::read('tpadmin'),Configure::read('fbadmin')))));
                       $this->set(compact('institutions', 'departments', 'staffs','roles'));
 
}
/**
* This function fetches Institution_id from Sessions and generate dropdown accordingly.
**/
public function add_admin()
{
  if($this->request->is('post') && $this->request->data['UserRole']['staff_id'] != 0){
      $this->UserRole->create();
      $this->loadModel('Staff');
      $userid = $this->Auth->user('staff_id');
      $data = $this->Staff->find('first',['conditions'=>['Staff.id'=>$userid]]);
        $this->request->data['UserRole']['institution_id'] = $data['Staff']['institution_id'];
      if ($this->UserRole->save($this->request->data,true,array('institution_id','department_id','role_id','staff_id'))){ 
        $staffid = $this->request->data['UserRole']['staff_id']; //staff which we have selected itz id is stored in variable staffid
          $data = $this->UserRole->Role->UserRole->User->find('first',['conditions'=>['User.staff_id'=>$staffid]]); // finding that id in USER table
          $this->request->data['UserRole']['user_id'] = $data['User']['id']; // appending the user id after findind itz User
          $this->request->data['UserRole']['role_id'] = $this->request->data['UserRole']['role_id'];//copy role_id value from managerole to userrole table
          if($this->UserRole->Role->UserRole->save($this->request->data)){ // save data in USERROLE table     
 
            $this->Session->setFlash(__('The  Admin has been saved.'), 'alert', array(
     'class' => 'alert-success'
     ));        
      }
    }
 
      else  {
           $this->Session->setFlash(__('The  Admin could not be saved. Please, try again.'), 'alert', array(
     'class' => 'alert-success'
 ));
            }
 
 
 
    }
        unset($this->request->data);
                    $userid = $this->Auth->user('staff_id');
                    $instid = $this->UserRole->Staff->find('first', array('fields' => array('Staff.institution_id'), 'conditions' => array('Staff.id' => $userid)));
                    $departments = $this->UserRole->Department->find('list',array('conditions'=>array('Department.institution_id'=>$instid['Staff']['institution_id'])));
                        $staffs = [];
                        $roles = $this->UserRole->Role->find('list',array(
                        'conditions'=>array('Role.id'=>array(Configure::read('stadmin'),Configure::read('tpadmin'),Configure::read('fbadmin')))));
                $this->set(compact( 'departments', 'staffs','roles'));
}

}
