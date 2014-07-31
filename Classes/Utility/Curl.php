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
 * cURL wrapper
 *
 * @category	Jkphl
 * @package		Jkphl_Indieweb
 * @author		Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright	Copyright © 2014 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License version 2 (GPL2)
 */
class Curl {
	/**
	 * Validate SSL certificates
	 * 
	 * @var \boolean
	 */
	protected static $_verify 		= true;
	/**
	 * Default headers
	 * 
	 * @var \array
	 */
	protected static $_options		= array(
		CURLOPT_RETURNTRANSFER		=> true, // return web page
		CURLOPT_ENCODING			=> '', // handle all encodings
		CURLOPT_USERAGENT			=> 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_3; en-US) AppleWebKit/534.3 (KHTML, like Gecko) Chrome/6.0.466.4 Safari/534.3', // who am i
		CURLOPT_AUTOREFERER			=> true, // set referer on redirect
		CURLOPT_CONNECTTIMEOUT		=> 120, // timeout on connect
		CURLOPT_TIMEOUT				=> 120, // timeout on response
		CURLOPT_MAXREDIRS			=> 10, // stop after 10 redirects
		CURLOPT_FOLLOWLOCATION		=> true,
		CURLOPT_HEADER				=> false,
		CURLOPT_HTTP_VERSION		=> CURL_HTTP_VERSION_1_1,
	);
	/**
	 * GET request
	 * 
	 * @var \string
	 */
	const GET = 'GET';
	/**
	 * POST request
	 * 
	 * @var \string
	 */
	const POST = 'POST';
	/**
	 * DELETE request
	 * 
	 * @var \string
	 */
	const DELETE = 'DELETE';
	/**
	 * PUT request
	 * 
	 * @var \string
	 */
	const PUT = 'PUT';

	/**
	 * Activate / deactivate the validation of SSL certificates
	 * 
	 * @param \boolean $verify			Validation of SSL certificates
	 * @return \boolean					Validation of SSL certificates
	 */
	public static function setVerify($verify = true) {
		self::$_verify					= (boolean)$verify;
		return self::$_verify;
	}
	
	/**
	 * Make a cURL request
	 *
	 * @param \string $url				URL
	 * @param \array $header			Header
	 * @param \string $method			HTTP method
	 * @param \string $body				Body
	 * @param \boolean $debug			Debugging output
	 * @param \array $options			Options
	 * @param \int $httpStatus			HTTP status code
	 * @return \string					Result
	 */
	public static function httpRequest($url, array $header = array(), $method = self::GET, $body = null, $debug = false, array $options = array(), &$httpStatus = 0) {
		$httpStatus						= 0;
		
		$curl							= curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt_array($curl, self::$_options);
		curl_setopt_array($curl, $options);

		if (!self::$_verify) {
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		}
	
		if ($body) {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, strval($body));
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array_merge($header, array('Content-Type: text/xml;charset=utf-8')));
		}
	
		$data							= curl_exec($curl);
		$info							= curl_getinfo($curl);
		$httpStatus						= $info['http_code'];
	
		// Debuging output
		if ($debug) {
			$info['method']				= $method;
			$info['body']				= strval($body);
			print_r($header);
			print_r($info);
		}
	
		curl_close($curl);
	
		return $data;
	}
}