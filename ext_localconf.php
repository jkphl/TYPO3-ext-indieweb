<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

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
