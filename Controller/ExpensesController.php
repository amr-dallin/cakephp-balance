<?php
App::uses('BalanceAppController', 'Balance.Controller');

/**
 * Expenses Controller
 *
 * @property Expense $Expense
 */
class ExpensesController extends BalanceAppController
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
        $expenses = $this->Expense->find('all', array(
            'order' => 'Expense.date_expense DESC'
        ));

        $statistics = $this->Expense->statisticsGraph();
        
        $this->set(compact('expenses', 'statistics'));
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
        if (!$this->Expense->exists($id)) {
            throw new NotFoundException(__('Invalid expense'));
        }
        $options = array('conditions' => array('Expense.' . $this->Expense->primaryKey => $id));
        $this->set('expense', $this->Expense->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Expense->create();
            if ($this->Expense->saveMany($this->request->data)) {
                $this->Flash->success(__('The expense has been saved.'));
                return $this->redirect(array('action' => 'add'));
            } else {
                $this->Flash->error(__('The expense could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Expense->Category->generateTreeList();
        $this->set(compact('categories'));
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
        if (!$this->Expense->exists($id)) {
            throw new NotFoundException(__('Invalid expense'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Expense->save($this->request->data)) {
                $this->Flash->success(__('The expense has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The expense could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Expense.' . $this->Expense->primaryKey => $id));
            $this->request->data = $this->Expense->find('first', $options);
        }
        $categories = $this->Expense->Category->find('list');
        $this->set(compact('categories'));
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
        $this->Expense->id = $id;
        if (!$this->Expense->exists()) {
            throw new NotFoundException(__('Invalid expense'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Expense->delete()) {
            $this->Flash->success(__('The expense has been deleted.'));
        } else {
            $this->Flash->error(__('The expense could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
