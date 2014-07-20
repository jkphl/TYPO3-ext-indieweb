<?php
namespace Jkphl\Indieweb\Controller;


use TYPO3\Flow\Package\Exception\ProtectedPackageKeyException;
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Joschi Kuphal <joschi@kuphal.net>, tollwerk GmbH
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
 ***************************************************************/

/**
 * WebmentionController
 */
class WebmentionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * Webmention repository
	 *
	 * @var \Jkphl\Indieweb\Domain\Repository\WebmentionRepository
	 * @inject
	 */
	protected $webmentionRepository = NULL;
	
	/**
	 * Page repository
	 *
	 * @var \Jkphl\Indieweb\Domain\Repository\PageRepository
	 * @inject
	 */
	protected $pageRepository = NULL;
	
	/**
	 * Create a new webmention
	 *
	 * @param \Jkphl\Indieweb\Domain\Model\Webmention $webmention		Webmention
	 * @return void
	 */
	protected function createAction(\Jkphl\Indieweb\Domain\Model\Webmention $webmention) {
		$this->webmentionRepository->add($webmention);
		$persistenceManager 			= \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$persistenceManager->persistAll();
	}
	
	/**
	 * Receive a webmention ping
	 *
	 * @return void
	 */
	protected function pingAction() {

		/* @var $response \TYPO3\CMS\Extbase\Mvc\Web\Response */
		$response						=& $this->response;
		
		// If the necessary URLs haven't been sent
		if (!$this->configurationManager->isFeatureEnabled('webmentions') || empty($_POST['source']) || empty($_POST['target'])) {
			$response->setStatus(400, 'Bad Request');
			$response->sendHeaders();
				
		// Else
		} elseif (($target = $this->_isValidTarget($_POST['target'])) instanceof \Jkphl\Indieweb\Domain\Model\Page) {
			
			// If the webmention should be processed asynchronously
			if (intval($this->settings['webmentionsAsync']) > 0) {
				
				// Try to find and reset a matching webmention that has been registered before
				$webmention				= $this->webmentionRepository->findBySourceAndTarget($_POST['source'], $target);
				if ($webmention instanceof \Jkphl\Indieweb\Domain\Model\Webmention) {
					$webmention->reset();
					echo 'resetted';
					
				// Else: Create a new webmention
				} else {
					$webmention			= new \Jkphl\Indieweb\Domain\Model\Webmention();
					$webmention->setSource($_POST['source']);
					$webmention->setTarget($target);
				}
				
				$this->webmentionRepository->add($webmention);
				$persistenceManager 	= \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
				$persistenceManager->persistAll();
				
				// Positive status
				$response->setStatus(202, 'Accepted');
				$response->sendHeaders();
				
			// Else if it should be processed immediately
			} else {
				
				// Positive status
				$response->setStatus(200, 'OK');
				$response->sendHeaders();
			}
		}
	
		return '';
	}
	
	/**
	 * Error action
	 *
	 * @return void
	 */
	public function errorAction() {
		$this->request->setOriginalRequestMappingResults($this->arguments->getValidationResults());
		$this->view->assign('webmention', $this->request->getArgument('webmention'));
	}
	
	/************************************************************************************************
	 * PRIVATE METHODS
	 ***********************************************************************************************/
	
	 /**
	  * Check if a submitted target page is valid
	  * 
	  * @param \string $target									Target page URL
	  * @return \Jkphl\Indieweb\Domain\Model\Page|null			Target page
	  */
	protected function _isValidTarget($target) {
		$params				= \Jkphl\Indieweb\Utility\Urltools::extractGETParameters($target);
		return (is_array($params) && in_array('id', $params)) ? $this->pageRepository->findByUid(intval($params['id'])) : null;
	}
}