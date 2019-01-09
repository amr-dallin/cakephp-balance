<?php
App::uses('BalanceAppController', 'Balance.Controller');
/**
 * Earnings Controller
 *
 * @property Earning $Earning
 */
class EarningsController extends BalanceAppController
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
        $earnings = $this->Earning->find('all');
        $statistics = $this->Earning->statisticsGraph();

        $this->set(compact('earnings', 'statistics'));
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
        if (!$this->Earning->exists($id)) {
            throw new NotFoundException(__('Invalid earning'));
        }
        $options = array('conditions' => array('Earning.' . $this->Earning->primaryKey => $id));
        $this->set('earning', $this->Earning->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {

            $this->Earning->create();
            if ($this->Earning->save($this->request->data)) {
                $this->Flash->success(__('The earning has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The earning could not be saved. Please, try again.'));
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
    public function edit($id = null)
    {
        if (!$this->Earning->exists($id)) {
            throw new NotFoundException(__('Invalid earning'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->Earning->id = $id;
            if ($this->Earning->save($this->request->data)) {
                $this->Flash->success(__('The earning has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The earning could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Earning.' . $this->Earning->primaryKey => $id));
            $this->request->data = $this->Earning->find('first', $options);
        }
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
        $this->Earning->id = $id;
        if (!$this->Earning->exists()) {
            throw new NotFoundException(__('Invalid earning'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Earning->delete()) {
            $this->Flash->success(__('The earning has been deleted.'));
        } else {
            $this->Flash->error(__('The earning could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
