<?php
App::uses('BalanceAppController', 'Balance.Controller');
/**
 * Discrepancies Controller
 *
 * @property Discrepancy $Discrepancy
 */
class DiscrepanciesController extends BalanceAppController
{
    public $scaffold;
    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $discrepancies = $this->Discrepancy->find('all');
        
        $this->set('discrepancies', $discrepancies);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Discrepancy->create();
            if ($this->Discrepancy->save($this->request->data)) {
                $this->Flash->success(__('The discrepancy has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The discrepancy could not be saved. Please, try again.'));
            }
        }
        
        $currencies = $this->Discrepancy->Currency->find('list');
        $this->set(compact('currencies'));
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
        $this->Discrepancy->id = $id;
        if (!$this->Discrepancy->exists()) {
            throw new NotFoundException(__('Invalid discrepancy'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Discrepancy->delete()) {
            $this->Flash->success(__('The discrepancy has been deleted.'));
        } else {
            $this->Flash->error(__('The discrepancy could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
