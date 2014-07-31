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

namespace Jkphl\Indieweb\Domain\Model;

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
 * Page model
 *
 * @category	Jkphl
 * @package		Jkphl_Indieweb
 * @author		Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright	Copyright © 2014 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
 */
class Page extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
	/**
	 * Creation date
	 *
	 * @var \integer
	 */
	protected $crdate;
	/**
	 * Last modification
	 *
	 * @var \integer
	 */
	protected $tstamp;
	/**
	 * Last modification
	 *
	 * @var \integer
	 */
	protected $lastUpdated;
	/**
	 * Last modification of article or content
	 *
	 * @var \integer
	 */
	protected $sysLastchanged;
	/**
	 * Activation date
	 * 
	 * @var \integer
	 */
	protected $starttime;
	/**
	 * Article title
	 * 
	 * @var \string
	 */
	protected $title;
	/**
	 * Article subtitle
	 *
	 * @var \string
	 */
	protected $subtitle;
	/**
	 * Article abstract
	 * 
	 * @var \string
	 */
	protected $abstract;
	
	/**
	 * @return the $crdate
	 */
	public function getCrdate() {
		return $this->crdate;
	}

	/**
	 * @param integer $crdate
	 */
	public function setCrdate($crdate) {
		$this->crdate = $crdate;
	}

	/**
	 * @return the $tstamp
	 */
	public function getTstamp() {
		return $this->tstamp;
	}

	/**
	 * @param integer $tstamp
	 */
	public function setTstamp($tstamp) {
		$this->tstamp = $tstamp;
	}

	/**
	 * @return the $lastUpdated
	 */
	public function getLastUpdated() {
		return $this->lastUpdated;
	}

	/**
	 * @param integer $lastUpdated
	 */
	public function setLastUpdated($lastUpdated) {
		$this->lastUpdated = $lastUpdated;
	}

	/**
	 * @return the $sysLastchanged
	 */
	public function getSysLastchanged() {
		return $this->sysLastchanged;
	}

	/**
	 * @param integer $sysLastchanged
	 */
	public function setSysLastchanged($sysLastchanged) {
		$this->sysLastchanged = $sysLastchanged;
	}

	/**
	 * @return the $starttime
	 */
	public function getStarttime() {
		return $this->starttime;
	}

	/**
	 * @param integer $starttime
	 */
	public function setStarttime($starttime) {
		$this->starttime = $starttime;
	}

	/**
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return the $subtitle
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}

	/**
	 * @param string $subtitle
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
	}

	/**
	 * @return the $abstract
	 */
	public function getAbstract() {
		return $this->abstract;
	}

	/**
	 * @param string $abstract
	 */
	public function setAbstract($abstract) {
		$this->abstract = $abstract;
	}


}