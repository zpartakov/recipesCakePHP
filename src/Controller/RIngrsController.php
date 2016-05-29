<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RIngrs Controller
 *
 * @property \App\Model\Table\RIngrsTable $RIngrs
 */
class RIngrsController extends AppController
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
        $rIngrs = $this->paginate($this->RIngrs);

        $this->set(compact('rIngrs'));
        $this->set('_serialize', ['rIngrs']);
    }

    /**
     * View method
     *
     * @param string|null $id R Ingr id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rIngr = $this->RIngrs->get($id, [
            'contain' => ['Recettes']
        ]);

        $this->set('rIngr', $rIngr);
        $this->set('_serialize', ['rIngr']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rIngr = $this->RIngrs->newEntity();
        if ($this->request->is('post')) {
            $rIngr = $this->RIngrs->patchEntity($rIngr, $this->request->data);
            if ($this->RIngrs->save($rIngr)) {
                $this->Flash->success(__('The r ingr has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The r ingr could not be saved. Please, try again.'));
            }
        }
        $recettes = $this->RIngrs->Recettes->find('list', ['limit' => 200]);
        $this->set(compact('rIngr', 'recettes'));
        $this->set('_serialize', ['rIngr']);
    }

    /**
     * Edit method
     *
     * @param string|null $id R Ingr id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rIngr = $this->RIngrs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rIngr = $this->RIngrs->patchEntity($rIngr, $this->request->data);
            if ($this->RIngrs->save($rIngr)) {
                $this->Flash->success(__('The r ingr has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The r ingr could not be saved. Please, try again.'));
            }
        }
        $recettes = $this->RIngrs->Recettes->find('list', ['limit' => 200]);
        $this->set(compact('rIngr', 'recettes'));
        $this->set('_serialize', ['rIngr']);
    }

    /**
     * Delete method
     *
     * @param string|null $id R Ingr id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rIngr = $this->RIngrs->get($id);
        if ($this->RIngrs->delete($rIngr)) {
            $this->Flash->success(__('The r ingr has been deleted.'));
        } else {
            $this->Flash->error(__('The r ingr could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
