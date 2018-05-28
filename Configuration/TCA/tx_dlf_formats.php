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
        'title'     => 'LLL:EXT:dlf/locallang.xml:tx_dlf_formats',
        'label'     => 'type',
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY type',
        'delete'	=> 'deleted',
        'iconfile'	=> 'EXT:dlf/Resources/Public/Icons/txdlfformats.png',
        'rootLevel'	=> 1,
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
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_formats.type',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,nospace,alphanum_x,unique',
            ],
        ],
        'root' => [
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_formats.root',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'required,nospace,alphanum_x,unique',
            ],
        ],
        'namespace' => [
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_formats.namespace',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 1024,
                'eval' => 'required,nospace,unique',
            ],
        ],
        'class' => [
            'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_formats.class',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 1024,
                'eval' => 'nospace,alphanum_x,unique',
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => '--div--;LLL:EXT:dlf/locallang.xml:tx_dlf_formats.tab1, type;;;;1-1-1, root;;;;2-2-2, namespace, class;;;;3-3-3'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
];
