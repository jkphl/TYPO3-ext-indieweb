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

namespace Jkphl\Indieweb\Utility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Joschi Kuphal <joschi@tollwerk.de>, tollwerk GmbH
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
 * Miscellaneous tests
 *
 * @category	Jkphl
 * @package		Jkphl_Indieweb
 * @author		Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright	Copyright © 2014 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
 */
class Test {
	/**
	 * Hook example: Print the data of a registered webmention
	 * 
	 * @param \array $params											Parameters
	 * @param \Jkphl\Indieweb\Domain\Model\Webmention $webmention		Webmention
	 * @return void
	 */
	public function webmention(array $params, \Jkphl\Indieweb\Domain\Model\Webmention $webmention) {
		/* @var $objectManager \TYPO3\CMS\Extbase\Object\ObjectManager */
		$objectManager		= \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		
		/* @var $pageRepository \Jkphl\Indieweb\Domain\Repository\PageRepository */
		$pageRepository		= $objectManager->get('Jkphl\\Indieweb\\Domain\\Repository\\PageRepository');
		
		var_export(array(
			'source'		=> $webmention->getSource(),
			'target'		=> $webmention->getTarget(),
			'page'			=> $pageRepository->findByUid($webmention->getPid())->getTitle(),
			'author'		=> array(
				'name'		=> $webmention->getAuthorName(),
				'avatar'	=> $webmention->getAuthorAvatar(),
				'profile'	=> $webmention->getAuthorProfile(),
			),
			'entry'			=> array(
				'name'		=> $webmention->getEntryName(),
				'summary'	=> $webmention->getEntrySummary(),
				'value'		=> $webmention->getEntryValue(),
				'content'	=> $webmention->getEntryContent(),
				'published'	=> $webmention->getEntryPublished(),
				'updated'	=> $webmention->getEntryUpdated(),
				'url'		=> $webmention->getEntryUrl(),
			),
			'context'		=> $webmention->getContext(),
		));
	}
}