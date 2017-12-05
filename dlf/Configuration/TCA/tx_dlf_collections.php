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

return array (
	'ctrl' => array (
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
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'fe_group' => 'fe_group',
		),
		'iconfile'	=> \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('dlf').'res/icons/txdlfcollections.png',
		'rootLevel'	=> 0,
		'dividers2tabs' => 2,
		'searchFields' => 'label,index_name,oai_name,fe_cruser_id',
		'requestUpdate' => 'sys_language_uid, index_search',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'label,description,thumbnail,documents',
	),
  'interface' => array (
		'showRecordFieldList' => 'label,index_name,oai_name,fe_cruser_id',
	),
	'columns' => array (
		'sys_language_uid' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array (
					array ('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array ('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
				),
				'default' => 0,
			),
		),
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array (
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array (
					array ('', 0),
				),
				'foreign_table' => 'tx_dlf_collections',
				'foreign_table_where' => 'AND tx_dlf_collections.pid=###CURRENT_PID### AND tx_dlf_collections.sys_language_uid IN (-1,0)',
			),
		),
		'l18n_diffsource' => array (
			'config' => array (
				'type' => 'passthrough'
			),
		),
		'hidden' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array (
				'type' => 'check',
				'default' => 0,
			),
		),
		'fe_group' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config' => array (
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'items' => array (
					array ('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array ('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array ('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--'),
				),
				'foreign_table' => 'fe_groups',
				'size' => 5,
				'autoSizeMax' => 15,
				'minitems' => 0,
				'maxitems' => 20,
				'exclusiveKeys' => '-1,-2',
			),
		),
		'label' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.label',
			'config' => array (
				'type' => 'input',
				'size' => 30,
				'max' => 255,
				'eval' => 'required,trim',
			),
		),
		'index_name' => array (
			'displayCond' => 'FIELD:index_search:REQ:FALSE',
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.index_name',
			'config' => array (
				'type' => 'none',
				'size' => 30,
				'max' => 255,
				'eval' => 'required,uniqueInPid',
			),
		),
		'index_search' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.index_search',
			'config' => array (
			'type' => 'text',
				'cols' => 30,
				'rows' => 5,
				'eval' => '',
			),
		),
		'oai_name' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.oai_name',
			'config' => array (
				'type' => 'input',
				'size' => 30,
				'max' => 255,
				'eval' => 'nospace,alphanum_x,uniqueInPid',
			),
		),
		'description' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.description',
			'config' => array (
				'type' => 'text',
				'cols' => 30,
				'rows' => 10,
				'wrap' => 'virtual',
			),
			'defaultExtras' => 'richtext[undo,redo,cut,copy,paste,link,image,line,acronym,chMode,blockstylelabel,formatblock,blockstyle,textstylelabel,textstyle,bold,italic,unorderedlist,orderedlist]:rte_transform[mode=ts_css]',
		),
		'thumbnail' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.thumbnail',
			'config' => array (
				'type' => 'group',
				'internal_type' => 'file_reference',
				'allowed' => 'gif,jpg,png',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'priority' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.priority',
			'config' => array (
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array (
					array ('1', 1),
					array ('2', 2),
					array ('3', 3),
					array ('4', 4),
					array ('5', 5),
				),
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
				'default' => 3,
			),
		),
		'documents' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.documents',
			'config' => array (
				'type' => 'select',
				'renderType' => 'selectSingleBox',
				'foreign_table' => 'tx_dlf_documents',
				'foreign_table_where' => 'AND tx_dlf_documents.pid=###CURRENT_PID### ORDER BY tx_dlf_documents.title_sorting',
				'size' => 5,
				'autoSizeMax' => 15,
				'minitems' => 0,
				'maxitems' => 1048576,
				'MM' => 'tx_dlf_relations',
				'MM_match_fields' => array (
					'ident' => 'docs_colls',
				),
				'MM_opposite_field' => 'collections',
			),
		),
		'owner' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.owner',
			'config' => array (
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array (
					array ('LLL:EXT:dlf/locallang.xml:tx_dlf_collections.owner.none', 0),
				),
				'foreign_table' => 'tx_dlf_libraries',
				'foreign_table_where' => 'AND tx_dlf_libraries.sys_language_uid IN (-1,0) ORDER BY tx_dlf_libraries.label',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'fe_cruser_id' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.fe_cruser_id',
			'config' => array (
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array (
					array ('LLL:EXT:dlf/locallang.xml:tx_dlf_collections.fe_cruser_id.none', 0),
				),
				'foreign_table' => 'fe_users',
				'foreign_table_where' => 'ORDER BY fe_users.username',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'fe_admin_lock' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.fe_admin_lock',
			'config' => array (
				'type' => 'check',
				'default' => 0,
			),
		),
		'status' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:dlf/locallang.xml:tx_dlf_collections.status',
			'config' => array (
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array (
					array ('LLL:EXT:dlf/locallang.xml:tx_dlf_collections.status.default', 0),
				),
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
				'default' => 0,
			),
		),
	),
	'types' => array (
		'0' => array ('showitem' => '--div--;LLL:EXT:dlf/locallang.xml:tx_dlf_collections.tab1, label,--palette--;;1;;1-1-1, description,--palette--;;2;;2-2-2, --div--;LLL:EXT:dlf/locallang.xml:tx_dlf_collections.tab2, sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource, --div--;LLL:EXT:dlf/locallang.xml:tx_dlf_collections.tab3, hidden;;;;1-1-1, fe_group;;;;2-2-2, status;;;;3-3-3, owner;;;;4-4-4, fe_cruser_id,--palette--;;3'),
	),
	'palettes' => array (
		'1' => array ('showitem' => 'index_name, index_search, --linebreak--, oai_name', 'canNotCollapse' => 1),
		'2' => array ('showitem' => 'thumbnail, priority', 'canNotCollapse' => 1),
		'3' => array ('showitem' => 'fe_admin_lock', 'canNotCollapse' => 1),
	),
);
