<?php
App::uses('AppController', 'Controller');
/**
 * LineStops Controller
 *
 * @property LineStop $LineStop
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LineStopsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->LineStop->recursive = 0;
		$this->set('lineStops', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->LineStop->exists($id)) {
			throw new NotFoundException(__('Invalid line stop'));
		}
		$options = array('conditions' => array('LineStop.' . $this->LineStop->primaryKey => $id));
		$this->set('lineStop', $this->LineStop->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->LineStop->create();
			if ($this->LineStop->save($this->request->data)) {
				$this->Session->setFlash(__('The line stop has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The line stop could not be saved. Please, try again.'));
			}
		}
		$lines = $this->LineStop->Line->find('list');
		$stops = $this->LineStop->Stop->find('list');
		$this->set(compact('lines', 'stops'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->LineStop->exists($id)) {
			throw new NotFoundException(__('Invalid line stop'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->LineStop->save($this->request->data)) {
				$this->Session->setFlash(__('The line stop has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The line stop could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LineStop.' . $this->LineStop->primaryKey => $id));
			$this->request->data = $this->LineStop->find('first', $options);
		}
		$lines = $this->LineStop->Line->find('list');
		$stops = $this->LineStop->Stop->find('list');
		$this->set(compact('lines', 'stops'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->LineStop->id = $id;
		if (!$this->LineStop->exists()) {
			throw new NotFoundException(__('Invalid line stop'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->LineStop->delete()) {
			$this->Session->setFlash(__('The line stop has been deleted.'));
		} else {
			$this->Session->setFlash(__('The line stop could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
