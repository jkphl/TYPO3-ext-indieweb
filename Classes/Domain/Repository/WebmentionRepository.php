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

namespace Jkphl\Indieweb\Domain\Repository;

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
 * Webmention repository
 *
 * @category	Jkphl
 * @package		Jkphl_Indieweb
 * @author		Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright	Copyright © 2017 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
 */
class WebmentionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Find a registered webmention by source and target page
	 * 
	 * @param \string $source								Source URL
	 * @param \Jkphl\Indieweb\Domain\Model\Page $page		Target page
	 * @return \Jkphl\Indieweb\Domain\Model\Webmention		Webmention
	 */
	public function findBySourceAndTarget($source, \Jkphl\Indieweb\Domain\Model\Page $page) {
		$query				= $this->_query();
		return $query->matching($query->logicalAnd($query->equals('source', $source), $query->equals('pid', $page)))->execute()->getFirst();
	}
	
	/**
	 * Find all unprocessed webmentions
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface		Result
	 */
	public function findUnprocessed() {
		$query				= $this->_query();
		return $query->matching($query->equals('processed', null))->execute();
	}
	
	/**
	 * Create and return a generic query
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface		Result
	 */
	protected function _query() {
		$query				= $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(false);
		$query->getQuerySettings()->setIgnoreEnableFields(true);
		$query->getQuerySettings()->setEnableFieldsToBeIgnored(array('disabled'));
		return $query;
	}
}