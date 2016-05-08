<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Clasificados Controller
 *
 * @property \App\Model\Table\ClasificadosTable $Clasificados
 */
class ClasificadosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $clasificados = $this->paginate($this->Clasificados);

        $this->set(compact('clasificados'));
        $this->set('_serialize', ['clasificados']);
    }

    /**
     * View method
     *
     * @param string|null $id Clasificado id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clasificado = $this->Clasificados->get($id, [
            'contain' => ['Candidatos'],
            'contain' => ['Candidatos.Ceas'],

        ]);

        $num_candidatos = count($clasificado->candidatos);
        
        $this->set('clasificado', $clasificado);
        $this->set('num_candidatos', $num_candidatos);
        $this->set('_serialize', ['clasificado']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clasificado = $this->Clasificados->newEntity();
        if ($this->request->is('post')) {
            $clasificado = $this->Clasificados->patchEntity($clasificado, $this->request->data);
            if ($this->Clasificados->save($clasificado)) {
                $this->Flash->success(__('The clasificado has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The clasificado could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('clasificado'));
        $this->set('_serialize', ['clasificado']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Clasificado id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clasificado = $this->Clasificados->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clasificado = $this->Clasificados->patchEntity($clasificado, $this->request->data);
            if ($this->Clasificados->save($clasificado)) {
                $this->Flash->success(__('The clasificado has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The clasificado could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('clasificado'));
        $this->set('_serialize', ['clasificado']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Clasificado id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clasificado = $this->Clasificados->get($id);
        if ($this->Clasificados->delete($clasificado)) {
            $this->Flash->success(__('The clasificado has been deleted.'));
        } else {
            $this->Flash->error(__('The clasificado could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
