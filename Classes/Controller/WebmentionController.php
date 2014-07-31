<?php

/**
 * IndieWeb publishing tools for TYPO3
 *
 * @category	Jkphl
 * @package		Jkphl_Indieweb
 * @author		Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright	Copyright © 2014 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
 */

namespace Jkphl\Indieweb\Controller;

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
 * Webmention controller
 *
 * @category	Jkphl
 * @package		Jkphl_Indieweb
 * @author		Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright	Copyright © 2014 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
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
	 * IndieWeb Webmention Client
	 *
	 * @var \string
	 */
	const INDIEWEB_CLIENT = 'IndieWeb Webmention Validator';

	/**
	 * IndieWeb Webmention HTTP header
	 *
	 * @var \string
	 */
	const INDIEWEB_HEADER = 'X-Webmention-Token';
	
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
	 * Return information about the current page
	 *
	 * @return \string					Information
	 */
	protected function infoAction() {
	
		/* @var $response \TYPO3\CMS\Extbase\Mvc\Web\Response */
		$response						=& $this->response;

		if (
			!empty($_SERVER['REQUEST_METHOD']) &&
			($_SERVER['REQUEST_METHOD'] == 'POST') &&
			(file_get_contents('php://input') == md5($GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'].'/'.(new \Jkphl\Indieweb\Utility\Url(\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL')))))
		) {
			$response->setStatus(200, 'OK');
			$response->setHeader('Content-Type', 'application/json');
			$response->sendHeaders();
			echo json_encode(array('id' => $GLOBALS['TSFE']->id, 'status' => true));
		} else {
			$response->setStatus(400, 'Bad request');
			$response->sendHeaders();
			echo (new \Jkphl\Indieweb\Utility\Url(\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL')));
		}
		exit;
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
			$persistenceManager 		= \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
			$updateWebmention			= false;

			// Try to find and reset a matching webmention that has been registered before
			$webmention					= $this->webmentionRepository->findBySourceAndTarget($_POST['source'], $target);
			if ($webmention instanceof \Jkphl\Indieweb\Domain\Model\Webmention) {
				$webmention->reset();
				$updateWebmention		= true;
					
			// Else: Create a new hidden webmention
			} else {
				$webmention				= new \Jkphl\Indieweb\Domain\Model\Webmention();
				$webmention->setSource($_POST['source']);
				$webmention->setTarget($_POST['target']);
				$webmention->setPid($target->getUid());
				$webmention->setHidden(true);
			}
			
			// If the webmention should be processed asynchronously
			if (intval($this->settings['webmentions']['async']) > 0) {
				$updateWebmention ? $this->webmentionRepository->update($webmention) : $this->webmentionRepository->add($webmention);
				$persistenceManager->persistAll();
				
				// Positive status
				$response->setStatus(202, 'Accepted');
				
			// Else if it should be processed immediately
			} else {

				// Validate the webmention
				if ($webmention->validate(intval($this->settings['webmentions']['excerpt']))) {
					
					// Add to the repository
					$updateWebmention ? $this->webmentionRepository->update($webmention) : $this->webmentionRepository->add($webmention);
					$persistenceManager->persistAll();
					
					$response->setStatus(200, 'OK');
				} else {
					$response->setStatus(400, 'Bad request');
				}
			}
			
			$response->sendHeaders();
		}
	
		exit;
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
		$target				= new \Jkphl\Indieweb\Utility\Url($target);
		$target				= strval($target->sanitize()->addQuery(array('type' => $this->settings['webmentions']['infotype'])));
		$status				= null;
		$token				= md5($GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'].'/'.$target);
		$info				= \Jkphl\Indieweb\Utility\Curl::httpRequest($target, array(), \Jkphl\Indieweb\Utility\Curl::POST, $token, false, array(CURLOPT_USERAGENT => self::INDIEWEB_CLIENT), $status);
		$info				= strlen($info) ? @json_decode($info) : null;
		return (($info instanceof \stdClass) && !empty($info->status) && $info->status && !empty($info->id)) ? $this->pageRepository->findByUid(intval($info->id)) : null;
	}
}