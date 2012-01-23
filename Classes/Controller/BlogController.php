<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Tim Lochmüller <tl@hdnet.de>
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * Description of BlogController
 *
 * @author timlochmueller
 */
class Tx_Blogger_Controller_BlogController extends Tx_Extbase_MVC_Controller_ActionController {

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
	 * @param Tx_Blogger_Domain_Model_Category $category
	 * @param Tx_Blogger_Domain_Model_Author $author
	 * @param Tx_Tagger_Domain_Model_Tag $tag
	 */
	public function listAction(Tx_Blogger_Domain_Model_Category $category = NULL, Tx_Blogger_Domain_Model_Author $author = NULL, Tx_Tagger_Domain_Model_Tag $tag = NULL) {
		$filters = array();
		if ($category != NULL) {
			$posts = $this->postRepository->findByCategory($category);
			$filters[] = $category->getTitle();
		}

		if ($author != NULL) {
			$posts = $this->postRepository->findByAuthor($author);
			$filters[] = $author->getRealName();
		}

		if ($tag != NULL) {
			$posts = $this->postRepository->findByTags($tag);
			$filters[] = $tag->getTitle();
		}

		$variables = array(
			'filters' => $filters,
			'posts' => (!isset($posts) ? $this->postRepository->findAll() : $posts)
		);

		$this->signalSlotDispatcher->dispatch(__CLASS__, 'listAction', array($this, &$variables));

		$this->view->assignMultiple($variables);
	}

	/**
	 * Build up the detailview of a blog post
	 * 
	 * @param Tx_Blogger_Domain_Model_Post $post 
	 */
	public function detailAction(Tx_Blogger_Domain_Model_Post $post) {
		$comments = FALSE;
		if ($this->settings['comments']['type'] != 'disabled') {
			$comments = ucfirst($this->settings['comments']['type']);
		}

		if ($this->settings['overrideTitle'] == TRUE) {
			$GLOBALS['TSFE']->page['title'] = $post->getTitle();
		}

		$variables = array(
			'post' => $post,
			'comments' => $comments,
		);

		$this->signalSlotDispatcher->dispatch(__CLASS__, 'detailAction', array($this, &$variables));

		$this->view->assignMultiple($variables);
	}

}