<?php

/**
 * IndieWeb publishing tools for TYPO3
 *
 * @category	Jkphl
 * @package		Jkphl_Indieweb
 * @author		Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright	Copyright © 2017 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
 */

namespace Jkphl\Indieweb\Task;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Joschi Kuphal <joschi@kuphal.net>, tollwerk GmbH
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
 * Scheduler task for webmention processing
 *
 * @category	Jkphl
 * @package		Jkphl_Indieweb
 * @author		Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright	Copyright © 2017 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
 */
class ProcessWebmentionsTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {
	
	/**
	 * Public method run by the scheduler
	 * 
	 * @return boolean				Success
	 */
	public function execute() {
		/* @var $objectManager \TYPO3\CMS\Extbase\Object\ObjectManager */
		$objectManager				= \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		
		/* @var $objectManager \TYPO3\CMS\Extbase\Configuration\ConfigurationManager */
		$configManager 				= $objectManager->get('\TYPO3\CMS\Extbase\Configuration\ConfigurationManager');
		
		/* @var $webmentionRepository \Jkphl\Indieweb\Domain\Repository\WebmentionRepository */		
		$webmentionRepository		= $objectManager->get('\Jkphl\Indieweb\Domain\Repository\WebmentionRepository');
		
		$configuration				= $configManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		$configuration				= $configuration['plugin.']['tx_indieweb.']['settings.']['webmentions.'];
		$processed					=
		$valid						= 0;
		
		// If webmentions should be processed asynchronously
		if (intval($configuration['async'])) {
			
			/* @var $webmention \Jkphl\Indieweb\Domain\Model\Webmention */
			foreach ($webmentionRepository->findUnprocessed() as $webmention) {
				if ($webmention->validate(intval($configuration['excerpt']))) {
					++$valid;
				}
				$webmentionRepository->update($webmention);
				++$processed;
			}
		}
		
		// Persist changes (if necessary)
		if ($processed) {
			$persistenceManager 	= \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
			$persistenceManager->persistAll();
		}
		
		// Add a flash message
		\TYPO3\CMS\Core\Messaging\FlashMessageQueue::addMessage(\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
			sprintf(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('task.processWebmentionsTask.result', 'indieweb'), $processed),
			'',
			\TYPO3\CMS\Core\Messaging\FlashMessage::INFO,
			TRUE
		));
		
		return true;
	}
}