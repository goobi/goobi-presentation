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
        'title'     => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata',
        'label'     => 'label',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'sortby' => 'sorting',
        'delete'	=> 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'iconfile'	=> 'EXT:dlf/Resources/Public/Icons/txdlfmetadata.png',
        'rootLevel'	=> 0,
        'dividers2tabs' => 2,
        'searchFields' => 'label,index_name',
    ],
    'feInterface' => [
        'fe_admin_fieldList' => '',
    ],
    'interface' => [
        'showRecordFieldList' => 'label,index_name,is_sortable,is_facet,is_listed,index_autocomplete',
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
                'foreign_table' => 'tx_dlf_metadata',
                'foreign_table_where' => 'AND tx_dlf_metadata.pid=###CURRENT_PID### AND tx_dlf_metadata.sys_language_uid IN (-1,0) ORDER BY label ASC',
            ],
        ],
        'l18n_diffsource' => [
            'config' => [
                'type' => 'passthrough'
            ],
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'label' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.label',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,trim',
            ],
        ],
        'index_name' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.index_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,nospace,alphanum_x,uniqueInPid',
            ],
        ],
        'format' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.format',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_dlf_metadataformat',
                'foreign_field' => 'parent_id',
                'foreign_unique' => 'encoded',
                'appearance' => [
                    'expandSingle' => 1,
                    'levelLinksPosition' => 'bottom',
                    'enabledControls' => [
                        'info' => 0,
                        'new' => 1,
                        'dragdrop' => 0,
                        'sort' => 0,
                        'hide' => 0,
                        'delete' => 1,
                        'localize' => 0,
                    ],
                ],
            ],
        ],
        'default_value' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.default_value',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 1024,
                'eval' => 'trim',
            ],
        ],
        'wrap' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.wrap',
            'config' => [
                'type' => 'text',
                'cols' => 48,
                'rows' => 20,
                'wrap' => 'off',
                'eval' => 'trim',
                'default' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.wrap = <dd>|</dd>",
            ],
            'defaultExtras' => 'nowrap:fixed-font:enable-tab',
        ],
        'index_tokenized' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.index_tokenized',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'index_stored' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.index_stored',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'index_indexed' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.index_indexed',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'index_boost' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.index_boost',
            'config' => [
                'type' => 'input',
                'size' => 5,
                'max' => 64,
                'default' => '1.00',
                'eval' => 'double2',
            ],
        ],
        'is_sortable' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.is_sortable',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'is_facet' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.is_facet',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'is_listed' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.is_listed',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'index_autocomplete' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.index_autocomplete',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'status' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.status.default', 0],
                ],
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
                'default' => 0,
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => '--div--;LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.tab1, label,--palette--;;1;;1-1-1, format;;;;2-2-2, default_value;;;;3-3-3, wrap, --div--;LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.tab2, sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource, --div--;LLL:EXT:dlf/Resources/Private/Language/Common.xml:tx_dlf_metadata.tab3, hidden;;;;1-1-1, status;;;;2-2-2'],
    ],
    'palettes' => [
        '1' => ['showitem' => 'index_name, --linebreak--, index_tokenized, index_stored, index_indexed, index_boost, --linebreak--, is_sortable, is_facet, is_listed, index_autocomplete', 'canNotCollapse' => 1],
    ],
];
