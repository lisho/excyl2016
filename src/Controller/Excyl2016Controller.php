<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Excyl2016 Controller
 *
 * @property \App\Model\Table\Excyl2016Table $Excyl2016
 */
class Excyl2016Controller extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $excyl2016 = $this->paginate($this->Excyl2016);

        $this->set(compact('excyl2016'));
        $this->set('_serialize', ['excyl2016']);
    }

    /**
     * View method
     *
     * @param string|null $id Excyl2016 id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $excyl2016 = $this->Excyl2016->get($id, [
            'contain' => []
        ]);

        $this->set('excyl2016', $excyl2016);
        $this->set('_serialize', ['excyl2016']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $excyl2016 = $this->Excyl2016->newEntity();
        if ($this->request->is('post')) {
            $excyl2016 = $this->Excyl2016->patchEntity($excyl2016, $this->request->data);
            if ($this->Excyl2016->save($excyl2016)) {
                $this->Flash->success(__('The excyl2016 has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The excyl2016 could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('excyl2016'));
        $this->set('_serialize', ['excyl2016']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Excyl2016 id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $excyl2016 = $this->Excyl2016->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $excyl2016 = $this->Excyl2016->patchEntity($excyl2016, $this->request->data);
            if ($this->Excyl2016->save($excyl2016)) {
                $this->Flash->success(__('The excyl2016 has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The excyl2016 could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('excyl2016'));
        $this->set('_serialize', ['excyl2016']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Excyl2016 id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $excyl2016 = $this->Excyl2016->get($id);
        if ($this->Excyl2016->delete($excyl2016)) {
            $this->Flash->success(__('The excyl2016 has been deleted.'));
        } else {
            $this->Flash->error(__('The excyl2016 could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function calificacionUpdate()
    {
        $this->RequestHandler->config('inputTypeMap.json', ['json_decode', true]);
//debug($this->request->data);exit();
        if ($this->request->isAjax()) {



            $id=$this->request->data['id'];
            $nota=$this->request->data['nota'];
            $corrector=$this->request->data['corrector'];
            $renuncia=$this->request->data['renuncia'];
            
        
            $candidato = $this->Excyl2016->get($id, [
                    'contain' => []
                ]);

            if ($nota!=null) {
                
                $candidato
                    ->$nota = $nota;
           
            } elseif ($corrector!=null) {

                $candidato
                    ->$corrector = $corrector;

            } elseif ($renuncia!=null) {

                $candidato
                    ->$renuncia = $renuncia;

            } 


            $candidato = $this->Excyl2016->patchEntity($candidato, $this->request->data);
            $this->Excyl2016->save($candidato);
            //$candidatoTable->save($candidato);
        }
    }

    public function ennomina()
    {
        $this->loadModel('Nominargc');
        $nomina_dni=[];
        $listado_en_nomina=[];
        $listado_no_nomina=[];
        $nomina =$this->Nominargc->find()
                        //->list(['dni'])
                        //->combine('dni')
                        //->select('dni')
                        //->all()
                        ->toArray()                       
                        ; 

        $llamados = $this->Excyl2016
                        ->find()
                        ->order(['nombre' => 'ASC'])
                        //->where(['estudios' => 'ESTUDIOS PRIMARIOS'])
                        //->combine('dni', 'nombre')
                        ->toArray()
                        //->all()
                        ;

        foreach ($nomina as $dni) {
              array_push($nomina_dni, $dni['dni']);
        }

        foreach ($llamados as $llamado) {

//debug($llamado['dni']);debug($nomina_dni);exit();

            if (in_array($llamado['dni'],$nomina_dni)) {
                
                $listado_en_nomina[$llamado['dni']] = $llamado['nombre'];

            } else {
                $listado_no_nomina[$llamado['dni']] = $llamado['nombre'];
            }
            
        }


        $datos= [
                    'nomina'=>$nomina,
                    'llamados'=>$llamados,
                    'listado_en_nomina' => $listado_en_nomina,
                    'listado_no_nomina' => $listado_no_nomina

                ];

        $this->set($datos);
        //debug($llamados);exit();

    }
 
}
