<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Nominargc Controller
 *
 * @property \App\Model\Table\NominargcTable $Nominargc
 */
class NominargcController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $nominargc = $this->paginate($this->Nominargc);

        $this->set(compact('nominargc'));
        $this->set('_serialize', ['nominargc']);
    }

    /**
     * View method
     *
     * @param string|null $id Nominargc id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nominargc = $this->Nominargc->get($id, [
            'contain' => []
        ]);

        $this->set('nominargc', $nominargc);
        $this->set('_serialize', ['nominargc']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $nominargc = $this->Nominargc->newEntity();
        if ($this->request->is('post')) {
            $nominargc = $this->Nominargc->patchEntity($nominargc, $this->request->data);
            if ($this->Nominargc->save($nominargc)) {
                $this->Flash->success(__('The nominargc has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The nominargc could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('nominargc'));
        $this->set('_serialize', ['nominargc']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Nominargc id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nominargc = $this->Nominargc->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nominargc = $this->Nominargc->patchEntity($nominargc, $this->request->data);
            if ($this->Nominargc->save($nominargc)) {
                $this->Flash->success(__('The nominargc has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The nominargc could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('nominargc'));
        $this->set('_serialize', ['nominargc']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Nominargc id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nominargc = $this->Nominargc->get($id);
        if ($this->Nominargc->delete($nominargc)) {
            $this->Flash->success(__('The nominargc has been deleted.'));
        } else {
            $this->Flash->error(__('The nominargc could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
