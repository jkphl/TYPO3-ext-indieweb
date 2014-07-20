<?php

namespace Jkphl\Indieweb\Utility;

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

class Urltools {
	/**
	 * Frontend engine instance
	 * 
	 * @var \Jkphl\Indieweb\Utility\TypoScriptFrontendController
	 */
	protected static $_tsfe;

	/**
	 * Extract the GET and POST parameter out of a frontend URL
	 * 
	 * @param mixed $url				Frontend URL
	 * @param \int $pid					Current page ID
	 * @return array					Merged GET and POST parameters
	 */
	public static function extractGETParameters($url, $pid = 1) {
		if (!(self::$_tsfe instanceof TypoScriptFrontendController)) {
			self::_initializeTSFE($pid);
		}
		if (!($GLOBALS['TSFE'] instanceof TypoScriptFrontendController)) {
			$GLOBALS['TSFE']		=& self::$_tsfe;
			$unsetTSFE				= true;
		} else {
			$unsetTSFE				= false;
		}
		
		// Backup environment variables
		$backup						= array(
			'_GET'					=> $_GET,
			'_POST'					=> $_POST,
			'_SERVER'				=> $_SERVER,
		);

		// Reset the relevant environment variables
		$urlParts					= parse_url($url);
// 		$_SERVER['SCRIPT_NAME']		= '/typo3/mod.php';
		$_SERVER['SCRIPT_NAME']		= '/index.php';
		$_SERVER['SERVER_NAME']		= $urlParts['host'];
		$_SERVER['QUERY_STRING']	= empty($urlParts['query']) ? '' : $urlParts['query'];
		$_SERVER['REQUEST_URI']		= (empty($urlParts['path']) ? '/' : $urlParts['path']).(empty($urlParts['query']) ? '' : '?'.$urlParts['query']);
		$_POST						= array();
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		
		// If RealURL is in use
		$preprocConfig				= null;
		if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('realurl')) {
			$preprocConfig			= empty($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['decodeSpURL_preProc']) ? false : $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['decodeSpURL_preProc'];
			if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['decodeSpURL_preProc'])) {
				$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['decodeSpURL_preProc']		= array();
			}
			
			$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['decodeSpURL_preProc'][]			= 'EXT:indieweb/Classes/Utility/Urltools.php:Jkphl\Indieweb\Utility\Urltools->realUrlPreProc';
		}
		
		// Apply alternative ID methods (like e.g. cooluri / RealURL)
		try {
			self::$_tsfe->checkAlternativeIdMethods();
		} catch (\Exception $e) {
			echo "ERROR: ".$e->getCode()."\n";
			if ($e->getCode() != 404) {
				throw $e;
			}
		}
		
		// Extract GET variables
		$getVariables				= $_GET;
		$getVariables['id']			= self::$_tsfe->id;
		$getVariables['type']		= self::$_tsfe->type;
		
		// Reset environment
		$GLOBALS					= array_merge($GLOBALS, $backup);
		$_GET						= $GLOBALS['_GET'];
		$_POST						= $GLOBALS['_POST'];
		$_SERVER					= $GLOBALS['_SERVER'];
		
		// Reset RealURL pre-processing configuration
		if ($preprocConfig !== null) {
			if ($preprocConfig === false) {
				unset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['decodeSpURL_preProc']);
			} else {
				$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['decodeSpURL_preProc'] = $preprocConfig;
			}
		}
		
		// Reset TSFE
		if ($unsetTSFE) {
			unset($GLOBALS['TSFE']);
		}
		
		return $getVariables;
	}
	
	/**
	 * Initialize a private TSFE instance
	 * 
	 * @param \int $pid					Current page ID
	 * @return void
	 */
	protected static function _initializeTSFE($pid = 1) {
		self::$_tsfe			= \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Jkphl\\Indieweb\\Utility\\TypoScriptFrontendController', $GLOBALS['TYPO3_CONF_VARS'], $pid, 0, true);
		self::$_tsfe->tmpl		= \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\TypoScript\\TemplateService');
		self::$_tsfe->tmpl->init();
		
// 		self::$_tsfe->initFEuser();
// 		self::$_tsfe->fe_user->fetchGroupData();
// 		self::$_tsfe->includeTCA();
// 		self::$_tsfe->fetch_the_id();
// 		self::$_tsfe->getConfigArray();
// 		self::$_tsfe->includeLibraries(self::$_tsfe->tmpl->setup['includeLibs.']);
// 		self::$_tsfe->newCObj();
	}
	
	/**
	 * Pre-processing for RealURL decoding
	 * 
	 * This method basically disables the "appendMissingSlash" feature of RealURL, as this could result
	 * in a HTTP redirect header being issued.
	 * 
	 * @param array $params				Parameters
	 * @param \tx_realurl $pObj			RealURL object
	 * @return void
	 */
	public function realUrlPreProc(array $params, &$pObj) {
		unset($pObj->extConf['init']['appendMissingSlash']);
	}
}