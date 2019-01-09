<?php
App::uses('BalanceAppController', 'Balance.Controller');
/**
 * Currencies Controller
 *
 * @property Currency $Currency
 */
class CurrenciesController extends BalanceAppController
{
    
    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $currencies = $this->Currency->find('all');
        $this->set('currencies', $currencies);
    }

    public function balance()
    {
        if (empty($this->params['requested'])) {
            throw new ForbiddenException();
        }
        
        return $this->Currency->balance();
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
        if (!$this->Currency->exists($id)) {
            throw new NotFoundException(__('Invalid currency'));
        }
        $options = array('conditions' => array('Currency.' . $this->Currency->primaryKey => $id));
        $this->set('currency', $this->Currency->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Currency->create();
            if ($this->Currency->save($this->request->data)) {
                $this->Flash->success(__('The currency has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The currency could not be saved. Please, try again.'));
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
        if (!$this->Currency->exists($id)) {
            throw new NotFoundException(__('Invalid currency'));
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $this->Currency->id = $id;
            if ($this->Currency->save($this->request->data)) {
                $this->Flash->success(__('The currency has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The currency could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Currency.' . $this->Currency->primaryKey => $id));
            $this->request->data = $this->Currency->find('first', $options);
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
        $this->Currency->id = $id;
        if (!$this->Currency->exists()) {
            throw new NotFoundException(__('Invalid currency'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Currency->delete()) {
            $this->Flash->success(__('The currency has been deleted.'));
        } else {
            $this->Flash->error(__('The currency could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
