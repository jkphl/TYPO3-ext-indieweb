<?php

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

use Jkphl\Indieweb\Domain\Model\Webmention;
use Jkphl\Indieweb\Domain\Repository\WebmentionRepository;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageQueue;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Command controller for for webmention processing
 *
 * @category    Jkphl
 * @package        Jkphl_Indieweb
 * @author        Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright    Copyright © 2017 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license        http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
 */
class WebmentionCommandController extends CommandController
{
    public function processCommand()
    {
        /* @var $objectManager ConfigurationManager */
        $configManager = $this->objectManager->get(ConfigurationManager::class);

        /* @var $webmentionRepository WebmentionRepository */
        $webmentionRepository = $objectManager->get(WebmentionRepository::class);

        $configuration = $configManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
        );
        $configuration = $configuration['plugin.']['tx_indieweb.']['settings.']['webmentions.'];
        $processed =
        $valid = 0;

        // If webmentions should be processed asynchronously
        if (intval($configuration['async'])) {

            /* @var $webmention Webmention */
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
            $persistenceManager = $this->objectManager->get(PersistenceManager::class);
            $persistenceManager->persistAll();
        }

        // Add a flash message

        $this->addFlashMessage(
            sprintf(
                LocalizationUtility::translate(
                    'task.processWebmentionsTask.result', 'indieweb'
                ), $processed
            ), FlashMessage::INFO
        );

        return true;
    }

    /**
     * Adds a simple flash message to the default flash message queue
     *
     * @param string $message Message
     * @param int $severity Severity
     * @return void
     */
    protected function addFlashMessage($message, $severity = FlashMessage::OK)
    {
        $flashMessage = GeneralUtility::makeInstance(FlashMessage::class, $message, '', $severity, true);
        /** @var $flashMessageService FlashMessageService */
        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        /** @var $defaultFlashMessageQueue FlashMessageQueue */
        $defaultFlashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();
        $defaultFlashMessageQueue->enqueue($flashMessage);
    }
}