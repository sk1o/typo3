.. include:: /Includes.rst.txt

.. _feature-103504-1712041725:

=============================================
Feature: #103504 - New ContentObject PAGEVIEW
=============================================

See :issue:`103504`

Description
===========

A new Content Object for TypoScript :typoscript:`PAGEVIEW` has been added.

This cObject is mainly intended for rendering a full page in the TYPO3 Frontend
with fewer configuration options over the generic :typoscript:`FLUIDTEMPLATE`
cObject.

A basic usage of the :typoscript:`PAGEVIEW` cObject is as follows:

.. code-block:: typoscript

    page = PAGE
    page.10 = PAGEVIEW
    page.10.paths.100 = EXT:mysite/Resources/Private/Templates/

:typoscript:`PAGEVIEW` wires certain parts automatically:

1. The name of the used page layout (Backend Layout) is resolved automatically.

If a page has a layout named "with_sidebar", the template file is then resolved
to :file:`EXT:mysite/Resources/Private/Templates/Pages/With_sidebar.html`.

2. Fluid features for Layouts and Partials are wired automatically, thus they
can be placed into :file:`EXT:mysite/Resources/Private/Templates/Layouts/`
and :file:`EXT:mysite/Resources/Private/Templates/Partials/`.

In order to reduce the burdon for integrators, the folder names for "pages",
"layouts" and "partials" can start with lower-case or upper-case.

3. Default variables are available in the Fluid template:

- :typoscript:`settings` - contains all TypoScript settings (= Constants)
- :typoscript:`site` - the current Site object
- :typoscript:`language` - the current Site Language object
- :typoscript:`page` - the current Page record as object

There is no special Extbase resolving done for the templates.

Before
------

.. code-block:: typoscript

    page = PAGE
    page {
        10 = FLUIDTEMPLATE
        10 {
            templateName = TEXT
            templateName {
                stdWrap {
                    cObject = TEXT
                    cObject {
                        data = levelfield:-2, backend_layout_next_level, slide
                        override {
                            field = backend_layout
                        }
                        split {
                            token = pagets__
                            1 {
                                current = 1
                                wrap = |
                            }
                        }
                    }
                    ifEmpty = Standard
                }
            }

            templateRootPaths {
                100 = {$plugin.tx_mysite.paths.templates}
            }

            partialRootPaths {
                100 = {$plugin.tx_mysite.paths.partials}
            }

            layoutRootPaths {
                100 = {$plugin.tx_mysite.paths.layouts}
            }

            variables {
                pageUid = TEXT
                pageUid.data = page:uid

                pageTitle = TEXT
                pageTitle.data = page:title

                pageSubtitle = TEXT
                pageSubtitle.data = page:subtitle

                parentPageTitle = TEXT
                parentPageTitle.data = levelfield:-1:title
            }

            dataProcessing {
                10 = menu
                10.as = mainMenu
            }
        }
    }

After
-----

.. code-block:: typoscript

    page = PAGE
    page {
        10 = PAGEVIEW
        10 {
            paths {
                100 = {$plugin.tx_mysite.paths.templates}
            }
            variables {
                parentPageTitle = TEXT
                parentPageTitle.data = levelfield:-1:title
            }
            dataProcessing {
                10 = menu
                10.as = mainMenu
            }
        }
    }

In Fluid, the pageUid is available as :html:`{page.uid}` and pageTitle
as :html:`{page.title}`.

Impact
======

Creating new page templates based on Fluid follows conventions in order to
reduce the amount of TypoScript needed to render a page in the TYPO3 Frontend.

Sane defaults are applied, variables and settings are available at any time.

.. note::

    This cObject is marked as experimental until TYPO3 v13 LTS as some
    functionality will be added.

.. index:: TypoScript, ext:frontend
