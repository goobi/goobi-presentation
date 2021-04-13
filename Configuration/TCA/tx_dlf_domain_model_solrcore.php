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
        'title'     => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_solrcore',
        'label'     => 'label',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY label',
        'delete' => 'deleted',
        'iconfile' => 'EXT:dlf/Resources/Public/Icons/txdlfsolrcores.png',
        'rootLevel' => -1,
        'dividers2tabs' => 2,
        'searchFields' => 'label,index_name',
    ],
    'feInterface' => [
        'fe_admin_fieldList' => '',
    ],
    'interface' => [
        'showRecordFieldList' => 'label,index_name',
    ],
    'columns' => [
        'label' => [
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_solrcore.label',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,trim',
                'default' => '',
            ],
        ],
        'index_name' => [
            'label' => 'LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_solrcore.index_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'alphanum,nospace,required,unique',
                'default' => '',
                'readOnly' => true,
                'fieldInformation' => [
                    'solrCoreStatus' => [
                        'renderType' => 'solrCoreStatus',
                    ],
                ],
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => '--div--;LLL:EXT:dlf/Resources/Private/Language/Labels.xml:tx_dlf_domain_model_solrcore.tab1,label,index_name'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
];