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
        'title'     => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections',
        'label'     => 'label',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'fe_cruser_id' => 'fe_cruser_id',
        'fe_admin_lock' => 'fe_admin_lock',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'default_sortby' => 'ORDER BY label',
        'delete'	=> 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'fe_group' => 'fe_group',
        ],
        'requestUpdate' => 'sys_language_uid',
        'iconfile'	=> 'EXT:dlf/Resources/Public/Icons/txdlfcollections.png',
        'rootLevel'	=> 0,
        'dividers2tabs' => 2,
        'searchFields' => 'label,index_name,oai_name,fe_cruser_id',
    ],
    'feInterface' => [
        'fe_admin_fieldList' => 'label,description,thumbnail,documents',
    ],
    'interface' => [
        'showRecordFieldList' => 'label,index_name,oai_name,fe_cruser_id',
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
                'default' => 0,
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
                'foreign_table' => 'tx_dlf_collections',
                'foreign_table_where' => 'AND tx_dlf_collections.pid=###CURRENT_PID### AND tx_dlf_collections.sys_language_uid IN (-1,0)',
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
        'fe_group' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1],
                    ['LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2],
                    ['LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--'],
                ],
                'foreign_table' => 'fe_groups',
                'size' => 5,
                'autoSizeMax' => 15,
                'minitems' => 0,
                'maxitems' => 20,
                'exclusiveKeys' => '-1,-2',
            ],
        ],
        'label' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.label',
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
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.index_name',
            'config' => [
                'type' => 'none',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,uniqueInPid',
            ],
        ],
        'index_search' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.index_search',
            'config' => [
            'type' => 'text',
                'cols' => 30,
                'rows' => 5,
                'eval' => '',
            ],
        ],
        'oai_name' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.oai_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'nospace,alphanum_x,uniqueInPid',
            ],
        ],
        'description' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.description',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 10,
                'wrap' => 'virtual',
            ],
            'defaultExtras' => 'richtext[undo,redo,cut,copy,paste,link,image,line,acronym,chMode,blockstylelabel,formatblock,blockstyle,textstylelabel,textstyle,bold,italic,unorderedlist,orderedlist]:rte_transform[mode=ts_css]',
        ],
        'thumbnail' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.thumbnail',
            'config' => [
                'type' => 'group',
                'internal_type' => 'file_reference',
                'allowed' => 'gif,jpg,png',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'priority' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.priority',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['1', 1],
                    ['2', 2],
                    ['3', 3],
                    ['4', 4],
                    ['5', 5],
                ],
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
                'default' => 3,
            ],
        ],
        'documents' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.documents',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_dlf_documents',
                'foreign_table_where' => 'AND tx_dlf_documents.pid=###CURRENT_PID### ORDER BY tx_dlf_documents.title_sorting',
                'size' => 5,
                'autoSizeMax' => 15,
                'minitems' => 0,
                'maxitems' => 1048576,
                'MM' => 'tx_dlf_relations',
                'MM_match_fields' => [
                    'ident' => 'docs_colls',
                ],
                'MM_opposite_field' => 'collections',
            ],
        ],
        'owner' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.owner',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:dlf/locallang.xml:tx_dlf_collections.owner.none', 0],
                ],
                'foreign_table' => 'tx_dlf_libraries',
                'foreign_table_where' => 'AND tx_dlf_libraries.sys_language_uid IN (-1,0) ORDER BY tx_dlf_libraries.label',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'fe_cruser_id' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.fe_cruser_id',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:dlf/locallang.xml:tx_dlf_collections.fe_cruser_id.none', 0],
                ],
                'foreign_table' => 'fe_users',
                'foreign_table_where' => 'ORDER BY fe_users.username',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'fe_admin_lock' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.fe_admin_lock',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'status' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:dlf/locallang.xml:tx_dlf_collections.status.default', 0],
                ],
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
                'default' => 0,
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => '--div--;LLL:EXT:dlf/locallang.xml:tx_dlf_collections.tab1, label,--palette--;;1;;1-1-1, description,--palette--;;2;;2-2-2, --div--;LLL:EXT:dlf/locallang.xml:tx_dlf_collections.tab2, sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource, --div--;LLL:EXT:dlf/locallang.xml:tx_dlf_collections.tab3, hidden;;;;1-1-1, fe_group;;;;2-2-2, status;;;;3-3-3, owner;;;;4-4-4, fe_cruser_id,--palette--;;3'],
    ],
    'palettes' => [
        '1' => ['showitem' => 'index_name, --linebreak--, index_search, --linebreak--, oai_name', 'canNotCollapse' => 1],
        '2' => ['showitem' => 'thumbnail, priority', 'canNotCollapse' => 1],
        '3' => ['showitem' => 'fe_admin_lock', 'canNotCollapse' => 1],
    ],
];
