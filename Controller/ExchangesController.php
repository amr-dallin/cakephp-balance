<?php
App::uses('BalanceAppController', 'Balance.Controller');
/**
 * Exchanges Controller
 *
 * @property Exchange $Exchange
 */
class ExchangesController extends BalanceAppController
{
    public $scaffold;
    
    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $exchanges = $this->Exchange->find('all');
        $this->set('exchanges', $exchanges);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Exchange->create();
            if ($this->Exchange->save($this->request->data)) {
                $this->Flash->success(__('The exchange has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The exchange could not be saved. Please, try again.'));
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
        if (!$this->Exchange->exists($id)) {
            throw new NotFoundException(__('Invalid exchange'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->Exchange->id = $id;
            if ($this->Exchange->save($this->request->data)) {
                $this->Flash->success(__('The exchange has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The exchange could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Exchange.' . $this->Exchange->primaryKey => $id));
            $this->request->data = $this->Exchange->find('first', $options);
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
        $this->Exchange->id = $id;
        if (!$this->Exchange->exists()) {
            throw new NotFoundException(__('Invalid exchange'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Exchange->delete()) {
            $this->Flash->success(__('The exchange has been deleted.'));
        } else {
            $this->Flash->error(__('The exchange could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
