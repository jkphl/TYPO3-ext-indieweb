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
 * URL manipulator
 *
 * @category	Jkphl
 * @package		Jkphl_Indieweb
 * @author		Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright	Copyright © 2017 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
 */
class Url {
	/**
	 * URL
	 * 
	 * @var \string
	 */
	protected $_url = null;
	/**
	 * URL parts
	 * 
	 * @var \array
	 */
	protected $_parts = null;
	/**
	 * Key names
	 * 
	 * @var array
	 */
	protected static $_keys = array(
		PHP_URL_SCHEME		=> 'scheme',
		PHP_URL_HOST		=> 'host',
		PHP_URL_PORT		=> 'port',
		PHP_URL_USER		=> 'user',
		PHP_URL_PASS		=> 'pass',
		PHP_URL_PATH		=> 'path',
		PHP_URL_QUERY		=> 'query',
		PHP_URL_FRAGMENT	=> 'fragment'
	);
	
	/**
	 * Constructor
	 * 
	 * @param \string $url						Original URL
	 * @param \boolean $sanitize				Sanitize URL
	 * @return \Jkphl\Indieweb\Utility\Url		Self reference 
	 */
	public function __construct($url, $sanitize = false) {
		$this->_url					= $url;
		if (strncmp('//', $this->_url, 2)) {
			$this->_parts			= parse_url($url);
		} else {
			$this->_parts			= parse_url("http:$url");
			unset($this->_parts['scheme']);
		}
		if (empty($this->_parts['query'])) {
			$this->_parts['query']	= array();
		} else {
			parse_str($this->_parts['query'], $this->_parts['query']);
		}
		if ($sanitize) {
			$this->sanitize();
		}
	}
	
	/**
	 * Return a specific key value
	 * 
	 * @param \string $key						Property key
	 * @return \mixed							Property value
	 */
	public function __get($key) {
		return array_key_exists($key, $this->_parts) ? $this->_parts[$key] : null;
	}
	
	/**
	 * Set a specific key value
	 * 
	 * @param \string $key						Key
	 * @param \mixed $value						Value
	 * @return \Jkphl\Indieweb\Utility\Url		Self reference
	 */
	public function __set($key, $value) {
		return $this->set($key, $value);
	}
	
	/**
	 * Set a specific key value
	 * 
	 * @param \string $key						Key
	 * @param \mixed $value						Value
	 * @return \Jkphl\Indieweb\Utility\Url		Self reference
	 */
	public function set($key, $value) {
		if (array_key_exists($key, self::$_keys)) {
			$this->_parts[self::$_keys[$key]] = $value;
		}
		return $this;
	}
	
	/**
	 * Add query parameters
	 * 
	 * @param \array $params					Additional query parameters
	 * @return \Jkphl\Indieweb\Utility\Url		Self reference
	 */
	public function addQuery(array $params) {
		$this->_parts['query']		= array_merge($this->_parts['query'], $params);
		return $this;
	}
	
	/**
	 * Remove query parameters
	 *
	 * @param \array $params					Remove query parameters
	 * @return \Jkphl\Indieweb\Utility\Url		Self reference
	 */
	public function removeQuery(array $params) {
		$this->_parts['query']		= array_diff_key($this->_parts['query'], array_flip($params));
		return $this;
	}
	
	/**
	 * Sanitize some default values
	 * 
	 * @return \Jkphl\Indieweb\Utility\Url		Self reference
	 */
	public function sanitize() {
		if (empty($this->_parts['scheme'])) {
			$this->_parts['scheme']		= 'http';
		}
		if (empty($this->_parts['path'])) {
			$this->_parts['path']		= '/';
		}
		return $this;
	}
	
	/**
	 * String serialization
	 * 
	 * @return \string					URL
	 */
	public function __toString() {
		$url							= (empty($this->_parts['scheme']) ? 'http' : $this->_parts['scheme']).'://';
		$url							.= empty($this->_parts['user']) ? '' : rawurlencode($this->_parts['user']).(empty($this->_parts['pass']) ? '' : ':'.rawurlencode($this->_parts['pass'])).'@';
		$url							.= $this->_parts['host'];
		$url							.= empty($this->_parts['port']) ? '' : ':'.$this->_parts['port'];
		$url							.= empty($this->_parts['path']) ? '' : $this->_parts['path'];
		$url							.= count($this->_parts['query']) ? '?'.http_build_query($this->_parts['query']) : '';
		$url							.= empty($this->_parts['fragment']) ? '' : '#'.$this->_parts['fragment'];
		return $url;
	}
	
	/**
	 * Resolve this URL against a reference URL (in case this one's relative)
	 * 
	 * @param \Jkphl\Indieweb\Utility\Url $reference		Reference URL
	 * @return \Jkphl\Indieweb\Utility\Url					Self reference
	 */
	public function resolve(\Jkphl\Indieweb\Utility\Url $reference) {

		// If this URL is relative
		if (empty($this->_parts['host'])) {
			$transfer					= array('scheme', 'host', 'port', 'user', 'pass');
		
		// Else if this URL is protocol relative
		} elseif (empty($this->_parts['scheme'])) {
			$transfer					= array('scheme');
			
		// Else: Nothing to transfer
		} else {
			$transfer					= array();
		}
		
		// Run through all transferrable keys 
		foreach ($transfer as $key) {
			if (empty($this->_parts[$key])) {
				$this->$key				= $reference->$key;
			}
		}
		
		return $this;
	}
}