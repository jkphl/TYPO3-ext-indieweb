<?php

namespace Jkphl\Indieweb\Command;

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
 * Scheduler task for processing webmentions
 *
 * @package tw_blog
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class WebmentionCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController {
	/**
	 * Configuration Manager
	 *
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 */
	protected $configurationManager;
	
	/**
	 * TypoScript configuration
	 *
	 * @var \array
	 */
	protected $configuration;
	
	/**
	 * Comment repository
	 *
	 * @var \Jkphl\Indieweb\Domain\Repository\CommentRepository
	 */
	protected $commentRepository;
	
	/**
	 * Webmention repository
	 *
	 * @var \Jkphl\Indieweb\Domain\Repository\WebmentionRepository
	 */
	protected $webmentionRepository;

	/**
	 * Page repository
	 *
	 * @var \Jkphl\Indieweb\Domain\Repository\PageRepository
	 */
	protected $pageRepository;

	/**
	 * Configuration manager injection
	 *
	 * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
	 * @return void
	 */
	public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;
		$configuration				= $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		$this->configuration		= $configuration['plugin.']['tx_Indieweb.']['settings.'];
	}
	
	/**
	 * Comment repository injection
	 *
	 * @param \Jkphl\Indieweb\Domain\Repository\CommentRepository $commentRepository
	 * @return void
	 */
	public function injectCommentRepository(\Jkphl\Indieweb\Domain\Repository\CommentRepository $commentRepository) {
		$this->commentRepository = $commentRepository;
	}
	
	/**
	 * Webmention repository injection
	 *
	 * @param \Jkphl\Indieweb\Domain\Repository\WebmentionRepository $webmentionRepository
	 * @return void
	 */
	public function injectWebmentionRepository(\Jkphl\Indieweb\Domain\Repository\WebmentionRepository $webmentionRepository) {
		$this->webmentionRepository = $webmentionRepository;
	}
	
	/**
	 * Page repository injection
	 *
	 * @param \Jkphl\Indieweb\Domain\Repository\PageRepository $pageRepository
	 * @return void
	 */
	public function injectPageRepository(\Jkphl\Indieweb\Domain\Repository\PageRepository $pageRepository) {
		$this->pageRepository = $pageRepository;
	}

	/**
	 * Get new webmentions
	 * 
	 * @return void
	 */
	public function getNewWebmentionsCommand(){
		$webmentionConfiguration		= $this->configuration['webmention.'];
		if (intval($webmentionConfiguration['enable'])) {
		
			// Run through all registered webmentions
			/* @var $webmention  */
			foreach ($this->webmentionRepository->findAll() as $webmention) {
				
				// Extract the GET parameters out of the target URL
				$params					= \Jkphl\Indieweb\Utility\Urltools::extractGETParameters($webmention->getTarget(), 1);
				
				// If a post comment could be identified within the link URL
				if (is_array($params) && array_key_exists('id', $params) && ($page = $this->pageRepository->findByUid($params['id']))) {
					
					// Check if the same source URL has already been registered as a webmention comment
					if (!$this->commentRepository->findByWebmentionPage($webmention, $page)) {
						$this->commentRepository->importWebmention($webmention, $page, $webmentionConfiguration);
					}
					
// 					$this->webmentionRepository->remove($webmention);
				}
			}
		}
		
// 		\TYPO3\CMS\Core\Messaging\FlashMessageQueue::addMessage(\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
// 			'neu seite: '.$page->getUid(),
// 			'Message Header',
// 			\TYPO3\CMS\Core\Messaging\FlashMessage::WARNING,
// 			TRUE
// 		));
	}
}