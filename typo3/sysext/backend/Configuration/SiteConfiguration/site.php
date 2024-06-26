<?php

return [
    'ctrl' => [
        'label' => 'identifier',
        'title' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.ctrl.title',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-content-domain',
        ],
    ],
    'columns' => [
        'identifier' => [
            'label' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.identifier',
            'description' => 'LLL:EXT:backend/Resources/Private/Language/siteconfiguration_fieldinformation.xlf:site.identifier',
            'config' => [
                'type' => 'input',
                'size' => 35,
                'max' => 255,
                'required' => true,
                // identifier is used as directory name - allow a-z,0-9,_,- as chars only.
                // unique is additionally checked server side
                'eval' => 'lower, alphanum_x, trim',
            ],
        ],
        'rootPageId' => [
            'label' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.rootPageId',
            'description' => 'LLL:EXT:backend/Resources/Private/Language/siteconfiguration_fieldinformation.xlf:site.rootPageId',
            'config' => [
                'type' => 'select',
                'readOnly' => true,
                'renderType' => 'selectSingle',
                'foreign_table' => 'pages',
                'foreign_table_where' => ' AND ({#is_siteroot}=1 OR ({#pid}=0 AND {#doktype} IN (1,6,7))) AND {#l10n_parent} = 0 ORDER BY pid, sorting',
            ],
        ],
        'base' => [
            'label' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.base',
            'description' => 'LLL:EXT:backend/Resources/Private/Language/siteconfiguration_fieldinformation.xlf:site.base',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim',
            ],
        ],
        'baseVariants' => [
            'label' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.baseVariants',
            'description' => 'LLL:EXT:backend/Resources/Private/Language/siteconfiguration_fieldinformation.xlf:site.baseVariants',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'site_base_variant',
                'appearance' => [
                    'enabledControls' => [
                        'info' => false,
                    ],
                ],
            ],
        ],
        'websiteTitle' => [
            'label' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.websiteTitle',
            'description' => 'LLL:EXT:backend/Resources/Private/Language/siteconfiguration_fieldinformation.xlf:site.websiteTitle',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'dependencies' => [
            'label' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.dependencies',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'itemsProcFunc' => \TYPO3\CMS\Core\Site\TcaSiteSetCollector::class . '->populateSiteSets',
                'size' => 5,
                'maxitems' => 9999,
            ],
        ],
        'languages' => [
            'label' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.languages',
            'description' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.languages.description',
            'config' => [
                'type' => 'siteLanguage',
            ],
        ],
        'errorHandling' => [
            'label' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.errorHandling',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'site_errorhandling',
                'appearance' => [
                    'collapseAll' => true,
                    'enabledControls' => [
                        'info' => false,
                    ],
                ],
            ],
        ],
        'routes' => [
            'label' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.routes',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'site_route',
                'appearance' => [
                    'collapseAll' => true,
                    'enabledControls' => [
                        'info' => false,
                    ],
                ],
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;default,--palette--;;base,dependencies,
                --div--;LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.tab.languages, languages,
                --div--;LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.tab.errorHandling, errorHandling,
                --div--;LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_tca.xlf:site.tab.routes, routes',
        ],
    ],
    'palettes' => [
        'default' => [
            'showitem' => 'rootPageId, identifier, --linebreak--, websiteTitle',
        ],
        'base' => [
            'showitem' => 'base, baseVariants',
        ],
    ],
];
