<?php

########################################################################
# Extension Manager/Repository config file for ext "indieweb".
#
# Auto generated 31-07-2014 15:22
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'IndieWeb Publishing Tools',
	'description' => 'A growing collection of IndieWeb publishing tools for TYPO3 sites, currently featuring the receipt of Webmentions',
	'category' => 'plugin',
	'author' => 'Joschi Kuphal',
	'author_email' => 'joschi@kuphal.net',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '0.1.0',
	'constraints' => array(
		'depends' => array(
			'php' => '5.3.0-0.0.0',
			'typo3' => '6.0.0-6.2.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:50:{s:13:"composer.json";s:4:"6154";s:21:"ext_conf_template.txt";s:4:"7938";s:12:"ext_icon.gif";s:4:"979f";s:17:"ext_localconf.php";s:4:"59d0";s:14:"ext_tables.php";s:4:"98a5";s:14:"ext_tables.sql";s:4:"f52d";s:24:"ext_typoscript_setup.txt";s:4:"e028";s:11:"LICENSE.txt";s:4:"8c16";s:9:"README.md";s:4:"8cd2";s:43:"Classes/Controller/WebmentionController.php";s:4:"dda7";s:29:"Classes/Domain/Model/Page.php";s:4:"0c24";s:35:"Classes/Domain/Model/Webmention.php";s:4:"b007";s:44:"Classes/Domain/Repository/PageRepository.php";s:4:"726a";s:50:"Classes/Domain/Repository/WebmentionRepository.php";s:4:"6cf2";s:39:"Classes/Task/ProcessWebmentionsTask.php";s:4:"46f2";s:24:"Classes/Utility/Curl.php";s:4:"5b8e";s:24:"Classes/Utility/Test.php";s:4:"3c2c";s:23:"Classes/Utility/Url.php";s:4:"561d";s:32:"Configuration/TCA/Webmention.php";s:4:"0958";s:38:"Configuration/TypoScript/constants.txt";s:4:"4c42";s:34:"Configuration/TypoScript/setup.txt";s:4:"d1be";s:26:"Documentation/Includes.txt";s:4:"c83c";s:23:"Documentation/Index.rst";s:4:"6cef";s:24:"Documentation/Readme.rst";s:4:"269c";s:26:"Documentation/Settings.yml";s:4:"9c02";s:37:"Documentation/Administrator/Index.rst";s:4:"927a";s:33:"Documentation/ChangeLog/Index.rst";s:4:"2f70";s:37:"Documentation/Configuration/Index.rst";s:4:"085f";s:33:"Documentation/Developer/Index.rst";s:4:"ffbd";s:61:"Documentation/Images/AdministratorManual/ExtensionManager.png";s:4:"b02d";s:55:"Documentation/Images/AdministratorManual/TypoScript.png";s:4:"33c2";s:54:"Documentation/Images/ConfigurationManual/Scheduler.png";s:4:"b931";s:36:"Documentation/Introduction/Index.rst";s:4:"b50b";s:37:"Documentation/KnownProblems/Index.rst";s:4:"c382";s:47:"Documentation/Localization.de_DE.tmpl/Index.rst";s:4:"8603";s:44:"Documentation/Localization.de_DE.tmpl/README";s:4:"fe42";s:50:"Documentation/Localization.de_DE.tmpl/Settings.yml";s:4:"8630";s:47:"Documentation/Localization.fr_FR.tmpl/Index.rst";s:4:"5c9b";s:44:"Documentation/Localization.fr_FR.tmpl/README";s:4:"1daf";s:50:"Documentation/Localization.fr_FR.tmpl/Settings.yml";s:4:"3fbe";s:32:"Documentation/ToDoList/Index.rst";s:4:"4819";s:28:"Documentation/User/Index.rst";s:4:"a912";s:40:"Resources/Private/Language/locallang.xlf";s:4:"157a";s:80:"Resources/Private/Language/locallang_csh_tx_indieweb_domain_model_webmention.xlf";s:4:"aad3";s:43:"Resources/Private/Language/locallang_db.xlf";s:4:"0575";s:48:"Resources/Private/Templates/Webmention/Ping.html";s:4:"d41d";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:62:"Resources/Public/Icons/tx_indieweb_domain_model_webmention.gif";s:4:"881d";s:50:"Tests/Unit/Controller/WebmentionControllerTest.php";s:4:"ba9f";s:42:"Tests/Unit/Domain/Model/WebmentionTest.php";s:4:"d0da";}',
);

?>