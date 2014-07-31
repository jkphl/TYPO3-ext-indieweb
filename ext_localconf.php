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

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$_EXTCONF			= unserialize($_EXTCONF);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Jkphl.'.$_EXTKEY,
	'Webmention',
	array(
		'Webmention' => 'ping',
	),
	// non-cacheable actions
	array(
		'Webmention' => 'ping',
	)
);

if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['webmention-PostProc'])) {
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['webmention-PostProc'] = array();
}

// Example hook for webmention registration
if (intval($_EXTCONF['webmentionsDemoHook'])) {
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['webmention-PostProc'][] = 'Jkphl\\Indieweb\\Utility\\Test->webmention';
}

// Register webmention processing task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Jkphl\\Indieweb\\Task\\ProcessWebmentionsTask'] = array(
	'extension'			=> $_EXTKEY,
	'title'				=> 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/locallang.xlf:task.processWebmentionsTask.name',
	'description'		=> 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/locallang.xlf:task.processWebmentionsTask.description',
	'additionalFields'	=> '',
);