<?php
/**
 * (c) Kitodo. Key to digital objects e.V. <contact@kitodo.org>
 *
 * This file is part of the Kitodo and TYPO3 projects.
 *
 * @license GNU General Public License version 3 or later.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

return [
    'ctrl' => [
        'title'     => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries',
        'label'     => 'label',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'default_sortby' => 'ORDER BY label',
        'delete'	=> 'deleted',
        'iconfile'	=> 'EXT:dlf/Resources/Public/Icons/txdlflibraries.png',
        'rootLevel'	=> 0,
        'dividers2tabs' => 2,
        'searchFields' => 'label,website,contact',
    ],
    'feInterface' => [
        'fe_admin_fieldList' => '',
    ],
    'interface' => [
        'showRecordFieldList' => 'label,website,contact',
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0],
                ],
                'default' => 0
            ],
        ],
        'l18n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_dlf_libraries',
                'foreign_table_where' => 'AND tx_dlf_libraries.pid=###CURRENT_PID### AND tx_dlf_libraries.sys_language_uid IN (-1,0)',
            ],
        ],
        'l18n_diffsource' => [
            'config' => [
                'type' => 'passthrough'
            ],
        ],
        'label' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.label',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,trim',
            ],
        ],
        'index_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.index_name',
            'config' => [
                'type' => 'none',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,uniqueInPid',
            ],
        ],
        'website' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.website',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'nospace',
            ],
        ],
        'contact' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.contact',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'nospace',
            ],
        ],
        'image' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.image',
            'config' => [
                'type' => 'group',
                'internal_type' => 'file',
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'max_size' => 256,
                'uploadfolder' => 'uploads/tx_dlf',
                'show_thumbs' => 1,
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'oai_label' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.oai_label',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'oai_base' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.oai_base',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'opac_label' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.opac_label',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'opac_base' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.opac_base',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'nospace',
            ],
        ],
        'union_label' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.union_label',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'union_base' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.union_base',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'nospace',
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => '--div--;LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.tab1, label,--palette--;;1;;1-1-1, website;;;;2-2-2, contact, image;;;;3-3-3, --div--;LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.tab2, sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource, --div--;LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_libraries.tab3, oai_label,--palette--;;2;;1-1-1, opac_label,--palette--;;3;;2-2-2, union_label,--palette--;;4;;3-3-3'],
    ],
    'palettes' => [
        '1' => ['showitem' => 'index_name', 'canNotCollapse' => 1],
        '2' => ['showitem' => 'oai_base', 'canNotCollapse' => 1],
        '3' => ['showitem' => 'opac_base', 'canNotCollapse' => 1],
        '4' => ['showitem' => 'union_base', 'canNotCollapse' => 1],
    ],
];
