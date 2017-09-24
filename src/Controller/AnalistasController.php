<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Analistas Controller
 *
 * @property \App\Model\Table\AnalistasTable $Analistas
 *
 * @method \App\Model\Entity\Analista[] paginate($object = null, array $settings = [])
 */
class AnalistasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Analistas
            ->find('search', ['search' => $this->request->getQueryParams()])
            ->contain(['Funcionarios']);

        $this->paginate = [
            'limit' => 20,
            'contain' => ['Funcionarios'],
            'sortWhitelist' => ['Analistas.id', 'Funcionarios.nome', 'Funcionarios.sexo',
                'Funcionarios.idade', 'Analistas.linguagem',
            ],
        ];

        $analistas = $this->paginate($query);

        $filtros = [
            'id' => $this->request->getQuery('id'),
            'Funcionarios' => [
                'nome' => $this->request->getQuery('Funcionarios.nome'),
                'sexo' => $this->request->getQuery('Funcionarios.sexo'),
                'idade' => $this->request->getQuery('Funcionarios.idade'),
            ],
            'projeto' => $this->request->getQuery('projeto'),
        ];

        $this->set(compact('analistas', 'filtros'));
        $this->set('_serialize', ['analistas']);
    }

    /**
     * View method
     *
     * @param string|null $id Analista id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $analista = $this->Analistas->get($id, [
            'contain' => ['Funcionarios', 'Funcionarios.Hobbies']
        ]);

        $this->set('analista', $analista);
        $this->set('_serialize', ['analista']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $analista = $this->Analistas->newEntity();
        if ($this->request->is('post')) {
            $analista = $this->Analistas->patchEntity($analista, $this->request->data, [
                'associated' => [
                    'Funcionarios',
                    'Funcionarios.Hobbies'
                ]
            ]);
            if ($this->Analistas->save($analista)) {
                $this->returnMessage(
                    __('The {0} has been saved.', 'Analista'),
                    'success',
                    ['controller' => 'analistas', 'action' => 'index']
                );
            } else {
                $this->returnMessage(__('The {0} could not be saved. Please, try again.', 'Analista'), 'error');
            }
        }
        $hobbies = $this->Analistas->Funcionarios->Hobbies->find('list')->toArray();
        $this->set(compact('analista', 'hobbies'));
        $this->set('_serialize', ['analista']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Analista id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $analista = $this->Analistas->get($id, [
            'contain' => ['Funcionarios', 'Funcionarios.Hobbies']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $analista = $this->Analistas->patchEntity($analista, $this->request->data, [
                'associated' => [
                    'Funcionarios',
                    'Funcionarios.Hobbies',
                ]
            ]);
            if ($this->Analistas->save($analista)) {
                $this->returnMessage(
                    __('The {0} has been saved.', 'Analista'),
                    'success',
                    ['controller' => 'analistas', 'action' => 'index']
                );
            } else {
                $this->returnMessage(__('The {0} could not be saved. Please, try again.', 'Analista'), 'error');
            }
        }
        $hobbies = $this->Analistas->Funcionarios->Hobbies->find('list')->toArray();
        $this->set(compact('analista', 'hobbies'));
        $this->set('_serialize', ['analista']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Analista id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $analista = $this->Analistas->get($id, ['contain' => [
            'Funcionarios', 'Funcionarios.Hobbies'
        ]]);

        $funcionario = $analista->funcionario;
        if ($this->Analistas->delete($analista) && $this->Analistas->Funcionarios->delete($funcionario)) {
            $this->returnMessage(
                __('The {0} has been deleted.', 'Analista'),
                'success',
                ['controller' => 'analistas', 'action' => 'index']
            );
        } else {
            $this->returnMessage(
                __('The {0} could not be deleted. Please, try again.', 'Analista'),
                'error',
                ['controller' => 'programadores', 'action' => 'index']
            );
        }
    }
}
