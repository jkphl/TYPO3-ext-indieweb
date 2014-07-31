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

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_indieweb_domain_model_webmention'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_indieweb_domain_model_webmention']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden, source, target, page, data, processed, valid',
	),
	'types' => array(
		'1' => array('showitem' => 'source, target, data, processed, valid, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, hidden;;1, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'source' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.source',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'target' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.target',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'processed' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.processed',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0
			),
		),
		'valid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.valid',
			'config' => array(
				'type' => 'check',
			),
		),
		'author_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.author.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'author_profile' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.author.profile',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'author_avatar' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.author.avatar',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'entry_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.entry.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'entry_summary' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.entry.summary',
			'config' => array(
				'type' => 'text',
				'rows' => 5,
			),
		),
		'entry_value' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.entry.value',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'entry_content' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.entry.content',
			'config' => array(
				'type' => 'text',
				'rows' => 5,
			),
		),
		'entry_published' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.entry.published',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0
			),
		),
		'entry_updated' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.entry.updated',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0
			),
		),
		'entry_url' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.entry.url',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'context' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:indieweb/Resources/Private/Language/locallang_db.xlf:tx_indieweb_domain_model_webmention.entry.context',
			'config' => array(
				'type' => 'text',
				'rows' => 5,
			),
		),
	),
);
