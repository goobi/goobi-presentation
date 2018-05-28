<?php
namespace Kitodo\Dlf\Hooks;

/**
 * (c) Kitodo. Key to digital objects e.V. <contact@kitodo.org>
 *
 * This file is part of the Kitodo and TYPO3 projects.
 *
 * @license GNU General Public License version 3 or later.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use Kitodo\Dlf\Common\Helper;

/**
 * Hooks and helper for \TYPO3\CMS\Backend\Form\FormEngine
 *
 * @author	Sebastian Meyer <sebastian.meyer@slub-dresden.de>
 * @package	TYPO3
 * @subpackage	dlf
 * @access	public
 */
class FormEngine {

    /**
     * Helper to display document's thumbnail for table "tx_dlf_documents"
     *
     * @access	public
     *
     * @param	array		&$params: An array with parameters
     * @param	\TYPO3\CMS\Backend\Form\FormEngine &$pObj: The parent object
     *
     * @return	string		HTML <img> tag for thumbnail
     */
    public function displayThumbnail(&$params, &$pObj) {

        $output = '<div style="padding:5px; background-color:#000000;">';

        // Simulate TCA field type "passthrough".
        $output .= '<input type="hidden" name="'.$params['itemFormElName'].'" value="'.$params['itemFormElValue'].'" />';

        if (!empty($params['itemFormElValue'])) {

            $output .= '<img alt="" src="'.$params['itemFormElValue'].'" />';

        }

        $output .= '</div>';

        return $output;

    }

    /**
     * Helper to get flexform's items array for plugin "Collection"
     *
     * @access	public
     *
     * @param	array		&$params: An array with parameters
     * @param	\TYPO3\CMS\Backend\Form\FormEngine &$pObj: The parent object
     *
     * @return	void
     */
    public function itemsProcFunc_collectionList(&$params, &$pObj) {

        // the access to pi_flexform data has changed in TYPO3 7.6
        if (version_compare(TYPO3_version, '7.6', '<')) {

            if ($params['row']['pi_flexform']) {

                $pi_flexform = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($params['row']['pi_flexform']);

                $pages = $pi_flexform['data']['sDEF']['lDEF']['pages']['vDEF'];

            }

        } else {

            $pages = $params['row']['pages'];

        }

        if (!empty($pages)) {

            // There is a strange behavior where the uid from the flexform is prepended by the table's name and appended by its title.
            // i.e. instead of "18" it reads "pages_18|Title"
            if (!\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($pages)) {

                $parts = explode('|', $pages);

                $pages = array_pop(explode('_', $parts[0]));

            }

            if ($pages > 0) {

                $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    'label,uid',
                    'tx_dlf_collections',
                    'pid='.intval($pages).' AND (sys_language_uid IN (-1,0) OR l18n_parent=0)'.Helper::whereClause('tx_dlf_collections'),
                    '',
                    'label',
                    ''
                );

                if ($GLOBALS['TYPO3_DB']->sql_num_rows($result) > 0) {

                    while ($resArray = $GLOBALS['TYPO3_DB']->sql_fetch_row($result)) {

                        $params['items'][] = $resArray;

                    }

                }

            }

        }

    }

    /**
     * Helper to get flexform's items array for plugin "Search"
     *
     * @access	public
     *
     * @param	array		&$params: An array with parameters
     * @param	\TYPO3\CMS\Backend\Form\FormEngine &$pObj: The parent object
     *
     * @return	void
     */
    public function itemsProcFunc_extendedSearchList(&$params, &$pObj) {

        // the access to pi_flexform data has changed in TYPO3 7.6
        if (version_compare(TYPO3_version, '7.6', '<')) {

            if ($params['row']['pi_flexform']) {

                $pi_flexform = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($params['row']['pi_flexform']);

                $pages = $pi_flexform['data']['sDEF']['lDEF']['pages']['vDEF'];

            }

        } else {

            $pages = $params['row']['pages'];

        }

        if (!empty($pages)) {

            // There is a strange behavior where the uid from the flexform is prepended by the table's name and appended by its title.
            // i.e. instead of "18" it reads "pages_18|Title"
            if (!\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($pages)) {

                $_parts = explode('|', $pages);

                $pages = array_pop(explode('_', $_parts[0]));

            }

            if ($pages > 0) {

                $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    'label,index_name',
                    'tx_dlf_metadata',
                    'index_indexed=1 AND pid='.intval($pages).' AND (sys_language_uid IN (-1,0) OR l18n_parent=0)'.Helper::whereClause('tx_dlf_metadata'),
                    '',
                    'sorting',
                    ''
                );

                if ($GLOBALS['TYPO3_DB']->sql_num_rows($result) > 0) {

                    while ($resArray = $GLOBALS['TYPO3_DB']->sql_fetch_row($result)) {

                        $params['items'][] = $resArray;

                    }

                }

            }

        }

    }

    /**
     * Helper to get flexform's items array for plugin "Search"
     *
     * @access	public
     *
     * @param	array		&$params: An array with parameters
     * @param	\TYPO3\CMS\Backend\Form\FormEngine &$pObj: The parent object
     *
     * @return	void
     */
    public function itemsProcFunc_facetsList(&$params, &$pObj) {

        // the access to pi_flexform data has changed in TYPO3 7.6
        if (version_compare(TYPO3_version, '7.6', '<')) {

            if ($params['row']['pi_flexform']) {

                $pi_flexform = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($params['row']['pi_flexform']);

                $pages = $pi_flexform['data']['sDEF']['lDEF']['pages']['vDEF'];

            }

        } else {

            $pages = $params['row']['pages'];

        }

        if (!empty($pages)) {

            // There is a strange behavior where the uid from the flexform is prepended by the table's name and appended by its title.
            // i.e. instead of "18" it reads "pages_18|Title"
            if (!\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($pages)) {

                $_parts = explode('|', $pages);

                $pages = array_pop(explode('_', $_parts[0]));

            }

            if ($pages > 0) {

                $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    'label,index_name',
                    'tx_dlf_metadata',
                    'is_facet=1 AND pid='.intval($pages).' AND (sys_language_uid IN (-1,0) OR l18n_parent=0)'.Helper::whereClause('tx_dlf_metadata'),
                    '',
                    'sorting',
                    ''
                );

                if ($GLOBALS['TYPO3_DB']->sql_num_rows($result) > 0) {

                    while ($resArray = $GLOBALS['TYPO3_DB']->sql_fetch_row($result)) {

                        $params['items'][] = $resArray;

                    }

                }

            }

        }

    }

    /**
     * Helper to get flexform's items array for plugin "Oai"
     *
     * @access	public
     *
     * @param	array		&$params: An array with parameters
     * @param	\TYPO3\CMS\Backend\Form\FormEngine &$pObj: The parent object
     *
     * @return	void
     */
    public function itemsProcFunc_libraryList(&$params, &$pObj) {

        // the access to pi_flexform data has changed in TYPO3 7.6
        if (version_compare(TYPO3_version, '7.6', '<')) {

            if ($params['row']['pi_flexform']) {

                $pi_flexform = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($params['row']['pi_flexform']);

                $pages = $pi_flexform['data']['sDEF']['lDEF']['pages']['vDEF'];

            }

        } else {

            $pages = $params['row']['pages'];

        }

        if (!empty($pages)) {

            // There is a strange behavior where the uid from the flexform is prepended by the table's name and appended by its title.
            // i.e. instead of "18" it reads "pages_18|Title"
            if (!\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($pages)) {

                $parts = explode('|', $pages);

                $pages = array_pop(explode('_', $parts[0]));

            }

            if ($pages > 0) {

                $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    'label,uid',
                    'tx_dlf_libraries',
                    'pid='.intval($pages).' AND (sys_language_uid IN (-1,0) OR l18n_parent=0)'.Helper::whereClause('tx_dlf_libraries'),
                    '',
                    'label',
                    ''
                );

                if ($GLOBALS['TYPO3_DB']->sql_num_rows($result) > 0) {

                    while ($resArray = $GLOBALS['TYPO3_DB']->sql_fetch_row($result)) {

                        $params['items'][] = $resArray;

                    }

                }

            }

        }

    }

    /**
     * Helper to get flexform's items array for plugin "Search"
     *
     * @access	public
     *
     * @param	array		&$params: An array with parameters
     * @param	\TYPO3\CMS\Backend\Form\FormEngine &$pObj: The parent object
     *
     * @return	void
     */
    public function itemsProcFunc_solrList(&$params, &$pObj) {

        // the access to pi_flexform data has changed in TYPO3 7.6
        if (version_compare(TYPO3_version, '7.6', '<')) {

            if ($params['row']['pi_flexform']) {

                $pi_flexform = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($params['row']['pi_flexform']);

                $pages = $pi_flexform['data']['sDEF']['lDEF']['pages']['vDEF'];

            }

        } else {

            $pages = $params['row']['pages'];

        }

        if (!empty($pages)) {

            // There is a strange behavior where the uid from the flexform is prepended by the table's name and appended by its title.
            // i.e. instead of "18" it reads "pages_18|Title"
            if (!\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($pages)) {

                $parts = explode('|', $pages);

                $pages = array_pop(explode('_', $parts[0]));

            }

            if ($pages > 0) {

                $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    'label,uid',
                    'tx_dlf_solrcores',
                    'pid IN ('.intval($pages).',0)'.Helper::whereClause('tx_dlf_solrcores'),
                    '',
                    'label',
                    ''
                );

                if ($GLOBALS['TYPO3_DB']->sql_num_rows($result) > 0) {

                    while ($resArray = $GLOBALS['TYPO3_DB']->sql_fetch_row($result)) {

                        $params['items'][] = $resArray;

                    }

                }

            }

        }

    }

    /**
     * Helper to get flexform's items array for plugin "Toolbox"
     *
     * @access	public
     *
     * @param	array		&$params: An array with parameters
     * @param	\TYPO3\CMS\Backend\Form\FormEngine &$pObj: The parent object
     *
     * @return	void
     */
    public function itemsProcFunc_toolList(&$params, &$pObj) {

        foreach ($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['dlf/plugins/toolbox/tools'] as $plugin => $label) {

            $params['items'][] = array ($GLOBALS['LANG']->sL($label), $plugin);

        }

    }

}
