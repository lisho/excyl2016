<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Preoposicion Controller
 *
 * @property \App\Model\Table\PreoposicionTable $Preoposicion
 */
class PreoposicionController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $preoposicion = $this->paginate($this->Preoposicion);

        $this->set(compact('preoposicion'));
        $this->set('_serialize', ['preoposicion']);
    }

    /**
     * View method
     *
     * @param string|null $id Preoposicion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $preoposicion = $this->Preoposicion->get($id, [
            'contain' => []
        ]);

        $this->set('preoposicion', $preoposicion);
        $this->set('_serialize', ['preoposicion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $preoposicion = $this->Preoposicion->newEntity();
        if ($this->request->is('post')) {
            $preoposicion = $this->Preoposicion->patchEntity($preoposicion, $this->request->data);
            if ($this->Preoposicion->save($preoposicion)) {
                $this->Flash->success(__('The preoposicion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The preoposicion could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('preoposicion'));
        $this->set('_serialize', ['preoposicion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Preoposicion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $preoposicion = $this->Preoposicion->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $preoposicion = $this->Preoposicion->patchEntity($preoposicion, $this->request->data);
            if ($this->Preoposicion->save($preoposicion)) {
                $this->Flash->success(__('The preoposicion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The preoposicion could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('preoposicion'));
        $this->set('_serialize', ['preoposicion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Preoposicion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $preoposicion = $this->Preoposicion->get($id);
        if ($this->Preoposicion->delete($preoposicion)) {
            $this->Flash->success(__('The preoposicion has been deleted.'));
        } else {
            $this->Flash->error(__('The preoposicion could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
