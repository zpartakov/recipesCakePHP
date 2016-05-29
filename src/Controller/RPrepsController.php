<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RPreps Controller
 *
 * @property \App\Model\Table\RPrepsTable $RPreps
 */
class RPrepsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Recettes']
        ];
        $rPreps = $this->paginate($this->RPreps);

        $this->set(compact('rPreps'));
        $this->set('_serialize', ['rPreps']);
    }

    /**
     * View method
     *
     * @param string|null $id R Prep id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rPrep = $this->RPreps->get($id, [
            'contain' => ['Recettes']
        ]);

        $this->set('rPrep', $rPrep);
        $this->set('_serialize', ['rPrep']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rPrep = $this->RPreps->newEntity();
        if ($this->request->is('post')) {
            $rPrep = $this->RPreps->patchEntity($rPrep, $this->request->data);
            if ($this->RPreps->save($rPrep)) {
                $this->Flash->success(__('The r prep has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The r prep could not be saved. Please, try again.'));
            }
        }
        $recettes = $this->RPreps->Recettes->find('list', ['limit' => 200]);
        $this->set(compact('rPrep', 'recettes'));
        $this->set('_serialize', ['rPrep']);
    }

    /**
     * Edit method
     *
     * @param string|null $id R Prep id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rPrep = $this->RPreps->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rPrep = $this->RPreps->patchEntity($rPrep, $this->request->data);
            if ($this->RPreps->save($rPrep)) {
                $this->Flash->success(__('The r prep has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The r prep could not be saved. Please, try again.'));
            }
        }
        $recettes = $this->RPreps->Recettes->find('list', ['limit' => 200]);
        $this->set(compact('rPrep', 'recettes'));
        $this->set('_serialize', ['rPrep']);
    }

    /**
     * Delete method
     *
     * @param string|null $id R Prep id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rPrep = $this->RPreps->get($id);
        if ($this->RPreps->delete($rPrep)) {
            $this->Flash->success(__('The r prep has been deleted.'));
        } else {
            $this->Flash->error(__('The r prep could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
