<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlogController
 *
 * @author timlochmueller
 */
class Tx_Blogger_Controller_WidgetController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_Blogger_Domain_Repository_PostRepository 
	 */
	protected $postRepository;

	/**
	 * @var Tx_Extbase_SignalSlot_Dispatcher
	 */
	protected $signalSlotDispatcher;

	/**
	 * @param Tx_Blogger_Domain_Repository_PostRepository $repo 
	 */
	public function injectPostRepository(Tx_Blogger_Domain_Repository_PostRepository $repo) {
		$this->postRepository = $repo;
	}

	/**
	 * @param Tx_Extbase_SignalSlot_Dispatcher $signalSlotDispatcher 
	 */
	public function injectSignalSlotDispatcher(Tx_Extbase_SignalSlot_Dispatcher $signalSlotDispatcher) {
		$this->signalSlotDispatcher = $signalSlotDispatcher;
	}

	/**
	 * Build a List view for the list of blog posts
	 */
	public function listAction() {
		$variables = array(
			'posts' => $this->postRepository->findAll()
		);

		$this->signalSlotDispatcher->dispatch(__CLASS__, 'listAction', array($this, &$variables));

		$this->view->assignMultiple($variables);
	}

}