.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _user-manual:

Users Manual
============

Target group: **Editors**

At the time of this writing, the extension's initial and only feature is the support for receiving `Webmentions`_.

.. only:: html

   .. contents::
      :local:
      :depth: 1
      

Webmentions
-----------

`Webmentions`_ are a simple way to notify any URL when another site links to it. To a certain extent,
Webmentions are a modern successor for `Pingbacks`_, using only HTTP rather than XMLRPC requests. From an editor's
point of view, there isn't much to do about receiving webmentions. It's an "under the hood" feature that has to be
implemented by the site :ref:`administrator <admin-manual>` / :ref:`developer <developer>`.


.. _Pingbacks: http://en.wikipedia.org/wiki/Pingback