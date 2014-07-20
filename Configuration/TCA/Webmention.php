<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_indieweb_domain_model_webmention'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_indieweb_domain_model_webmention']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden, source, target, processed, valid',
	),
	'types' => array(
		'1' => array('showitem' => 'source, target, processed, valid, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, hidden;;1, starttime, endtime'),
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
				'type' => 'select',
				'foreign_table' => 'pages',
				'size' => 1,
				'maxitems' => 1,
				'minitems' => 1,
				'show_thumbs' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
					)
				),
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
	),
);
