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
 *
 *
 * @package blogger
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Blogger_Domain_Model_Post extends Tx_Blogger_Domain_Model_AbstractModel {

	/**
	 * title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * publishDate
	 *
	 * @var DateTime
	 */
	protected $publishDate;

	/**
	 * author
	 *
	 * @var Tx_Blogger_Domain_Model_Author
	 */
	protected $author;

	/**
	 * category
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Blogger_Domain_Model_Category>
	 */
	protected $category;

	/**
	 * content
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Blogger_Domain_Model_Content>
	 */
	protected $content;

	/**
	 * sticky
	 * 
	 * @var integer
	 */
	protected $sticky;
	
	/**
	 * relatedPosts
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Blogger_Domain_Model_Post>
	 * @lazy
	 */
	protected $relatedPosts;
	
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->content = new Tx_Extbase_Persistence_ObjectStorage();
		$this->relatedPosts = new Tx_Extbase_Persistence_ObjectStorage();
		$this->category = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the publishDate
	 *
	 * @return DateTime $publishDate
	 */
	public function getPublishDate() {
		return $this->publishDate;
	}

	/**
	 * Sets the publishDate
	 *
	 * @param DateTime $publishDate
	 * @return void
	 */
	public function setPublishDate($publishDate) {
		$this->publishDate = $publishDate;
	}

	/**
	 * Returns the author
	 *
	 * @return Tx_Blogger_Domain_Model_Author $author
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Sets the author
	 *
	 * @param Tx_Blogger_Domain_Model_Author $author
	 * @return void
	 */
	public function setAuthor(Tx_Blogger_Domain_Model_Author $author) {
		$this->author = $author;
	}

	/**
	 * Returns the category
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Blogger_Domain_Model_Category> $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the category
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Blogger_Domain_Model_Category> $category
	 * @return void
	 */
	public function setCategory(Tx_Blogger_Domain_Model_Category $category) {
		$this->category = $category;
	}

	/**
	 * Adds a Content
	 *
	 * @param Tx_Blogger_Domain_Model_Content $content
	 * @return void
	 */
	public function addContent(Tx_Blogger_Domain_Model_Content $content) {
		$this->content->attach($content);
	}

	/**
	 * Removes a Content
	 *
	 * @param Tx_Blogger_Domain_Model_Content $contentToRemove The Content to be removed
	 * @return void
	 */
	public function removeContent(Tx_Blogger_Domain_Model_Content $contentToRemove) {
		$this->content->detach($contentToRemove);
	}

	/**
	 * Returns the content
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Blogger_Domain_Model_Content> $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Sets the content
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Blogger_Domain_Model_Content> $content
	 * @return void
	 */
	public function setContent(Tx_Extbase_Persistence_ObjectStorage $content) {
		$this->content = $content;
	}

	/**
	 * Returns the sticky bit
	 * 
	 * @return integer $sticky
	 */
	public function getSticky() {
		return $this->sticky;
	}
	
	/**
	 * Sets the sticky bit
	 * 
	 * @param integer $sticky
	 * @return void
	 */
	public function setSticky($sticky) {
		$this->sticky = $sticky;
	}

	/**
	 * Returns the related posts
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Blogger_Domain_Model_Post> $relatedPosts
	 */
	public function getRelatedPosts() {
		return $this->relatedPosts;
	}

	/**
	 * Sets the related posts
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Blogger_Domain_Model_Post> $relatedPosts
	 * @return void
	 */
	public function setRelatedPosts(Tx_Extbase_Persistence_ObjectStorage $relatedPosts) {
		$this->relatedPosts = $relatedPosts;
	}
	
	/**
	 * Returns the content
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Blogger_Domain_Model_Content> $content
	 */
	public function getContentPreview() {
		$contents = $this->getContent();
		$return = array();
		foreach ($contents as $content) {
			if ($content->getType() == 'div') {
				return $return;
			}
			$return[] = $content;
		}

		return $return;
	}

}

?>