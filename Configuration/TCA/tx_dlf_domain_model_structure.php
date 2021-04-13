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
        'title'     => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_structure',
        'label'     => 'label',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'default_sortby' => 'ORDER BY label',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'iconfile' => 'EXT:dlf/Resources/Public/Icons/txdlfstructures.png',
        'rootLevel' => 0,
        'dividers2tabs' => 2,
        'searchFields' => 'label,index_name,oai_name',
    ],
    'feInterface' => [
        'fe_admin_fieldList' => '',
    ],
    'interface' => [
        'showRecordFieldList' => 'label,index_name,oai_name,toplevel',
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0],
                ],
                'default' => 0
            ],
        ],
        'l18n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_dlf_domain_model_structure',
                'foreign_table_where' => 'AND tx_dlf_domain_model_structure.pid=###CURRENT_PID### AND tx_dlf_domain_model_structure.sys_language_uid IN (-1,0) ORDER BY label ASC',
                'items' => [
                    ['', 0],
                ],
                'default' => 0,
            ],
        ],
        'l18n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'toplevel' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_structure.toplevel',
            'config' => [
                'type' => 'check',
                'default' => 0,
                'onchange' => 'reload',
            ],
        ],
        'label' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_structure.label',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,trim',
                'default' => '',
            ],
        ],
        'index_name' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_structure.index_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,nospace,alphanum_x,uniqueInPid',
                'default' => '',
                'fieldInformation' => [
                    'editInProductionWarning' => [
                        'renderType' => 'editInProductionWarning',
                    ],
                ],
            ],
        ],
        'oai_name' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_structure.oai_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'thumbnail' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'displayCond' => 'FIELD:toplevel:REQ:true',
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:_domain_model_structure.thumbnail',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_structure.thumbnail.self', 0],
                ],
                'foreign_table' => 'tx_dlf_domain_model_structure',
                'foreign_table_where' => 'AND tx_dlf_domain_model_structure.pid=###CURRENT_PID### AND tx_dlf_domain_model_structure.toplevel=0 AND tx_dlf_domain_model_structure.sys_language_uid IN (-1,0) ORDER BY tx_dlf_domain_model_structure.label',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
                'default' => 0,
            ],
        ],
        'status' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_structure.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_structure.status.default', 0],
                ],
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
                'default' => 0,
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => '--div--;LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_structure.tab1,toplevel,label,--palette--;;1,thumbnail,--div--;LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_structure.tab2,sys_language_uid,l18n_parent,l18n_diffsource,--div--;LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_structure.tab3,hidden,status'],
    ],
    'palettes' => [
        '1' => ['showitem' => 'index_name, --linebreak--, oai_name', 'canNotCollapse' => 1],
    ],
];