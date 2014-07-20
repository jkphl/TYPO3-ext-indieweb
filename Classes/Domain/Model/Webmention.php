<?php
namespace Jkphl\Indieweb\Domain\Model;


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
 * Webmention
 */
class Webmention extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Source URL
	 *
	 * @var \string
	 */
	protected $source = '';

	/**
	 * Target page
	 *
	 * @var \Jkphl\Indieweb\Domain\Model\Page
	 */
	protected $target = '';

	/**
	 * Processed state
	 *
	 * @var \DateTime
	 */
	protected $processed = NULL;
	
	/**
	 * Valid webmention
	 *
	 * @var \boolean
	 */
	protected $valid = false;

	/**
	 * Returns the source
	 *
	 * @return string $source
	 */
	public function getSource() {
		return $this->source;
	}

	/**
	 * Sets the source
	 *
	 * @param string $source
	 * @return void
	 */
	public function setSource($source) {
		$this->source = $source;
	}

	/**
	 * Returns the processed
	 *
	 * @return \DateTime $processed
	 */
	public function getProcessed() {
		return $this->processed;
	}

	/**
	 * Sets the processed
	 *
	 * @param \DateTime $processed
	 * @return void
	 */
	public function setProcessed(\DateTime $processed) {
		$this->processed = $processed;
	}
	
	/**
	 * Target page
	 * 
	 * @return \Jkphl\Indieweb\Domain\Model\Page				Target page
	 */
	public function getTarget() {
		return $this->target;
	}

	/**
	 * Target page
	 * 
	 * @param \Jkphl\Indieweb\Domain\Model\Page					Target page
	 */
	public function setTarget(\Jkphl\Indieweb\Domain\Model\Page $target) {
		$this->target = $target;
	}
	
	/**
	 * @return the $valid
	 */
	public function getValid() {
		return $this->valid;
	}

	/**
	 * @param Boolean $valid
	 */
	public function setValid($valid) {
		$this->valid = $valid;
	}

	/**
	 * Reset and reevaluate this webmention
	 * 
	 * @return void
	 */
	public function reset() {
		$this->setProcessed(null);
		$this->setValid(false);
	}
}