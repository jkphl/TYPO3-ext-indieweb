.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _known-problems:

Known Problems
==============

See below for a list of known problems. If you experience anything else please
file an issue at the `extension's GitHub repository`_ or `contact the author`_. Thank you!

*  At some point in the future, the TYPO3 extension manager (EM) is supposed to fully support
   `Composer`_ for dependency management. Right now, though, support for `composer.json` files
   don't seem very mature. The webmention feature depends on the `jkphl/micrometa`_ package
   (which isn't a native TYPO3 extension). Every now and then the EM reports
   a problem due to it's inability to find *micrometa* among the available TYPO3 extensions.
   The only workaround seems to remove the *micrometa* dependency from the `composer.json`
   file, clear the caches, re-run the desired operation and recreate the *micrometa* dependency
   afterwards. Another solution might be removing the composer.json file altogether (as long
   as Composer support in TYPO3 doesn't improve). The file will be recreated on extension
   updates though.

.. _extension's GitHub repository: https://github.com/jkphl/TYPO3-ext-indieweb/issues
.. _contact the author: mailto:joschi@tollwerk.de
.. _Composer: https://getcomposer.org
.. _jkphl/micrometa: https://github.com/jkphl/micrometa