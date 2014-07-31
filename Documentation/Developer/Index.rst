.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _developer:

Developer Corner
================

Target group: **Developers**

This chapter contains in-depth details about the various extension features.

.. only:: html

   .. contents::
      :local:
      :depth: 1

.. _developer-webmentions:

Webmentions
-----------

Processing webmentions may be done asynchronously (recommended) or synchronously. Please see the
TypoScript constant :typoscript:`plugin.tx_indieweb.settings.webmentions.async` for details on
how to control the processing style. The scheduler task "Process webmentions" will take care of
the asynchronous processing, while synchronously processed webmentions will be immediately
validated as soon as they are received (don't do this; you might be vulnerable to DDoS attacks
this way).

Asynchronous processing
^^^^^^^^^^^^^^^^^^^^^^^

In asynchronous mode, for each webmention the extension will try to find the TYPO3 page
being referenced and — in case of success — create a corresponding webmention record on this very
page. The records are hidden by default until they are successfully validated by the "Process
webmentions" scheduler task. Validation follows the `webmention protocol summary`_.

Synchronous processing
^^^^^^^^^^^^^^^^^^^^^^

In synchronous mode, each incoming webmention will be processed immediately, creating a webmention
record only if the webmention validates.

.. _developer-webmentions-hook:

Post-processing hook
^^^^^^^^^^^^^^^^^^^^

Incoming webmentions will be validated, but they won't have any effect other than creating (or
updating) their corresponding webmention record. In order to further exploit the receipt of a
webmention, e.g. by translating it into a blog comment, you need to implement a `custom hook`_
as part of a TYPO3 extension. You must register your hook in the `ext_localconf.php` of your
extension like this:

.. code-block:: typoscript

   $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['webmention-PostProc'][] = 'Vendor\\ExtensionName\\Utility\\Hooks->webmention';

The hook callback will get passed two arguments:

+-------------+----------------------------------------------+----------------------------------------------------------------------+
| Parameter   | Data type                                    | Description                                                          |
+=============+==============================================+======================================================================+
| $params     | array                                        | List of parameters (currently only containing the webmention itself) |
+-------------+----------------------------------------------+----------------------------------------------------------------------+
| $webmention | \\Jkphl\\Indieweb\\Domain\\Model\\Webmention | The webmention record                                                |
+-------------+----------------------------------------------+----------------------------------------------------------------------+

Simply call `$webmention->getValid()` to find out if the webmention validated. For testing purposes,
the extension features a demo hook callback that you can enable in the extension's Extension Manager
(EM) settings. Don't enable this demo hook on production systems! It will just print some information
about the webmention record itself and possibly disrupt your frontend or backend output:

.. code-block:: php

   public function webmention(array $params, \Jkphl\Indieweb\Domain\Model\Webmention $webmention) {
      $objectManager    = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
      $pageRepository   = $objectManager->get('Jkphl\\Indieweb\\Domain\\Repository\\PageRepository');
      
      var_export(array(
         'source'       => $webmention->getSource(),
         'target'       => $webmention->getTarget(),
         'page'         => $pageRepository->findByUid($webmention->getPid())->getTitle(),
         'author'       => array(
            'name'      => $webmention->getAuthorName(),
            'avatar'    => $webmention->getAuthorAvatar(),
            'profile'   => $webmention->getAuthorProfile(),
         ),
         'entry'        => array(
            'name'      => $webmention->getEntryName(),
            'summary'   => $webmention->getEntrySummary(),
            'value'     => $webmention->getEntryValue(),
            'content'   => $webmention->getEntryContent(),
            'published' => $webmention->getEntryPublished(),
            'updated'   => $webmention->getEntryUpdated(),
            'url'       => $webmention->getEntryUrl(),
         ),
         'context'      => $webmention->getContext(),
      ));
   }
   
It's completely up to you what to make out of your webmentions.

.. _webmention protocol summary: http://indiewebcamp.com/webmention
.. _custom hook: http://wiki.typo3.org/Hook_programming