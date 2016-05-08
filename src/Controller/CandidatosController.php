<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;


/**
 * Candidatos Controller
 *
 * @property \App\Model\Table\CandidatosTable $Candidatos
 */
class CandidatosController extends AppController
{

 
    public function initialice(){

        parent::initialice();
        $this->loadComponent ('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clasificados','Ceas'],

            
        ];
        $candidatos = $this->paginate($this->Candidatos);

        $this->set(compact('candidatos'));
        $this->set('_serialize', ['candidatos']);
    }

    /**
     * View method
     *
     * @param string|null $id Candidato id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidato = $this->Candidatos->get($id, [
            'contain' => ['Clasificados']
        ]);

        $this->set('candidato', $candidato);
        $this->set('_serialize', ['candidato']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidato = $this->Candidatos->newEntity();
        if ($this->request->is('post')) {
            $candidato = $this->Candidatos->patchEntity($candidato, $this->request->data);
            if ($this->Candidatos->save($candidato)) {
                $this->Flash->success(__('The candidato has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The candidato could not be saved. Please, try again.'));
            }
        }
        $clasificados = $this->Candidatos->Clasificados->find('list', ['limit' => 200]);
        $this->set(compact('candidato', 'clasificados'));
        $this->set('_serialize', ['candidato']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidato id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $candidato = $this->Candidatos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidato = $this->Candidatos->patchEntity($candidato, $this->request->data);
            if ($this->Candidatos->save($candidato)) {
                $this->Flash->success(__('The candidato has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The candidato could not be saved. Please, try again.'));
            }
        }
        $clasificados = $this->Candidatos->Clasificados->find('list', ['limit' => 200]);
        $this->set(compact('candidato', 'clasificados'));
        $this->set('_serialize', ['candidato']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidato id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidato = $this->Candidatos->get($id);
        if ($this->Candidatos->delete($candidato)) {
            $this->Flash->success(__('The candidato has been deleted.'));
        } else {
            $this->Flash->error(__('The candidato could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function viewPorExpediente($expediente = null)
    {
        
        $this->paginate = [
            'contain' => ['Clasificados'],
            'contain' => ['Ceas'],
            
        ];
        $candidatos = $this->paginate($this->Candidatos->findByExpediente($expediente));

        $this->set('candidatos', $candidatos);

        $this->set('_serialize', ['candidatos']);
    }

    public function viewPorCea($cea = null)
    {
        
        $this->paginate = [
            'contain' => ['Ceas'],
            'contain' => ['Clasificados'],
            
        ];
        $c = $this->Candidatos->findByCea_id($cea)->toArray();


        $candidatos = $this->paginate($this->Candidatos->findByCea_id($cea));
        $ceas = $this->Candidatos->Ceas->get($cea);
        $num = count($c);
        
        $this->set('candidatos', $candidatos);
        $this->set('num', $num);
        $this->set('ceas', $ceas['nombre']);
        $this->set('_serialize', ['ceas']);

    }

    public function viewConTedis()
    {
       
       $this->loadModel('Participantes');
       $this->loadModel('Empleos');
       
       /* 
       ** Variables 
       */

            /* Listas */
       
       $lista_candidatos_conocidos = [];
       $lista_candidatos_desconocidos = [];
       $lista_participantes = [];
       $lista_dni_candidatos=[];
       $lista_dni_participantes=[];
       $lista_rgc_participantes=[];
       $lista_coyunturales = [];

       /*** 
       $lista_expedientes_asignados 
                            --> numero de RGC
                                --> tedis
                                --> numedis
        **/

       $lista_expedientes_asignados = [];


       $clasificado = "";

       /* Contadores */
       $clasificado_C = 0;
       $clasificado_E = 0;
       $i = 0;
       $d = 0;
       $c = 0;
       $h = 0;
       $exp_count = 0;

       //$candidatos = $this->paginate($this->Candidatos);
       //$participantes = $this->paginate($this->Participantes);

       
       /* 
       ** Full CONSULTAS a la base para las tablas.
       */


       $participantes = $this->Participantes
                        ->find()
                        //->select(['id', 'dni'])
                        ->all();

       $candidatos = $this->Candidatos
                        ->find()
                        //->where(['estudios' => 'ESTUDIOS PRIMARIOS'])
                        //->select(['id', 'dni'])
                        //->toArray()
                        ->all();

        $ceas = $this->Candidatos->Ceas
                        ->find()
                        ->combine('id', 'nombre')
                        ->toArray()
                        //->all()
                        ;

         $empleos = $this->Empleos
                        ->find()
                        //->where(['estudios' => 'ESTUDIOS PRIMARIOS'])
                        //->select(['id', 'dni'])
                        ->toArray()
                        //->all()
                        ;
                foreach ($empleos as $empleo) {

                     $perfiles [$empleo['dni']] = [

                                    'e1'=>$empleo['e1'],
                                    'e2'=>$empleo['e2'],
                                    'e3'=>$empleo['e3'],
                                    'e4'=>$empleo['e4'],
                                    'e5'=>$empleo['e5'],
                                    'e6'=>$empleo['e6'],
                                ];     
                }
                    

        /* 
        **************************************
        ** Filtrados para generar listas... **
        **************************************
        */   
        

            /* 
            ** Listas de PARTICIPANTES DE LA BASE DE EDIS-LEON...
            */   

/* 1. Revisamos las personas de las que tenemos datos en EDIS: */
        
        foreach ($participantes as $participante) {
            
/* 
* 2. Creamos un arreglo con todos los 
* participantes y sus características.
*/ 

            $lista_participantes [$participante['dni']] =[
                                                    
                                                    'nombre'=>$participante ['nombre'],
                                                    'apellidos'=>$participante ['apellidos'],
                                                    'numedis'=>$participante ['numedis'], 
                                                    'numrgc'=>$participante ['numrgc'],
                                                    'tedis'=>$participante ['tedis']];
/* 
* Si conocemos el número de RGC lo añadimos a 
* $lista_expedientes_asignados asociando el 
* tedis y el numero de exp. edis.
*/            

            if ($participante['numrgc']) {
                 
                 $lista_expedientes_asignados [$participante['numrgc']]= ['tedis'=>$participante ['tedis'],
                                                                        'numedis' => $participante ['numedis']
                                                                            ];
             } 

/*
* Creamos una lista de dni que tenemos en la base y otra con los numeros de rgc.
*/            
           array_push($lista_dni_participantes, $participante ['dni']);
           array_push($lista_rgc_participantes, $participante ['numrgc']);

            $h++;
        }


            /* 
            ** Cruces con la Lista de CANDIDATOS PARA EL PLAN DE EMPLEO...
            */   

/* 1. Revisamos los candidatos: */

        foreach ($candidatos as $candidato) {


/* Calculamos la edad del candidato*/
            
            $nac_format = $candidato['nacimiento']->i18nFormat('yyyy-MM-dd');
            $fecha = time() - strtotime($nac_format);
            $edad = floor($fecha / 31556926);

            switch ($candidato ['clasificado_id']) {
                
/* Elegimos los estructurales */

                case 1:

                    $clasificado = "Estructural";
                    $clasificado_E++;

/** 
* Si el candidato tiene un DNI
* que está en la $lista_dni_participantes
* lo añadimos a la $lista_candidatos_conocidos...
**/

                        if (in_array($candidato['dni'], $lista_dni_participantes)) {

                            $i++;
                            $lista_candidatos_conocidos [$candidato['dni']] = [
                                                    'id'=>$candidato['id'],
                                                    'dni'=>$candidato['dni'],
                                                    'expediente'=>$candidato ['expediente'],
                                                    'nombre'=>$candidato ['nombre'],
                                                    'apellidos'=>$candidato ['apellidos'],
                                                    'estudios'=>$candidato ['estudios'],
                                                    'telefono' =>$candidato ['telefono'],
                                                    'tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                    'clasificado'=>$clasificado,
                                                    'numedis'=>$lista_participantes[$candidato['dni']]['numedis'],
                                                    'ceas' => $candidato ['cea_id'],
                                                    'edad' => $edad,
                                                    ]; 
/**
* Si el candidato tiene un numero de expediente 
* de renta que no estaba en nuestra base EDIS lo añadimos
* a la $lista_expedientes_asignados. Además añadimos el
* numero de expediente a la $lista_rgc_participantes.
**/
                            if (!in_array($candidato['expediente'], $lista_expedientes_asignados)) {

                                $lista_expedientes_asignados [$candidato['expediente']]= ['tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                                                            'numedis' => $lista_participantes[$candidato['dni']]['numedis']
                                                                                            ];
                               
                               array_push($lista_rgc_participantes, $candidato['expediente']);

                                }

                        } else {

/**
* Si el dni del candidato NO está en la lista de participantes
* comprobamos si el numero de expediente de renta del candidato
* está en $lista_rgc_participantes (la lista de los números de
* expediente de nuestra base).
**/

                            if (in_array($candidato['expediente'], $lista_rgc_participantes)) {

                                //$candidato['expediente']." --> ".$lista_expedientes_asignados[$candidato['expediente']]['tedis'].'<br>';
                                $exp_count++;

                                $i++;

/**
* Si el número de expediente está en la
* $lista_rgc_participantes, añadimos al candidato a
* la $lista_candidatos_conocidos.
**/
                                $lista_candidatos_conocidos [$candidato['dni']] = [
                                                'id'=>$candidato['id'],
                                                'dni'=>$candidato['dni'],
                                                'expediente'=>$candidato ['expediente'],
                                                'nombre'=>$candidato ['nombre'],
                                                'apellidos'=>$candidato ['apellidos'],
                                                'estudios'=>$candidato ['estudios'],
                                                'telefono' =>$candidato ['telefono'],
                                                'tedis'=>$lista_expedientes_asignados [$candidato['expediente']]['tedis'],
                                                'clasificado'=>$clasificado,
                                                'numedis' => $lista_expedientes_asignados [$candidato['expediente']]['numedis'],
                                                'ceas' => $candidato ['cea_id'],
                                                'nacimiento' => $candidato ['nacimiento'],
                                                'edad' => $edad,
                                                ];
                                               
                               
                            }else{

/**
* Si el número de expediente NO está en la
* $lista_rgc_participantes, añadimos al candidato 
* a la $lista_candidatos_desconocidos.
**/
                                $d++;
                                $lista_candidatos_desconocidos [$candidato['dni']] = [
                                                        'id'=>$candidato['id'],
                                                        'dni'=>$candidato['dni'],
                                                        'expediente'=>$candidato ['expediente'],
                                                        'nombre'=>$candidato ['nombre'],
                                                        'apellidos'=>$candidato ['apellidos'],
                                                        'estudios'=>$candidato ['estudios'],
                                                        'telefono' =>$candidato ['telefono'],
                                                        //'tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                        'clasificado'=>$clasificado,
                                                        'ceas' => $candidato ['cea_id'],
                                                        'nacimiento' => $candidato ['nacimiento'],
                                                        'edad' => $edad,
                                                        ]; 
                            }     
                        }

                    break;

                /*
                ***** En el caso de que sea COYUNTURAL:
                */

                case 2:
                    
                    $clasificado = "Coyuntural";
                    $clasificado_C++;

                    $lista_coyunturales [$candidato['dni']] = [
                                                'id'=>$candidato['id'],
                                                'dni'=>$candidato['dni'],
                                                'expediente'=>$candidato ['expediente'],
                                                'nombre'=>$candidato ['nombre'],
                                                'apellidos'=>$candidato ['apellidos'],
                                                'estudios'=>$candidato ['estudios'],
                                                'telefono' =>$candidato ['telefono'],
                                                'clasificado'=>$clasificado, 
                                                'ceas' => $candidato ['cea_id'],
                                                'nacimiento' => $candidato ['nacimiento'],
                                                'edad' => $edad,                                              
                                                ];

                    break;
                
                default:
                  
                    break;
            }
            
        }

        $datos = [
                    //'candidatos' => $candidatos,
                    'candidatos_conocidos' => $lista_candidatos_conocidos,
                    'candidatos_desconocidos' => $lista_candidatos_desconocidos,
                    'cuenta_estructurales' => $clasificado_E,
                    'cuenta_coyunturales' => $clasificado_C,
                    'candidatos_coyunturales' => $lista_coyunturales,
                    'ceas' => $ceas,
                    'perfiles' => $perfiles,
                    'num_extruc_conocidos' => $i,

                    ];
        
        $this->set($datos);
               
    }


     public function viewFiltro($tedis=null, $ceas_id=null)
    {


        $this->loadModel('Participantes');
        $this->loadModel('Empleos');
       
       /* 
       ** Variables 
       */

            /* Listas */
       
       $lista_candidatos_conocidos = [];
       $lista_candidatos_desconocidos = [];
       $lista_participantes = [];
       $lista_dni_candidatos=[];
       $lista_dni_participantes=[];
       $lista_rgc_participantes=[];
       $lista_coyunturales = [];

       /*** 
       $lista_expedientes_asignados 
                            --> numero de RGC
                                --> tedis
                                --> numedis
        **/

       $lista_expedientes_asignados = [];


       $clasificado = "";

       /* Contadores */
       $clasificado_C = 0;
       $clasificado_E = 0;
       $i = 0;
       $d = 0;
       $c = 0;
       $h = 0;
       $exp_count = 0;

       //$candidatos = $this->paginate($this->Candidatos);
       //$participantes = $this->paginate($this->Participantes);

       
       /* 
       ** Full CONSULTAS a la base para las tablas.
       */

        if ($tedis) {
            $participantes = $this->Participantes
                        ->find()
                        ->where(['tedis' => $tedis])
                        ->all();

        }else {
           $participantes = $this->Participantes
                        ->find()
                        //->where(['tedis' => $tedis])
                        ->all();

        }

        if ($ceas_id) {
            $candidatos = $this->Candidatos
                        ->find()
                        ->where([   'clasificado_id' => "1",
                                    'cea_id' => $ceas_id])
                        //->select(['id', 'dni'])
                        //->toArray()
                        ->all();
        }else {
            $candidatos = $this->Candidatos
                        ->find()
                        ->where(['clasificado_id' => "1"])
                        //->select(['id', 'dni'])
                        //->toArray()
                        ->all();
        }
       
      
        $ceas = $this->Candidatos->Ceas
                        ->find()
                        ->combine('id', 'nombre')
                        ->toArray()
                        //->all()
                        ; 

        $empleos = $this->Empleos
                        ->find()
                        //->where(['estudios' => 'ESTUDIOS PRIMARIOS'])
                        //->select(['id', 'dni'])
                        ->toArray()
                        //->all()
                        ;
                foreach ($empleos as $empleo) {

                     $perfiles [$empleo['dni']] = [

                                    'e1'=>$empleo['e1'],
                                    'e2'=>$empleo['e2'],
                                    'e3'=>$empleo['e3'],
                                    'e4'=>$empleo['e4'],
                                    'e5'=>$empleo['e5'],
                                    'e6'=>$empleo['e6'],
                                ];     
                }

                /* 
        **************************************
        ** Filtrados para generar listas... **
        **************************************
        */   
        

            /* 
            ** Listas de PARTICIPANTES DE LA BASE DE EDIS-LEON...
            */   

/* 1. Revisamos las personas de las que tenemos datos en EDIS: */
        
        foreach ($participantes as $participante) {
            
/* 
* 2. Creamos un arreglo con todos los 
* participantes y sus características.
*/ 

            $lista_participantes [$participante['dni']] =[
                                                    
                                                    'nombre'=>$participante ['nombre'],
                                                    'apellidos'=>$participante ['apellidos'],
                                                    'numedis'=>$participante ['numedis'], 
                                                    'numrgc'=>$participante ['numrgc'],
                                                    'tedis'=>$participante ['tedis']];
/* 
* Si conocemos el número de RGC lo añadimos a 
* $lista_expedientes_asignados asociando el 
* tedis y el numero de exp. edis.
*/            

            if ($participante['numrgc']) {
                 
                 $lista_expedientes_asignados [$participante['numrgc']]= ['tedis'=>$participante ['tedis'],
                                                                        'numedis' => $participante ['numedis']
                                                                            ];
             } 

/*
* Creamos una lista de dni que tenemos en la base y otra con los numeros de rgc.
*/            
           array_push($lista_dni_participantes, $participante ['dni']);
           array_push($lista_rgc_participantes, $participante ['numrgc']);

            $h++;
        }


            /* 
            ** Cruces con la Lista de CANDIDATOS PARA EL PLAN DE EMPLEO...
            */   


/* 1. Revisamos los candidatos: */

        foreach ($candidatos as $candidato) {


/* Calculamos la edad del candidato*/
            
            $nac_format = $candidato['nacimiento']->i18nFormat('yyyy-MM-dd');
            $fecha = time() - strtotime($nac_format);
            $edad = floor($fecha / 31556926);


            $clasificado = "Estructural";
            $clasificado_E++;

/** 
* Si el candidato tiene un DNI
* que está en la $lista_dni_participantes
* lo añadimos a la $lista_candidatos_conocidos...
**/

                        if (in_array($candidato['dni'], $lista_dni_participantes)) {

                            $i++;
                            $lista_candidatos_conocidos [$candidato['dni']] = [
                                                    'id'=>$candidato['id'],
                                                    'dni'=>$candidato['dni'],
                                                    'expediente'=>$candidato ['expediente'],
                                                    'nombre'=>$candidato ['nombre'],
                                                    'apellidos'=>$candidato ['apellidos'],
                                                    'estudios'=>$candidato ['estudios'],
                                                    'telefono' =>$candidato ['telefono'],
                                                    'tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                    'clasificado'=>$clasificado,
                                                    'numedis'=>$lista_participantes[$candidato['dni']]['numedis'],
                                                    'ceas' => $candidato ['cea_id'],
                                                    'edad' => $edad,
                                                    ]; 
/**
* Si el candidato tiene un numero de expediente 
* de renta que no estaba en nuestra base EDIS lo añadimos
* a la $lista_expedientes_asignados. Además añadimos el
* numero de expediente a la $lista_rgc_participantes.
**/
                            if (!in_array($candidato['expediente'], $lista_expedientes_asignados)) {

                                $lista_expedientes_asignados [$candidato['expediente']]= ['tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                                                            'numedis' => $lista_participantes[$candidato['dni']]['numedis']
                                                                                            ];
                               
                               array_push($lista_rgc_participantes, $candidato['expediente']);

                            }

                        } else {

/**
* Si el dni del candidato NO está en la lista de participantes
* comprobamos si el numero de expediente de renta del candidato
* está en $lista_rgc_participantes (la lista de los números de
* expediente de nuestra base).
**/

                                    if (in_array($candidato['expediente'], $lista_rgc_participantes)) {

                                        //$candidato['expediente']." --> ".$lista_expedientes_asignados[$candidato['expediente']]['tedis'].'<br>';
                                        $exp_count++;

                                        $i++;

/**
* Si el número de expediente está en la
* $lista_rgc_participantes, añadimos al candidato a
* la $lista_candidatos_conocidos.
**/
                                        $lista_candidatos_conocidos [$candidato['dni']] = [
                                                        'id'=>$candidato['id'],
                                                        'dni'=>$candidato['dni'],
                                                        'expediente'=>$candidato ['expediente'],
                                                        'nombre'=>$candidato ['nombre'],
                                                        'apellidos'=>$candidato ['apellidos'],
                                                        'estudios'=>$candidato ['estudios'],
                                                        'telefono' =>$candidato ['telefono'],
                                                        'tedis'=>$lista_expedientes_asignados [$candidato['expediente']]['tedis'],
                                                        'clasificado'=>$clasificado,
                                                        'numedis' => $lista_expedientes_asignados [$candidato['expediente']]['numedis'],
                                                        'ceas' => $candidato ['cea_id'],
                                                        'nacimiento' => $candidato ['nacimiento'],
                                                        'edad' => $edad,
                                                        ];
                                                       
                                       
                                    }else{

/**
* Si el número de expediente NO está en la
* $lista_rgc_participantes, añadimos al candidato 
* a la $lista_candidatos_desconocidos.
**/
                                        $d++;
                                        $lista_candidatos_desconocidos [$candidato['dni']] = [
                                                                'id'=>$candidato['id'],
                                                                'dni'=>$candidato['dni'],
                                                                'expediente'=>$candidato ['expediente'],
                                                                'nombre'=>$candidato ['nombre'],
                                                                'apellidos'=>$candidato ['apellidos'],
                                                                'estudios'=>$candidato ['estudios'],
                                                                'telefono' =>$candidato ['telefono'],
                                                                //'tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                                'clasificado'=>$clasificado,
                                                                'ceas' => $candidato ['cea_id'],
                                                                'nacimiento' => $candidato ['nacimiento'],
                                                                'edad' => $edad,
                                                                ]; 
                                    }     
                                }
                            }


        $datos = [
                    //'candidatos' => $candidatos,
                    'candidatos_conocidos' => $lista_candidatos_conocidos,
                    'candidatos_desconocidos' => $lista_candidatos_desconocidos,
                    'cuenta_estructurales' => $clasificado_E,
                    //'cuenta_coyunturales' => $clasificado_C,
                    //'candidatos_coyunturales' => $lista_coyunturales,
                    'ceas' => $ceas,
                    'perfiles' => $perfiles,
                    'num_extruc_conocidos' => $i,
                    'tedis_default' => $tedis,
                    'ceas_default' => $ceas_id
                    ];
        
        $this->set($datos);

        //debug(count($lista_candidatos_conocidos));debug(count($lista_candidatos_desconocidos));exit();           


    }



     public function valoracion($tedis=null, $ceas_id=null)
    {

    //debug(Router::url(['controller'=>'Candidato','action'=>'valoracion_update', '_ext' => 'json']));exit();
       
        $this->loadModel('Participantes');
        $this->loadModel('Empleos');
       
       /* 
       ** Variables 
       */

            /* Listas */
       
       $lista_candidatos_conocidos = [];
       $lista_candidatos_desconocidos = [];
       $lista_participantes = [];
       $lista_dni_candidatos=[];
       $lista_dni_participantes=[];
       $lista_rgc_participantes=[];
       $lista_coyunturales = [];

       /*** 
       $lista_expedientes_asignados 
                            --> numero de RGC
                                --> tedis
                                --> numedis
        **/

       $lista_expedientes_asignados = [];


       $clasificado = "";

       /* Contadores */
       $clasificado_C = 0;
       $clasificado_E = 0;
       $i = 0;
       $d = 0;
       $c = 0;
       $h = 0;
       $exp_count = 0;

       //$candidatos = $this->paginate($this->Candidatos);
       //$participantes = $this->paginate($this->Participantes);

       
       /* 
       ** Full CONSULTAS a la base para las tablas.
       */

        if ($tedis) {
            $participantes = $this->Participantes
                        ->find()
                        ->where(['tedis' => $tedis])
                        ->all();

        }else {
           $participantes = $this->Participantes
                        ->find()
                        //->where(['tedis' => $tedis])
                        ->all();

        }

        if ($ceas_id) {
            $candidatos = $this->Candidatos
                        ->find()
                        ->where([   'clasificado_id' => "1",
                                    'cea_id' => $ceas_id])
                        //->select(['id', 'dni'])
                        //->toArray()
                        ->all();
        }else {
            $candidatos = $this->Candidatos
                        ->find()
                        ->where(['clasificado_id' => "1"])
                        //->select(['id', 'dni'])
                        //->toArray()
                        ->all();
        }
       
      
        $ceas = $this->Candidatos->Ceas
                        ->find()
                        ->combine('id', 'nombre')
                        ->toArray()
                        //->all()
                        ; 

        $empleos = $this->Empleos
                        ->find()
                        //->where(['estudios' => 'ESTUDIOS PRIMARIOS'])
                        //->select(['id', 'dni'])
                        ->toArray()
                        //->all()
                        ;
                foreach ($empleos as $empleo) {

                     $perfiles [$empleo['dni']] = [

                                    'e1'=>$empleo['e1'],
                                    'e2'=>$empleo['e2'],
                                    'e3'=>$empleo['e3'],
                                    'e4'=>$empleo['e4'],
                                    'e5'=>$empleo['e5'],
                                    'e6'=>$empleo['e6'],
                                ];     
                }

                /* 
        **************************************
        ** Filtrados para generar listas... **
        **************************************
        */   
        

            /* 
            ** Listas de PARTICIPANTES DE LA BASE DE EDIS-LEON...
            */   

/* 1. Revisamos las personas de las que tenemos datos en EDIS: */
        
        foreach ($participantes as $participante) {
            
/* 
* 2. Creamos un arreglo con todos los 
* participantes y sus características.
*/ 

            $lista_participantes [$participante['dni']] =[
                                                    
                                                    'nombre'=>$participante ['nombre'],
                                                    'apellidos'=>$participante ['apellidos'],
                                                    'numedis'=>$participante ['numedis'], 
                                                    'numrgc'=>$participante ['numrgc'],
                                                    'tedis'=>$participante ['tedis']];
/* 
* Si conocemos el número de RGC lo añadimos a 
* $lista_expedientes_asignados asociando el 
* tedis y el numero de exp. edis.
*/            

            if ($participante['numrgc']) {
                 
                 $lista_expedientes_asignados [$participante['numrgc']]= ['tedis'=>$participante ['tedis'],
                                                                        'numedis' => $participante ['numedis']
                                                                            ];
             } 

/*
* Creamos una lista de dni que tenemos en la base y otra con los numeros de rgc.
*/            
           array_push($lista_dni_participantes, $participante ['dni']);
           array_push($lista_rgc_participantes, $participante ['numrgc']);

            $h++;
        }


            /* 
            ** Cruces con la Lista de CANDIDATOS PARA EL PLAN DE EMPLEO...
            */   


/* 1. Revisamos los candidatos: */

        foreach ($candidatos as $candidato) {


/* Calculamos la edad del candidato*/
            
            $nac_format = $candidato['nacimiento']->i18nFormat('yyyy-MM-dd');
            $fecha = time() - strtotime($nac_format);
            $edad = floor($fecha / 31556926);


            $clasificado = "Estructural";
            $clasificado_E++;

/** 
* Si el candidato tiene un DNI
* que está en la $lista_dni_participantes
* lo añadimos a la $lista_candidatos_conocidos...
**/

                        if (in_array($candidato['dni'], $lista_dni_participantes)) {

                            $i++;
                            $lista_candidatos_conocidos [$candidato['dni']] = [
                                                    'id'=>$candidato['id'],
                                                    'dni'=>$candidato['dni'],
                                                    'expediente'=>$candidato ['expediente'],
                                                    'nombre'=>$candidato ['nombre'],
                                                    'apellidos'=>$candidato ['apellidos'],
                                                    'estudios'=>$candidato ['estudios'],
                                                    'telefono' =>$candidato ['telefono'],
                                                    'tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                    'clasificado'=>$clasificado,
                                                    'numedis'=>$lista_participantes[$candidato['dni']]['numedis'],
                                                    'ceas' => $candidato ['cea_id'],
                                                    'edad' => $edad,
                                                    'motivacion'=> $candidato ['motivacion'],
                                                    'habitos'=> $candidato ['habitos'],
                                                    'habilidades'=> $candidato ['habilidades'],
                                                    'especialidad'=> $candidato ['especialidad'],
                                                    'dificultades'=> $candidato ['dificultades'],
                                                    'observaciones'=> $candidato ['observaciones'],
                                                    ]; 
/**
* Si el candidato tiene un numero de expediente 
* de renta que no estaba en nuestra base EDIS lo añadimos
* a la $lista_expedientes_asignados. Además añadimos el
* numero de expediente a la $lista_rgc_participantes.
**/
                            if (!in_array($candidato['expediente'], $lista_expedientes_asignados)) {

                                $lista_expedientes_asignados [$candidato['expediente']]= ['tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                                                            'numedis' => $lista_participantes[$candidato['dni']]['numedis']
                                                                                            ];
                               
                               array_push($lista_rgc_participantes, $candidato['expediente']);

                            }

                        } else {

/**
* Si el dni del candidato NO está en la lista de participantes
* comprobamos si el numero de expediente de renta del candidato
* está en $lista_rgc_participantes (la lista de los números de
* expediente de nuestra base).
**/

                                    if (in_array($candidato['expediente'], $lista_rgc_participantes)) {

                                        //$candidato['expediente']." --> ".$lista_expedientes_asignados[$candidato['expediente']]['tedis'].'<br>';
                                        $exp_count++;

                                        $i++;

/**
* Si el número de expediente está en la
* $lista_rgc_participantes, añadimos al candidato a
* la $lista_candidatos_conocidos.
**/
                                        $lista_candidatos_conocidos [$candidato['dni']] = [
                                                        'id'=>$candidato['id'],
                                                        'dni'=>$candidato['dni'],
                                                        'expediente'=>$candidato ['expediente'],
                                                        'nombre'=>$candidato ['nombre'],
                                                        'apellidos'=>$candidato ['apellidos'],
                                                        'estudios'=>$candidato ['estudios'],
                                                        'telefono' =>$candidato ['telefono'],
                                                        'tedis'=>$lista_expedientes_asignados [$candidato['expediente']]['tedis'],
                                                        'clasificado'=>$clasificado,
                                                        'numedis' => $lista_expedientes_asignados [$candidato['expediente']]['numedis'],
                                                        'ceas' => $candidato ['cea_id'],
                                                        'nacimiento' => $candidato ['nacimiento'],
                                                        'edad' => $edad,
                                                        'motivacion'=> $candidato ['motivacion'],
                                                        'habitos'=> $candidato ['habitos'],
                                                        'habilidades'=> $candidato ['habilidades'],
                                                        'especialidad'=> $candidato ['especialidad'],
                                                        'dificultades'=> $candidato ['dificultades'],
                                                        'observaciones'=> $candidato ['observaciones'],
                                                        ];
                                                       
                                       
                                    }else{

/**
* Si el número de expediente NO está en la
* $lista_rgc_participantes, añadimos al candidato 
* a la $lista_candidatos_desconocidos.
**/
                                        $d++;
                                        $lista_candidatos_desconocidos [$candidato['dni']] = [
                                                                'id'=>$candidato['id'],
                                                                'dni'=>$candidato['dni'],
                                                                'expediente'=>$candidato ['expediente'],
                                                                'nombre'=>$candidato ['nombre'],
                                                                'apellidos'=>$candidato ['apellidos'],
                                                                'estudios'=>$candidato ['estudios'],
                                                                'telefono' =>$candidato ['telefono'],
                                                                //'tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                                'clasificado'=>$clasificado,
                                                                'ceas' => $candidato ['cea_id'],
                                                                'nacimiento' => $candidato ['nacimiento'],
                                                                'edad' => $edad,
                                                                ]; 
                                    }     
                                }
                            }


        $datos = [
                    //'candidatos' => $candidatos,
                    'candidatos_conocidos' => $lista_candidatos_conocidos,
                    'candidatos_desconocidos' => $lista_candidatos_desconocidos,
                    'cuenta_estructurales' => $clasificado_E,
                    //'cuenta_coyunturales' => $clasificado_C,
                    //'candidatos_coyunturales' => $lista_coyunturales,
                    'ceas' => $ceas,
                    'perfiles' => $perfiles,
                    'num_extruc_conocidos' => $i,
                    'tedis_default' => $tedis,
                    'ceas_default' => $ceas_id
                    ];
        
      $this->set($datos);


        //debug(count($lista_candidatos_conocidos));debug(count($lista_candidatos_desconocidos));exit();           


    }

    public function valoracionUpdate()
    {
        $this->RequestHandler->config('inputTypeMap.json', ['json_decode', true]);

        if ($this->request->isAjax()) {

            //debug($this->request->data);exit();

            $id=$this->request->data['id'];
            $motivacion=$this->request->data['motivacion'];
            $habitos=$this->request->data['habitos'];
            $habilidades=$this->request->data['habilidades'];
            $especialidad=$this->request->data['especialidad'];
            $dificultades=$this->request->data['dificultades'];
            $observaciones=$this->request->data['observaciones'];

/*
            $campos=['id','motivacion','habitos','habilidades','habilidades','especialidad','dificultades','observaciones'];

            foreach ($campos as $campo) {
                
                    
                    $$campo = $this->request->data[$campo];
               
            }
 */        
            $candidato = $this->Candidatos->get($id, [
                    'contain' => []
                ]);

            if ($motivacion!=null) {
                
                $candidato
                    ->$motivacion = $motivacion;
           
            } elseif ($habitos!=null) {

                $candidato
                    ->$habitos = $habitos;

            } elseif ($habilidades!=null) {

                $candidato
                    ->$habilidades = $habilidades;

            } elseif ($especialidad!=null) {

                $candidato
                    ->$especialidad = $especialidad;

            } elseif ($dificultades!=null) {

                $candidato
                    ->$dificultades = $dificultades;

            } elseif ($observaciones!=null) {

                $candidato
                    ->$observaciones = $observaciones;
            }



            $candidato = $this->Candidatos->patchEntity($candidato, $this->request->data);
            $this->Candidatos->save($candidato);
            //$candidatoTable->save($candidato);
        }
   
    }

    /***
    *********************************************
    *********** EXCYL 2016 **********************
    *********************************************
    ***/


     public function valoracion2016($plaza=null, $tedis=null, $ceas_id=null)
     {

//debug ($tedis);exit();

        $this->loadModel('Participantes');
        $this->loadModel('Excyl2016');
       
       /* 
       ** Variables 
       */

            /* Listas */
       
       $lista_candidatos_conocidos = [];
       $lista_candidatos_desconocidos = [];
       $lista_participantes = [];
       $lista_dni_candidatos=[];
       $lista_dni_participantes=[];
       $lista_rgc_participantes=[];
       $lista_coyunturales = [];
       $lista_llamados_dni = [];
       $lista_llamamientos_full= [];
       $lista_llamados_barrendero = [];
       $lista_llamados_obras = [];
       $lista_llamados_conserjes = [];
       /*** 
       $lista_expedientes_asignados 
                            --> numero de RGC
                                --> tedis
                                --> numedis
        **/

       $lista_expedientes_asignados = [];


       $clasificado = "";

       /* Contadores */
       $clasificado_C = 0;
       $clasificado_E = 0;
       $i = 0;
       $d = 0;
       $c = 0;
       $h = 0;
       $exp_count = 0;

       //$candidatos = $this->paginate($this->Candidatos);
       //$participantes = $this->paginate($this->Participantes);

       if ($plaza==='todos los candidatos' || $plaza=== null) {

            $llamados = $this->Excyl2016
                        ->find()
                        //->where(['estudios' => 'ESTUDIOS PRIMARIOS'])
                        //->combine('dni', 'plaza')
                        ->toArray()
                        //->all()
                        ;
           
        } else {
            $llamados = $this->Excyl2016
                        ->find()
                        ->where([   'plaza' => $plaza,
                                    ])
                        //->select(['id', 'dni'])
                        //->toArray()
                        ->all();
        }

        
        foreach ($llamados as $llamado) {
             
             array_push($lista_llamados_dni, $llamado['dni']);

             if (in_array($llamado['dni'], array_keys($lista_llamamientos_full))) {

                    if (isset($lista_llamamientos_full[$llamado['dni']]['plaza2'])) {
                        $lista_llamamientos_full[$llamado['dni']]=array_merge($lista_llamamientos_full[$llamado['dni']], ['plaza3'=> $llamado['plaza']]);
                    } 
                    else {
                        $lista_llamamientos_full[$llamado['dni']]=array_merge($lista_llamamientos_full[$llamado['dni']], ['plaza2'=> $llamado['plaza']]);
                    }

             } else {

                $lista_llamamientos_full[$llamado['dni']]= [   
                                                        'dni' => $llamado['dni'],
                                                        'nombre_completo' => $llamado['nombre'],
                                                        'telefono_ecyl' => $llamado['telefono'],
                                                        'plaza' => $llamado['plaza']
                                                    ];
             }       
        }

//debug($lista_llamamientos_full); exit(); 
       
       /* 
       ** Full CONSULTAS a la base para las tablas.
       */


        

        if ($tedis === 'todos los TEDIS' || $tedis===null) {

            $participantes = $this->Participantes
                        ->find()
                        //->where(['tedis' => $tedis])
                        ->all();
           
        }else {

            $participantes = $this->Participantes
                        ->find()
                        ->where(['tedis' => $tedis,])
                        ->all();

        }

        if ($ceas_id) {
            $candidatos = $this->Candidatos
                        ->find()
                        ->where([   //'clasificado_id' => "1",
                                    'cea_id' => $ceas_id])
                        //->select(['id', 'dni'])
                        //->toArray()
                        ->all();
        }else {
            $candidatos = $this->Candidatos
                        ->find()
                        //->where(['clasificado_id' => "1"])
                        //->select(['id', 'dni'])
                        //->toArray()
                        ->all();
        }
       
      
        $ceas = $this->Candidatos->Ceas
                        ->find()
                        ->combine('id', 'nombre')
                        ->toArray()
                        //->all()
                        ; 

//debug ($llamados);exit();
                /* 
        **************************************
        ** Filtrados para generar listas... **
        **************************************
        */   
        

            /* 
            ** Listas de PARTICIPANTES DE LA BASE DE EDIS-LEON...
            */   

/* 1. Revisamos las personas de las que tenemos datos en EDIS: */
        
        foreach ($participantes as $participante) {
            
/* 
* 2. Creamos un arreglo con todos los 
* participantes y sus características.
*/ 

            $lista_participantes [$participante['dni']] =[
                                                    
                                                    'nombre'=>$participante ['nombre'],
                                                    'apellidos'=>$participante ['apellidos'],
                                                    'numedis'=>$participante ['numedis'], 
                                                    'numrgc'=>$participante ['numrgc'],
                                                    'tedis'=>$participante ['tedis']];
/* 
* Si conocemos el número de RGC lo añadimos a 
* $lista_expedientes_asignados asociando el 
* tedis y el numero de exp. edis.
*/            

            if ($participante['numrgc']) {
                 
                 $lista_expedientes_asignados [$participante['numrgc']]= ['tedis'=>$participante ['tedis'],
                                                                        'numedis' => $participante ['numedis']
                                                                            ];
             } 

/*
* Creamos una lista de dni que tenemos en la base y otra con los numeros de rgc.
*/            
           array_push($lista_dni_participantes, $participante ['dni']);
           array_push($lista_rgc_participantes, $participante ['numrgc']);

            $h++;
        }


            /* 
            ** Cruces con la Lista de CANDIDATOS PARA EL PLAN DE EMPLEO...
            */   


/* 1. Revisamos los candidatos: */

        foreach ($candidatos as $candidato) {


/* Calculamos la edad del candidato*/
            
            $nac_format = $candidato['nacimiento']->i18nFormat('yyyy-MM-dd');
            $fecha = time() - strtotime($nac_format);
            $edad = floor($fecha / 31556926);


            $clasificado = "Estructural";
            $clasificado_E++;

/** 
* Si el candidato tiene un DNI
* que está en la $lista_dni_participantes
* lo añadimos a la $lista_candidatos_conocidos...
**/                 

                                   
                        if (in_array($candidato['dni'], $lista_dni_participantes)) {

                            $i++;
                            $lista_candidatos_conocidos [$candidato['dni']] = [
                                                    'id'=>$candidato['id'],
                                                    'dni'=>$candidato['dni'],
                                                    'expediente'=>$candidato ['expediente'],
                                                    'nombre'=>$candidato ['nombre'],
                                                    'apellidos'=>$candidato ['apellidos'],
                                                    'estudios'=>$candidato ['estudios'],
                                                    'telefono' =>$candidato ['telefono'],
                                                    'tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                    'clasificado'=>$clasificado,
                                                    'numedis'=>$lista_participantes[$candidato['dni']]['numedis'],
                                                    'ceas' => $candidato ['cea_id'],
                                                    'edad' => $edad,
                                                    'motivacion'=> $candidato ['motivacion'],
                                                    'habitos'=> $candidato ['habitos'],
                                                    'habilidades'=> $candidato ['habilidades'],
                                                    'especialidad'=> $candidato ['especialidad'],
                                                    'dificultades'=> $candidato ['dificultades'],
                                                    'observaciones'=> $candidato ['observaciones'],


                                                    ]; 

                         

/**
* Si el candidato tiene un numero de expediente 
* de renta que no estaba en nuestra base EDIS lo añadimos
* a la $lista_expedientes_asignados. Además añadimos el
* numero de expediente a la $lista_rgc_participantes.
**/
                            if (!in_array($candidato['expediente'], $lista_expedientes_asignados)) {

                                $lista_expedientes_asignados [$candidato['expediente']]= ['tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                                                            'numedis' => $lista_participantes[$candidato['dni']]['numedis']
                                                                                            ];
                               
                               array_push($lista_rgc_participantes, $candidato['expediente']);

                            }

                        } else {

/**
* Si el dni del candidato NO está en la lista de participantes
* comprobamos si el numero de expediente de renta del candidato
* está en $lista_rgc_participantes (la lista de los números de
* expediente de nuestra base).
**/

                                    if (in_array($candidato['expediente'], $lista_rgc_participantes)) {

                                        //$candidato['expediente']." --> ".$lista_expedientes_asignados[$candidato['expediente']]['tedis'].'<br>';
                                        $exp_count++;

                                        $i++;

/**
* Si el número de expediente está en la
* $lista_rgc_participantes, añadimos al candidato a
* la $lista_candidatos_conocidos.
**/
                                        $lista_candidatos_conocidos [$candidato['dni']] = [
                                                        'id'=>$candidato['id'],
                                                        'dni'=>$candidato['dni'],
                                                        'expediente'=>$candidato ['expediente'],
                                                        'nombre'=>$candidato ['nombre'],
                                                        'apellidos'=>$candidato ['apellidos'],
                                                        'estudios'=>$candidato ['estudios'],
                                                        'telefono' =>$candidato ['telefono'],
                                                        'tedis'=>$lista_expedientes_asignados [$candidato['expediente']]['tedis'],
                                                        'clasificado'=>$clasificado,
                                                        'numedis' => $lista_expedientes_asignados [$candidato['expediente']]['numedis'],
                                                        'ceas' => $candidato ['cea_id'],
                                                        'nacimiento' => $candidato ['nacimiento'],
                                                        'edad' => $edad,
                                                        'motivacion'=> $candidato ['motivacion'],
                                                        'habitos'=> $candidato ['habitos'],
                                                        'habilidades'=> $candidato ['habilidades'],
                                                        'especialidad'=> $candidato ['especialidad'],
                                                        'dificultades'=> $candidato ['dificultades'],
                                                        'observaciones'=> $candidato ['observaciones'],
                                                        ];                    
                                       
                                    }else{

/**
* Si el número de expediente NO está en la
* $lista_rgc_participantes, añadimos al candidato 
* a la $lista_candidatos_desconocidos.
**/
                                        

                                        $d++;
                                        $lista_candidatos_desconocidos [$candidato['dni']] = [
                                                                'id'=>$candidato['id'],
                                                                'dni'=>$candidato['dni'],
                                                                'expediente'=>$candidato ['expediente'],
                                                                'nombre'=>$candidato ['nombre'],
                                                                'apellidos'=>$candidato ['apellidos'],
                                                                'estudios'=>$candidato ['estudios'],
                                                                'telefono' =>$candidato ['telefono'],
                                                                //'tedis'=>$lista_participantes[$candidato['dni']]['tedis'],
                                                                'clasificado'=>$clasificado,
                                                                'ceas' => $candidato ['cea_id'],
                                                                'nacimiento' => $candidato ['nacimiento'],
                                                                'edad' => $edad,
                                                                ]; 
                                        }
                                        
                                }
                      }



/*
** Completamos los datos en los listados de los llamados
*/

        foreach ($lista_llamamientos_full as $llamado) {
                     
                if (in_array($llamado['dni'], array_keys($lista_candidatos_conocidos))) {
                    
                    $lista_llamamientos_full[$llamado['dni']]=array_merge($lista_llamamientos_full[$llamado['dni']],[    
                                                                'id' => $lista_candidatos_conocidos[$llamado['dni']]['id'],
                                                                'expediente'=> $lista_candidatos_conocidos[$llamado['dni']]['expediente'],
                                                                'nombre'=>$lista_candidatos_conocidos[$llamado['dni']]['nombre'],
                                                                'apellidos'=>$lista_candidatos_conocidos[$llamado['dni']]['apellidos'],
                                                                'estudios'=>$lista_candidatos_conocidos[$llamado['dni']]['estudios'],
                                                                'telefono' =>$lista_candidatos_conocidos[$llamado['dni']]['telefono'] ,
                                                                'tedis'=>$lista_candidatos_conocidos[$llamado['dni']]['tedis'],
                                                                'clasificado'=>$lista_candidatos_conocidos[$llamado['dni']]['clasificado'],
                                                                'numedis' => $lista_candidatos_conocidos[$llamado['dni']]['numedis'],
                                                                'ceas' => $lista_candidatos_conocidos[$llamado['dni']]['ceas'],
                                                                //'nacimiento' => $lista_candidatos_conocidos[$llamado['dni']]['nacimiento'],
                                                                'edad' => $lista_candidatos_conocidos[$llamado['dni']]['edad'],
                                                                'motivacion'=> $lista_candidatos_conocidos[$llamado['dni']]['motivacion'],
                                                                'habitos'=> $lista_candidatos_conocidos[$llamado['dni']]['habitos'],
                                                                'habilidades'=> $lista_candidatos_conocidos[$llamado['dni']]['habilidades'],
                                                                'especialidad'=> $lista_candidatos_conocidos[$llamado['dni']]['especialidad'],
                                                                'dificultades'=> $lista_candidatos_conocidos[$llamado['dni']]['dificultades'],
                                                                'observaciones'=> $lista_candidatos_conocidos[$llamado['dni']]['observaciones'],
                                                            ]);

                } elseif (in_array($llamado['dni'], array_keys($lista_candidatos_desconocidos))){

                    $lista_llamamientos_full[$llamado['dni']]=array_merge($lista_llamamientos_full[$llamado['dni']], [
                                                                        
                                                                        'expediente'=> $lista_candidatos_desconocidos[$llamado['dni']]['expediente'],
                                                                        'nombre'=>$lista_candidatos_desconocidos[$llamado['dni']]['nombre'],
                                                                        'apellidos'=>$lista_candidatos_desconocidos[$llamado['dni']]['apellidos'],
                                                                        'estudios'=>$lista_candidatos_desconocidos[$llamado['dni']]['estudios'],
                                                                        'telefono' =>$lista_candidatos_desconocidos[$llamado['dni']]['telefono'] ,
                                                                        'clasificado'=>'Estructural-desconocido',
                                                                        'ceas' => $lista_candidatos_desconocidos[$llamado['dni']]['ceas'],
                                                                        'edad' => $lista_candidatos_desconocidos[$llamado['dni']]['edad'],

                                                                        
                                                                        ]); 
                }else {
                   $lista_llamamientos_full[$llamado['dni']]=array_merge($lista_llamamientos_full[$llamado['dni']], ['clasificado'=>'Coyuntural',
                                                                                                                        'estudios'=>'']);
                }
                           
            }


//debug($lista_llamamientos_full); debug(count($lista_llamamientos_full));exit();


        foreach ($llamados as $llamado) {

            if ($llamado['plaza']=== 'obra publica') {
                array_push($lista_llamados_obras, $llamado['dni']);    
            }elseif ($llamado['plaza']=== 'barrendero'){
                array_push($lista_llamados_barrendero, $llamado['dni']);
            } elseif ($llamado['plaza']=== 'conserje') {
                array_push($lista_llamados_conserjes, $llamado['dni']);
            }
           
        }

        
        if ($plaza) {
            
            foreach ($lista_candidatos_conocidos as $lista_candidato) {
                
                switch ($plaza) {

                    case 'todos los candidatos':
                        
                        break;

                    case 'obra publica':
                            
                        if (in_array($plaza, $lista_candidatos_conocidos)) {
                            unset($lista_candidatos_conocidos[$lista_candidato['id']]);
                        }

                        break;
                    
                   case 'barrendero':
                        
                        break;

                    case 'conserje':
                        
                        break;
                }
            }

        }


            $datos = [
                        //'candidatos' => $candidatos,
                        'lista_full'=>$lista_llamamientos_full,
                        'candidatos_conocidos' => $lista_candidatos_conocidos,
                        'candidatos_desconocidos' => $lista_candidatos_desconocidos,
                        'cuenta_estructurales' => $clasificado_E,
                        //'cuenta_coyunturales' => $clasificado_C,
                        //'candidatos_coyunturales' => $lista_coyunturales,
                        'ceas' => $ceas,
                        //'perfiles' => $perfiles,
                        'num_extruc_conocidos' => $i,
                        'tedis_default' => $tedis,
                        'ceas_default' => $ceas_id,
                        'plaza_default' => $plaza,
                        'lista_llamados_barrendero' => $lista_llamados_barrendero,
                        'lista_llamados_conserjes' => $lista_llamados_conserjes,
                        'lista_llamados_obras' => $lista_llamados_obras
                        ];
            
          $this->set($datos);

    }


/***********************************************************************
************************************************************************
****                                                                ****
****                Prueba de propiedades                           ****
****                                                                ****
************************************************************************
***********************************************************************/
    
    public function array_value_recursive($key, array $arr){
            $val = array();
            array_walk_recursive($arr, function($v, $k) use($key, &$val){
                if($k == $key) array_push($val, $v);
            });
            return count($val) > 1 ? $val : array_pop($val);
        }




    public function listadoFullExcyl2016($plaza=null) 
     {

        /*************************************
        **** Funciones Iniciales *************
        **************************************/

        


        /**
        ******** Cargamos otros modelos *******
        **/

        $this->loadModel('Participantes');
        $this->loadModel('Excyl2016');

        /* 
       ** Variables 
       */
            $llamados = []; // lista de todos los llamamientos (1 entrada por llamamiento=> un candidato puede tener varios llamamientos)
            $lista_llamamientos_full = []; // Listado con una entrada por candidato diferente, agrupando las plazas para las que se convoca a cada uno. (key -> DNI).
            $participantes = [];
            $participante_por_dni = [];
            $participante_por_rgc = [];
            $candidatos = [];
            $i=0;
            $h=0;

            $lista_tedis=[];



        /**
        ** Generamos un array con todos las personas que tenemos en la base de EDIS
        **/

            $participantes = $this->Participantes
                        ->find()
                        //->where(['tedis' => $tedis])
                        ->all();

        /**
        ** Generamos un array con todos los posibles candidatos enviados desde el ECYL a través de Gerencia.
        **/

            $candidatos = $this->Candidatos
                        ->find()
                        //->where(['clasificado_id' => "1"])
                        //->select(['id', 'dni'])
                        //->toArray()
                        ->all();
    

        /** Extraemos el listado de los convocados para EXCYL 2016**/

        if ($plaza==='todos los candidatos' || $plaza=== null) {

            $llamados = $this->Excyl2016
                        ->find()
                        ->order(['nombre' => 'ASC'])
                        //->where(['estudios' => 'ESTUDIOS PRIMARIOS'])
                        //->combine('dni', 'plaza')
                        ->toArray()
                        //->all()
                        ;
           
        } else {
            $llamados = $this->Excyl2016
                        ->find()
                        ->order (['nombre' => 'ASC'])
                        ->where([   'plaza' => $plaza,
                                    ])
                        //->select(['id', 'dni'])
                        //->toArray()
                        ->all();
        }


        /** 
        *** Agrupamos las convocatorias de un mismo candidato y
        *** las almacenamos en un array $lista_llamamientos_full
        **/

            foreach ($llamados as $llamado) {
             
             //array_push($lista_llamados_dni, $llamado['dni']);

                if (in_array($llamado['dni'], array_keys($lista_llamamientos_full))) {

                    if ($lista_llamamientos_full[$llamado['dni']]['plaza2'] !='') {
                        $lista_llamamientos_full[$llamado['dni']]=array_merge($lista_llamamientos_full[$llamado['dni']], ['plaza3'=> $llamado['plaza'],
                                                                                                                            'plaza3_nota' => floatval($llamado['nota'])+$llamado['corrector'],
                                                                                                                            'plaza3_corrector'=> $llamado['corrector'],
                                                                                                                            'id_plaza3' => $llamado['id'],
                                                                                                                            'plaza3_renuncia' => $llamado['renuncia'],
                                                                                                                            ]);
                    } 
                    else {

                        $apuntes=$lista_llamamientos_full[$llamado['dni']]['apuntes'].' '.$llamado['apuntes'];

                        $lista_llamamientos_full[$llamado['dni']]=array_merge($lista_llamamientos_full[$llamado['dni']], ['plaza2'=> $llamado['plaza'],
                                                                                                                            'plaza2_nota' => floatval($llamado['nota'])+$llamado['corrector'],
                                                                                                                            'plaza2_corrector'=> $llamado['corrector'],
                                                                                                                            'id_plaza2' => $llamado['id'],
                                                                                                                            'plaza2_renuncia' => $llamado['renuncia'],
                                                                                                                            'apuntes' => $apuntes,
                                                                                                                            'id_plaza3' => '',
                                                                                                                            'plaza3' => '',
                                                                                                                            'plaza3_nota' =>'',
                                                                                                                            'plaza3_corrector'=> '',
                                                                                                                            'plaza3_renuncia' => '',] );
                        
                    }

                } else {

                    $lista_llamamientos_full[$llamado['dni']]= [ 
                                                        'id' =>  $llamado['id'],
                                                        'dni' => $llamado['dni'],
                                                        'nombre_completo' => $llamado['nombre'],
                                                        'id_plaza' => $llamado['id'],
                                                        'plaza' => $llamado['plaza'],
                                                        'plaza_nota' => floatval($llamado['nota'])+$llamado['corrector'],
                                                        'plaza_corrector'=> $llamado['corrector'],
                                                        'plaza_renuncia' => $llamado['renuncia'],
                                                        'apuntes' => $llamado['apuntes'],
                                                        'nombre' => '',
                                                        'apellidos' => '',
                                                        'edad' => '',
                                                        'estudios' => '',
                                                        'telefono' => '',
                                                        'clasificado' => '',
                                                        'expediente_gerencia' => '',
                                                        'tipo' => '',
                                                        'direccion' => '',
                                                        'ceas' => '',
                                                        'motivacion' => '',
                                                        'habitos' => '',
                                                        'habilidades' => '',
                                                        'especialidad' => '',
                                                        'dificultades' => '',
                                                        'observaciones' => '',
                                                        'numedis' => '',
                                                        'numrgc' => '',
                                                        'tedis' => '',
                                                        'id_plaza2' => '',
                                                        'plaza2'=> '',
                                                        'plaza2_nota' => '',
                                                        'plaza2_corrector'=> '',
                                                        'plaza2_renuncia' => '',
                                                        'id_plaza3' => '',
                                                        'plaza3'=> '',
                                                        'plaza3_nota' => '', 
                                                        'plaza3_corrector'=> '',
                                                        'plaza3_renuncia' => '',
                                                        'motivacion'=> '',
                                                        'habitos'=> '',
                                                        'habilidades'=> '',
                                                        'especialidad'=> '',
                                                        'dificultades'=> '',
                                                        'observaciones'=> '',
                                                        //'renuncia'=> $llamado['renuncia'],

                                                    ];
                }       
            } //--> Ed foreach $llamados


//debug($participantes);exit();

        /**************************************
        ** Filtrados para generar listas... **
        **************************************
        */   
        


            /* 
            ** Listas de PARTICIPANTES DE LA BASE DE EDIS-LEON...
            */   


/* 1. Revisamos las personas de las que tenemos datos en EDIS y generamos una lista con los datos asociados a cada dni y otra con los datos asociados al numero de RGC */
        
        foreach ($participantes as $participante) {

            /* Si el DNI del participante está en $lista_llamamientos_full, 
            añadimos los datos que sacamos de la base EDIS*/
           

                
                $participante_por_dni[$participante['dni']] = [
                                                    
                                                    'nombre'=>$participante ['nombre'],
                                                    'apellidos'=>$participante ['apellidos'],
                                                    'numedis'=>$participante ['numedis'], 
                                                    'numrgc'=>$participante ['numrgc'],
                                                    'tedis'=>$participante ['tedis']];

                $participante_por_rgc[$participante['numrgc']] = [
                                                    
                                                    'nombre'=>$participante ['nombre'],
                                                    'apellidos'=>$participante ['apellidos'],
                                                    'numedis'=>$participante ['numedis'], 
                                                    'numrgc'=>$participante ['numrgc'],
                                                    'tedis'=>$participante ['tedis']];

            if (in_array($participante['dni'], array_keys($lista_llamamientos_full))) {
                
                $lista_llamamientos_full[$participante['dni']]=array_merge($lista_llamamientos_full [$participante['dni']], [
                                                    'nombre'=>$participante ['nombre'],
                                                    'apellidos'=>$participante ['apellidos'],
                                                    'numedis'=>$participante ['numedis'], 
                                                    'numrgc'=>$participante ['numrgc'],
                                                    'tedis'=>$participante ['tedis']

                                                    ]);
            } 




          
        } //--> End foreach de Participantes


            /* 
            ** Listas de CANDIDATOS QUE SEGUN GERENCIA SON SUSCEPTIBLES DE SER CONTRATADOS...
            */   


/* 1. Revisamos los candidatos: */

        foreach ($candidatos as $candidato) {


/* Calculamos la edad del candidato*/
            
            $nac_format = $candidato['nacimiento']->i18nFormat('yyyy-MM-dd');
            $fecha = time() - strtotime($nac_format);
            $edad = floor($fecha / 31556926);

/* Determinamos si es coyuntural o estructural*/

            switch ($candidato['clasificado_id']) {
                case 1:
                    $clasificado= 'Estructural';
                    break;
                case 2:
                    $clasificado= 'Coyuntural';
                    break;
                default:
                    // code...
                    break;
            }

/* Añadimos a las entradas de la lista de llamamientos los datos correspondientes de la lista de posibles candidtos */

            if (in_array($candidato['dni'], array_keys($lista_llamamientos_full))) {
                
                $lista_llamamientos_full[$candidato['dni']]=array_merge($lista_llamamientos_full [$candidato['dni']], [
                                                    
                                                    
                                                    'nombre'=>$candidato ['nombre'],
                                                    'apellidos'=>$candidato ['apellidos'],
                                                    'edad' => $edad,
                                                    'estudios'=>$candidato ['estudios'],
                                                    'telefono' =>$candidato ['telefono'],
                                                    'clasificado'=>$clasificado,
                                                    'expediente_gerencia' => $candidato ['expediente'],
                                                    'tipo' => $candidato ['tipo'],
                                                    'direccion' => $candidato['direccion'],
                                                    'ceas' => $candidato ['cea_id'],
                                                    'edad' => $edad,
                                                    'motivacion'=> $candidato ['motivacion'],
                                                    'habitos'=> $candidato ['habitos'],
                                                    'habilidades'=> $candidato ['habilidades'],
                                                    'especialidad'=> $candidato ['especialidad'],
                                                    'dificultades'=> $candidato ['dificultades'],
                                                    'observaciones'=> $candidato ['observaciones'],
                                                    'numedis'=>'', 
                                                    'numrgc'=>'',
                                                    'tedis'=>''

                                                    ]);
            } 


/* Añadimos a las entradas de la lista de llamamientos los datos correspondientes de la lista de participantes en EDIS */


            if (in_array($candidato['dni'], array_keys($lista_llamamientos_full))){

                // Comprobamos si conocemos el dni en EDIS

                if(isset($participante_por_dni[$candidato['dni']])) {
                
                        $lista_llamamientos_full[$candidato['dni']]=array_merge($lista_llamamientos_full [$candidato['dni']], [ 

                                                    //'nombre'=>$participante_por_dni [$candidato['dni']]['nombre'],
                                                    //'apellidos'=>$participante_por_dni [$candidato['dni']]['apellidos'],
                                                    'numedis'=>$participante_por_dni [$candidato['dni']]['numedis'], 
                                                    'numrgc'=>$participante_por_dni [$candidato['dni']]['numrgc'],
                                                    'tedis'=>$participante_por_dni [$candidato['dni']]['tedis']

                                                    ]);
 
                } 

                 // Comprobamos si conocemos el numero de RGC en EDIS

                elseif (isset($participante_por_rgc[$candidato['expediente']])) {
                    
                        if ($lista_llamamientos_full [$candidato['dni']]['expediente_gerencia'] != '') {
                            $numrgc = $participante_por_rgc [$candidato['expediente']]['numrgc'];
                        } else {
                            $numrgc = $lista_llamamientos_full [$candidato['dni']]['expediente_gerencia'];
                        }
                        
                        $lista_llamamientos_full[$candidato['dni']]=array_merge($lista_llamamientos_full [$candidato['dni']], [ 

                                                    //'nombre'=>$participante_por_dni [$candidato['dni']]['nombre'],
                                                    //'apellidos'=>$participante_por_dni [$candidato['dni']]['apellidos'],
                                                    'numedis'=>$participante_por_rgc [$candidato['expediente']]['numedis'], 
                                                    'numrgc'=>$numrgc,
                                                    'tedis'=>$participante_por_rgc [$candidato['expediente']]['tedis']

                                                    ]);
                } 
            }

        } //--> End foreach de Participantes


     // Comprobamos si ya hemos asociado ese número de RGC en la lista de llamamientos full y completamos los datos

            foreach ($lista_llamamientos_full as $lista){
                
                if (isset($lista['tedis'])) {
                       $lista_tedis[$lista['expediente_gerencia']] = ['tedis' => $lista['tedis'], 'numedis' => $lista['numedis']];
                    }                     
            } 


            foreach ($lista_llamamientos_full as $lista){
                
                if (isset($lista['expediente_gerencia']) && in_array($lista['expediente_gerencia'], array_keys($lista_tedis))) {
                      
                      $lista_llamamientos_full[$lista['dni']]=array_merge($lista_llamamientos_full [$lista['dni']], [ 

                                                    //'nombre'=>$participante_por_dni [$candidato['dni']]['nombre'],
                                                    //'apellidos'=>$participante_por_dni [$candidato['dni']]['apellidos'],
                                                    'numedis'=> $lista_tedis[$lista['expediente_gerencia']]['numedis'], 
                                                    'numrgc'=>  $lista['expediente_gerencia'],
                                                    'tedis'=>   $lista_tedis[$lista['expediente_gerencia']]['tedis']

                                                    ]);
                    }                     
            } 

//debug($lista_llamamientos_full);exit();
        return $lista_llamamientos_full;       
        

    } //--> Fin del controlador ...


    public function listaCEAS()
    {
        $ceas = $this->Candidatos->Ceas
                        ->find()
                        ->combine('id', 'nombre')
                        ->toArray()
                        //->all()
                        ; 

        return $ceas;

    }

    public function listaFiltrosFull($plaza=null)
    {
         
        $this->loadModel('Nominargc');
        $nomina_dni=[];
        $nomina =$this->Nominargc->find()
                        //->list(['dni'])
                        //->combine('dni')
                        //->select('dni')
                        //->all()
                        ->toArray()                       
                        ; 

        foreach ($nomina as $dni) {
              array_push($nomina_dni, $dni['dni']);
        }




        $listado_full = $this-> listadoFullExcyl2016();

        $lista_coyunturales = [];
        $lista_estructurales = [];
        $lista_otros = [];

        foreach ($listado_full as $candidato) {
             
            if ($candidato['clasificado']=== 'Coyuntural') {
                 
                $lista_coyunturales [$candidato['dni']] = $candidato;
             
            } elseif ($candidato['clasificado']=== 'Estructural') {
                 
                $lista_estructurales [$candidato['dni']] = $candidato;
             
            } else {
                
                $lista_otros [$candidato['dni']] = $candidato;
            }
         
        }

         //debug($listado_full);exit();
         
        $datos = [ 
                    'listado' => $listado_full,
                    'coyunturales' => $lista_coyunturales,
                    'estructurales' => $lista_estructurales,
                    'otros' => $lista_otros,
                    'plaza_default' => $plaza,
                    'ceas' => $this->listaCEAS(),
                    'nomina' => $nomina_dni,
                    'cuenta_candidatos' => count($listado_full)
                    ];

                        
        $this->set($datos);
    }

    public function listaFiltrosPersonal($plaza=null)
    {
        $this->loadModel('Nominargc');
        $this->loadModel('Preoposicion');
        $nomina_dni = [];
        $pre_dni = [];

        $listado_full = $this-> listadoFullExcyl2016();
        
        $nomina =$this->Nominargc->find()
                        //->list(['dni'])
                        //->combine('dni')
                        //->select('dni')
                        //->all()
                        ->toArray()                       
                        ; 

        $pre =$this->Preoposicion->find()
                        //->list(['dni'])
                        ->combine('dni','plaza')
                        //->select('dni')
                        //->all()
                        ->toArray()
                        
                        ; 
        

        foreach ($nomina as $dni) {
              array_push($nomina_dni, $dni['dni']);
        }

        $pre_dni  = array_keys($pre);
 
        
        foreach ($listado_full as $candidato) {
             
            if ($candidato['plaza']=== 'Coyuntural') {
                 
                $lista_una_plaza [$candidato['dni']] = $candidato;
             
            } elseif ($candidato['clasificado']=== 'Estructural') {
                 
                $lista_dos_plazas [$candidato['dni']] = $candidato;
             
            } else {
                
                $lista_otros [$candidato['dni']] = $candidato;
            }

            if (in_array($candidato['dni'],$nomina_dni)) {
                $listado_full[$candidato['dni']]= array_merge($listado_full[$candidato['dni']],[
                                                                                                    'nomina' => 'X']);
            } 
         
        }

        
        
        if ($plaza!='' && $plaza!='todos los candidatos') {
            
            foreach ($listado_full as $candidato) {
                 if ($candidato['plaza']!=$plaza &&
                       $candidato['plaza2']!=$plaza &&
                       $candidato['plaza3']!=$plaza) 
                 {
                    unset($listado_full[$candidato['dni']]);
                 } 
            }
        }
        
        $datos = [ 
                    'listado' => $listado_full,
                    'nomina' => $nomina_dni,
                    'plaza_default' => $plaza,
                    'pre' => $pre,
                    'pre_dni' => $pre_dni,
                    'cuenta_candidatos' => count($listado_full)
                    ];

                        
        $this->set($datos);

        //debug($listado_full);exit();
    }

    public function resultadosTribunales($plaza=null)
    {
        $this->loadModel('Nominargc');
        $this->loadModel('Preoposicion');

        $nomina_dni = [];
        $pre_dni = [];
        $listado_full = $this-> listadoFullExcyl2016();

        $nomina =$this->Nominargc->find()
                        //->list(['dni'])
                        //->combine('dni')
                        //->select('dni')
                        //->all()
                        ->toArray()                       
                        ; 

        $pre =$this->Preoposicion->find()
                        //->list(['dni'])
                        ->combine('dni','plaza')
                        //->select('dni')
                        //->all()
                        ->toArray()
                        
                        ; 
        
        foreach ($nomina as $dni) {
              array_push($nomina_dni, $dni['dni']);
        }

        $pre_dni  = array_keys($pre);

        foreach ($listado_full as $candidato) {
             
            if ($candidato['plaza']=== 'Coyuntural') {
                 
                $lista_una_plaza [$candidato['dni']] = $candidato;
             
            } elseif ($candidato['clasificado']=== 'Estructural') {
                 
                $lista_dos_plazas [$candidato['dni']] = $candidato;
             
            } else {
                
                $lista_otros [$candidato['dni']] = $candidato;
            }

            if (in_array($candidato['dni'],$nomina_dni)) {
                $listado_full[$candidato['dni']]= array_merge($listado_full[$candidato['dni']],[
                                                                                                    'nomina' => 'X']);
            } 
         
        }

         //debug($pre);exit();
        
        /* Recorremos el listado_full para hacer un array con los titulares que no hayan renunciado antes de ajustar el array por plaza*/
        
        $titulares_obras =[];
        $titulares_barrenderos =[];
        $titulares_conserjes =[];
        $o=1;
        $b=1;
        $c=1;

        foreach ($listado_full as $titular) {

            if ($titular['plaza'] === 'conserje' && $titular['plaza_renuncia'] === 0) {
             
                $titulares_conserjes[$titular['dni']]= ['orden' => $titular['plaza_nota']];

            }
            else if ($titular['plaza2'] === 'conserje' && $titular['plaza2_renuncia'] === 0){
                $titulares_conserjes[$titular['dni']]= ['orden' => $titular['plaza2_nota']];
            }
            else if ($titular['plaza3'] === 'conserje' && $titular['plaza3_renuncia'] === 0){
                $titulares_conserjes[$titular['dni']]= ['orden' => $titular['plaza3_nota']];
            }
            
            if ($titular['plaza'] === 'barrendero' && $titular['plaza_renuncia'] === 0){
                $titulares_barrenderos[$titular['dni']]= ['orden' => $titular['plaza_nota']];
            } 
            else if ($titular['plaza2'] === 'barrendero' && $titular['plaza2_renuncia'] === 0){
                $titulares_barrenderos[$titular['dni']]= ['orden' => $titular['plaza2_nota']];
            }
            else if ($titular['plaza3'] === 'barrendero' && $titular['plaza3_renuncia'] === 0){
                $titulares_barrenderos[$titular['dni']]= ['orden' => $titular['plaza3_nota']];
            }
            
            if ($titular['plaza'] === 'obra publica' && $titular['plaza_renuncia'] === 0){
                $titulares_obras[$titular['dni']]= ['orden' => $titular['plaza_nota']];
            }
            else if ($titular['plaza2'] === 'obra publica' && $titular['plaza2_renuncia'] === 0){
                $titulares_obras[$titular['dni']]= ['orden' => $titular['plaza2_nota']];
            }
            else if ($titular['plaza3'] === 'obra publica' && $titular['plaza3_renuncia'] === 0){
                $titulares_obras[$titular['dni']]= ['orden' => $titular['plaza3_nota']];
            }
        }
            

            uasort($titulares_conserjes, function ($a, $b) {
                $r=0;
                if ($b['orden'] > $a['orden']) {
                    $r = 1;
                } else if ($b['orden'] < $a['orden']){
                    $r = -1;
                }
                
                return $r;
            }); // end uasort

            uasort($titulares_barrenderos, function ($a, $b) {
                $r=0;
                if ($b['orden'] > $a['orden']) {
                    $r = 1;
                } else if ($b['orden'] < $a['orden']){
                    $r = -1;
                }
                
                return $r;
            }); // end uasort

            uasort($titulares_obras, function ($a, $b) {
                $r=0;
                if ($b['orden'] > $a['orden']) {
                    $r = 1;
                } else if ($b['orden'] < $a['orden']){
                    $r = -1;
                }
                
                return $r;
            }); // end uasort

        
        /* Ajustamos el array si pasamos algunha plaza concreta */

        if ($plaza!='' && $plaza!='todos los candidatos') {
            
            foreach ($listado_full as $candidato) {
                 if ($candidato['plaza']!=$plaza &&
                       $candidato['plaza2']!=$plaza &&
                       $candidato['plaza3']!=$plaza) 
                 {
                    unset($listado_full[$candidato['dni']]);
                 } 
                 else{

                    if ($candidato['plaza']===$plaza) {
                        $orden=$candidato['plaza_nota'];
                    } 
                    elseif ($candidato['plaza2']===$plaza) {
                        $orden=$candidato['plaza2_nota'];
                    }
                    elseif ($candidato['plaza3']===$plaza) {
                        $orden=$candidato['plaza3_nota']; 
                    }
                    

                    $listado_full[$candidato['dni']]= array_merge($listado_full[$candidato['dni']],['orden' => floatval($orden)]);
                }
            }
            
            /* Ordenamos el listado por notas */

            uasort($listado_full, function ($a, $b) {
                $r=0;
                if ($b['orden'] > $a['orden']) {
                    $r = 1;
                } else if ($b['orden'] < $a['orden']){
                    $r = -1;
                }
                
                return $r;
            }); // end uasort

        }
        
        /* Reducimos los listados de titulaes al número de plazas */

         foreach (array_keys($titulares_conserjes) as $conserje) {
                if ($c>29) {
                    unset($titulares_conserjes[$conserje]);
                } 

                $c++;
            }

        foreach (array_keys($titulares_barrenderos) as $barrendero) {
                if ($b>43) {
                    unset($titulares_barrenderos[$barrendero]);
                } 

                $b++;
            }   

        foreach (array_keys($titulares_obras) as $peon) {
                if ($o>34) {
                    unset($titulares_obras[$peon]);
                } 

                $o++;
            }      


        

        $datos = [ 
                    'listado' => $listado_full,
                    'nomina' => $nomina_dni,
                    'plaza_default' => $plaza,
                    'pre' => $pre,
                    'pre_dni' => $pre_dni,
                    'cuenta_candidatos' => count($listado_full),
                    'titulares_obras' => $titulares_obras,
                    'titulares_barrenderos' => $titulares_barrenderos,
                    'titulares_conserjes' => $titulares_conserjes
                    ];

                        
        $this->set($datos);

        //debug($listado_full);exit();
    }

    public function grafico()
    {
        $lista_ceas=$this->listaCEAS();
        $lista_ceas_nombre = ['Se desconoce'];
        $num_candidatos = [0,0,0,0,0,0,0,0];
        $listado_full = $this-> listadoFullExcyl2016();

        foreach ($lista_ceas as $ceas) {
            array_push($lista_ceas_nombre, $ceas);
        }

       foreach ($listado_full as $candidato) {

            if ($candidato['ceas']==="") {
                 $ceas_id=0;
            } else {
                 $ceas_id=$candidato['ceas'];
            }
            
           $num_candidatos[$ceas_id]++;
       }

       

        $datos = [
                'lista_ceas'=>$lista_ceas_nombre,
                'listado_full' => $listado_full,
                'num_candidatos' => $num_candidatos
            ];

        $this->set($datos);

        //debug($num_candidatos);exit();
    }


}

