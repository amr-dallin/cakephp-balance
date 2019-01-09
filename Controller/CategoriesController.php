<?php
App::uses('BalanceAppController', 'Balance.Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 */
class CategoriesController extends BalanceAppController
{
    
    public function beforeFilter()
    {
        parent::beforeFilter();
    }
    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $categories = $this->Category->find('all', array(
            'order' => array('Category.lft' => 'ASC'),
            'contain' => array('ParentCategory')
        ));
        
        $this->set('categories', $categories);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        
        $category = $this->Category->find('first', array(
            'conditions' => array('Category.id' => $id),
            'contain' => array('ChildCategory')
        ));
        
        $getPath = $this->Category->getPath($id);
        
        $statistics = $this->Category->statisticsGraph($id);
        
        $this->set(compact('category', 'getPath', 'statistics'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(array('action' => 'add'));
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        
        $parents = $this->Category->generateTreeList();
        $this->set(compact('parents'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->Category->id = $id;
            if ($this->Category->save($this->request->data)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
            $this->request->data = $this->Category->find('first', $options);
        }
        
        $parents = $this->Category->generateTreeList();
        $this->set(compact('parents'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Category->delete()) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
