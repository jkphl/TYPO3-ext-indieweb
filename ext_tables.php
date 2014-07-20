<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'IndieWeb Publishing Tools');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_indieweb_domain_model_webmention', 'EXT:indieweb/Resources/Private/Language/locallang_csh_tx_indieweb_domain_model_webmention.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_indieweb_domain_model_webmention');
$GLOBALS['TCA']['tx_indieweb_domain_model_webmention'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention',
		'label' => 'source',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime'
		),
		'searchFields' => 'source,target,processed,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Webmention.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_indieweb_domain_model_webmention.gif'
	)
);
