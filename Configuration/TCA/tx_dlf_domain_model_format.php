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
        'title'     => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_format',
        'label'     => 'type',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY type',
        'delete' => 'deleted',
        'iconfile' => 'EXT:dlf/Resources/Public/Icons/txdlfformats.png',
        'rootLevel' => 1,
        'dividers2tabs' => 2,
        'searchFields' => 'type,class',
    ],
    'feInterface' => [
        'fe_admin_fieldList' => '',
    ],
    'interface' => [
        'showRecordFieldList' => 'type,class',
    ],
    'columns' => [
        'type' => [
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_format.type',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,nospace,alphanum_x,unique',
                'default' => '',
            ],
        ],
        'root' => [
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_format.root',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,nospace,alphanum_x,unique',
                'default' => '',
            ],
        ],
        'namespace' => [
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_format.namespace',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,nospace',
                'default' => '',
            ],
        ],
        'class' => [
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_format.class',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'nospace',
                'default' => '',
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => '--div--;LLL:EXT:dlf/Resources/Private/Language/Labels.xml:_domain_model_format.tab1,type,root,namespace,class'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
];