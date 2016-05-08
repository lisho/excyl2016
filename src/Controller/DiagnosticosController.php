<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Diagnosticos Controller
 *
 * @property \App\Model\Table\DiagnosticosTable $Diagnosticos
 */
class DiagnosticosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $diagnosticos = $this->paginate($this->Diagnosticos);

        $this->set(compact('diagnosticos'));
        $this->set('_serialize', ['diagnosticos']);
    }

    /**
     * View method
     *
     * @param string|null $id Diagnostico id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $diagnostico = $this->Diagnosticos->get($id, [
            'contain' => ['Candidatos']
        ]);

        $this->set('diagnostico', $diagnostico);
        $this->set('_serialize', ['diagnostico']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $diagnostico = $this->Diagnosticos->newEntity();
        if ($this->request->is('post')) {
            $diagnostico = $this->Diagnosticos->patchEntity($diagnostico, $this->request->data);
            if ($this->Diagnosticos->save($diagnostico)) {
                $this->Flash->success(__('The diagnostico has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The diagnostico could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('diagnostico'));
        $this->set('_serialize', ['diagnostico']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Diagnostico id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $diagnostico = $this->Diagnosticos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $diagnostico = $this->Diagnosticos->patchEntity($diagnostico, $this->request->data);
            if ($this->Diagnosticos->save($diagnostico)) {
                $this->Flash->success(__('The diagnostico has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The diagnostico could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('diagnostico'));
        $this->set('_serialize', ['diagnostico']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Diagnostico id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $diagnostico = $this->Diagnosticos->get($id);
        if ($this->Diagnosticos->delete($diagnostico)) {
            $this->Flash->success(__('The diagnostico has been deleted.'));
        } else {
            $this->Flash->error(__('The diagnostico could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
