<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ceas Controller
 *
 * @property \App\Model\Table\CeasTable $Ceas
 */
class CeasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $ceas = $this->paginate($this->Ceas);

        $this->set(compact('ceas'));
        $this->set('_serialize', ['ceas']);
    }

    /**
     * View method
     *
     * @param string|null $id Cea id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cea = $this->Ceas->get($id, [
            'contain' => []
        ]);

        $this->set('cea', $cea);
        $this->set('_serialize', ['cea']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cea = $this->Ceas->newEntity();
        if ($this->request->is('post')) {
            $cea = $this->Ceas->patchEntity($cea, $this->request->data);
            if ($this->Ceas->save($cea)) {
                $this->Flash->success(__('The cea has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cea could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cea'));
        $this->set('_serialize', ['cea']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cea id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cea = $this->Ceas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cea = $this->Ceas->patchEntity($cea, $this->request->data);
            if ($this->Ceas->save($cea)) {
                $this->Flash->success(__('The cea has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cea could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cea'));
        $this->set('_serialize', ['cea']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cea id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cea = $this->Ceas->get($id);
        if ($this->Ceas->delete($cea)) {
            $this->Flash->success(__('The cea has been deleted.'));
        } else {
            $this->Flash->error(__('The cea could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
