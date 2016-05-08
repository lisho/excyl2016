<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Empleos Controller
 *
 * @property \App\Model\Table\EmpleosTable $Empleos
 */
class EmpleosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $empleos = $this->paginate($this->Empleos);

        $this->set(compact('empleos'));
        $this->set('_serialize', ['empleos']);
    }

    /**
     * View method
     *
     * @param string|null $id Empleo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $empleo = $this->Empleos->get($id, [
            'contain' => []
        ]);

        $this->set('empleo', $empleo);
        $this->set('_serialize', ['empleo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $empleo = $this->Empleos->newEntity();
        if ($this->request->is('post')) {
            $empleo = $this->Empleos->patchEntity($empleo, $this->request->data);
            if ($this->Empleos->save($empleo)) {
                $this->Flash->success(__('The empleo has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The empleo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('empleo'));
        $this->set('_serialize', ['empleo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Empleo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $empleo = $this->Empleos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $empleo = $this->Empleos->patchEntity($empleo, $this->request->data);
            if ($this->Empleos->save($empleo)) {
                $this->Flash->success(__('The empleo has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The empleo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('empleo'));
        $this->set('_serialize', ['empleo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Empleo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $empleo = $this->Empleos->get($id);
        if ($this->Empleos->delete($empleo)) {
            $this->Flash->success(__('The empleo has been deleted.'));
        } else {
            $this->Flash->error(__('The empleo could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
