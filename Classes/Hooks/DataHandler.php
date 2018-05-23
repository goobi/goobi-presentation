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

use Kitodo\Dlf\Common\Document;
use Kitodo\Dlf\Common\Helper;
use Kitodo\Dlf\Common\Solr;

/**
 * Hooks and helper for \TYPO3\CMS\Core\DataHandling\DataHandler
 *
 * @author	Sebastian Meyer <sebastian.meyer@slub-dresden.de>
 * @package	TYPO3
 * @subpackage	tx_dlf
 * @access	public
 */
class DataHandler {

    /**
     * Field post-processing hook for the process_datamap() method.
     *
     * @access	public
     *
     * @param	string		$status: 'new' or 'update'
     * @param	string		$table: The destination table
     * @param	integer		$id: The uid of the record
     * @param	array		&$fieldArray: Array of field values
     * @param	\TYPO3\CMS\Core\DataHandling\DataHandler $pObj: The parent object
     *
     * @return	void
     */
    public function processDatamap_postProcessFieldArray($status, $table, $id, &$fieldArray, $pObj) {

        if ($status == 'new') {

            switch ($table) {

                // Field post-processing for table "tx_dlf_documents".
                case 'tx_dlf_documents':

                    // Set sorting field if empty.
                    if (empty($fieldArray['title_sorting']) && !empty($fieldArray['title'])) {

                        $fieldArray['title_sorting'] = $fieldArray['title'];

                    }

                    break;

                    // Field post-processing for table "tx_dlf_metadata".
                case 'tx_dlf_metadata':

                    // Store field in index if it should appear in lists.
                    if (!empty($fieldArray['is_listed'])) {

                        $fieldArray['index_stored'] = 1;

                    }

                    // Index field in index if it should be used for auto-completion.
                    if (!empty($fieldArray['index_autocomplete'])) {

                        $fieldArray['index_indexed'] = 1;

                    }

                    // Field post-processing for tables "tx_dlf_metadata", "tx_dlf_collections", "tx_dlf_libraries" and "tx_dlf_structures".
                case 'tx_dlf_collections':
                case 'tx_dlf_libraries':
                case 'tx_dlf_structures':

                    // Set label as index name if empty.
                    if (empty($fieldArray['index_name']) && !empty($fieldArray['label'])) {

                        $fieldArray['index_name'] = $fieldArray['label'];

                    }

                    // Set index name as label if empty.
                    if (empty($fieldArray['label']) && !empty($fieldArray['index_name'])) {

                        $fieldArray['label'] = $fieldArray['index_name'];

                    }

                    // Ensure that index names don't get mixed up with sorting values.
                    if (substr($fieldArray['index_name'], -8) == '_sorting') {

                        $fieldArray['index_name'] .= '0';

                    }

                    break;

                    // Field post-processing for table "tx_dlf_solrcores".
                case 'tx_dlf_solrcores':

                    // Get number of existing cores.
                    $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                        '*',
                        'tx_dlf_solrcores',
                        '',
                        '',
                        '',
                        ''
                    );

                    // Get first unused core number.
                    $coreNumber = Solr::solrGetCoreNumber($GLOBALS['TYPO3_DB']->sql_num_rows($result));

                    // Get Solr credentials.
                    $conf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['dlf']);

                    // Prepend username and password to hostname.
                    if ($conf['solrUser'] && $conf['solrPass']) {

                        $host = $conf['solrUser'].':'.$conf['solrPass'].'@'.($conf['solrHost'] ? $conf['solrHost'] : 'localhost');

                    } else {

                        $host = ($conf['solrHost'] ? $conf['solrHost'] : 'localhost');

                    }

                    // Set port if not set.
                    $port = (intval($conf['solrPort']) > 0 ? intval($conf['solrPort']) : 8180);

                    // Trim path and append trailing slash.
                    $path = (trim($conf['solrPath'], '/') ? trim($conf['solrPath'], '/').'/' : '');

                    $context = stream_context_create(array (
                        'http' => array (
                            'method' => 'GET',
                            'user_agent' => ($conf['useragent'] ? $conf['useragent'] : ini_get('user_agent'))
                        )
                    ));

                    // Build request for adding new Solr core.
                    // @see http://wiki.apache.org/solr/CoreAdmin
                    $url = 'http://'.$host.':'.$port.'/'.$path.'admin/cores?wt=xml&action=CREATE&name=dlfCore'.$coreNumber.'&instanceDir=.&dataDir=dlfCore'.$coreNumber;

                    $response = @simplexml_load_string(file_get_contents($url, FALSE, $context));

                    // Process response.
                    if ($response) {

                        $status = $response->xpath('//lst[@name="responseHeader"]/int[@name="status"]');

                        if ($status && $status[0] == 0) {

                            $fieldArray['index_name'] = 'dlfCore'.$coreNumber;

                            return;

                        }

                    }

                    Helper::devLog('[Kitodo\\Dlf\\Hooks\\DataHandler->processDatamap_postProcessFieldArray('.$status.', '.$table.', '.$id.', [data], ['.get_class($pObj).'])] Could not create new Apache Solr core "dlfCore'.$coreNumber.'"', SYSLOG_SEVERITY_ERROR, $fieldArray);

                    // Solr core could not be created, thus unset field array.
                    $fieldArray = array ();

                    break;

            }

        } elseif ($status == 'update') {

            switch ($table) {

                    // Field post-processing for table "tx_dlf_metadata".
                case 'tx_dlf_metadata':

                    // Store field in index if it should appear in lists.
                    if (!empty($fieldArray['is_listed'])) {

                        $fieldArray['index_stored'] = 1;

                    }

                    if (isset($fieldArray['index_stored']) && $fieldArray['index_stored'] == 0 && !isset($fieldArray['is_listed'])) {

                        // Get current configuration.
                        $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                            $table.'.is_listed AS is_listed',
                            $table,
                            $table.'.uid='.intval($id).Helper::whereClause($table),
                            '',
                            '',
                            '1'
                        );

                        if ($GLOBALS['TYPO3_DB']->sql_num_rows($result)) {

                            // Reset storing to current.
                            list ($fieldArray['index_stored']) = $GLOBALS['TYPO3_DB']->sql_fetch_row($result);

                        }

                    }

                    // Index field in index if it should be used for auto-completion.
                    if (!empty($fieldArray['index_autocomplete'])) {

                        $fieldArray['index_indexed'] = 1;

                    }

                    if (isset($fieldArray['index_indexed']) && $fieldArray['index_indexed'] == 0 && !isset($fieldArray['index_autocomplete'])) {

                        // Get current configuration.
                        $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                            $table.'.index_autocomplete AS index_autocomplete',
                            $table,
                            $table.'.uid='.intval($id).Helper::whereClause($table),
                            '',
                            '',
                            '1'
                        );

                        if ($GLOBALS['TYPO3_DB']->sql_num_rows($result)) {

                            // Reset indexing to current.
                            list ($fieldArray['index_indexed']) = $GLOBALS['TYPO3_DB']->sql_fetch_row($result);

                        }

                    }

                    // Field post-processing for tables "tx_dlf_metadata" and "tx_dlf_structures".
                case 'tx_dlf_structures':

                    // The index name should not be changed in production.
                    if (isset($fieldArray['index_name'])) {

                        if (count($fieldArray) < 2) {

                            // Unset the whole field array.
                            $fieldArray = array ();

                        } else {

                            // Get current index name.
                            $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                                $table.'.index_name AS index_name',
                                $table,
                                $table.'.uid='.intval($id).Helper::whereClause($table),
                                '',
                                '',
                                '1'
                            );

                            if ($GLOBALS['TYPO3_DB']->sql_num_rows($result)) {

                                // Reset index name to current.
                                list ($fieldArray['index_name']) = $GLOBALS['TYPO3_DB']->sql_fetch_row($result);

                            }

                        }

                        Helper::devLog('[Kitodo\\Dlf\\Hooks\\DataHandler->processDatamap_postProcessFieldArray('.$status.', '.$table.', '.$id.', [data], ['.get_class($pObj).'])] Prevented change of "index_name" for UID "'.$id.'" in table "'.$table.'"', SYSLOG_SEVERITY_NOTICE, $fieldArray);

                    }

                    break;

            }

        }

    }

    /**
     * After database operations hook for the process_datamap() method.
     *
     * @access	public
     *
     * @param	string		$status: 'new' or 'update'
     * @param	string		$table: The destination table
     * @param	integer		$id: The uid of the record
     * @param	array		&$fieldArray: Array of field values
     * @param	\TYPO3\CMS\Core\DataHandling\DataHandler $pObj: The parent object
     *
     * @return	void
     */
    public function processDatamap_afterDatabaseOperations($status, $table, $id, &$fieldArray, $pObj) {

        if ($status == 'update') {

            switch ($table) {

                // After database operations for table "tx_dlf_documents".
                case 'tx_dlf_documents':

                    // Delete/reindex document in Solr according to "hidden" status in database.
                    if (isset($fieldArray['hidden'])) {

                        // Get Solr core.
                        $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                            'tx_dlf_solrcores.uid',
                            'tx_dlf_solrcores,tx_dlf_documents',
                            'tx_dlf_solrcores.uid=tx_dlf_documents.solrcore AND tx_dlf_documents.uid='.intval($id).Helper::whereClause('tx_dlf_solrcores'),
                            '',
                            '',
                            '1'
                        );

                        if ($GLOBALS['TYPO3_DB']->sql_num_rows($result)) {

                            list ($core) = $GLOBALS['TYPO3_DB']->sql_fetch_row($result);

                            if ($fieldArray['hidden']) {

                                // Establish Solr connection.
                                if ($solr = Solr::getInstance($core)) {

                                    // Delete Solr document.
                                    $solr->service->deleteByQuery('uid:'.$id);

                                    $solr->service->commit();

                                }

                            } else {

                                // Reindex document.
                                $doc = Document::getInstance($id);

                                if ($doc->ready) {

                                    $doc->save($doc->pid, $core);

                                } else {

                                    Helper::devLog('[Kitodo\\Dlf\\Hooks\\DataHandler->processDatamap_afterDatabaseOperations('.$status.', '.$table.', '.$id.', [data], ['.get_class($pObj).'])] Failed to re-index document with UID "'.$id.'"', SYSLOG_SEVERITY_ERROR, $fieldArray);

                                }

                            }

                        }

                    }

                    break;

            }

        }

    }

    /**
     * Post-processing hook for the process_cmdmap() method.
     *
     * @access	public
     *
     * @param	string		$command: 'move', 'copy', 'localize', 'inlineLocalizeSynchronize', 'delete' or 'undelete'
     * @param	string		$table: The destination table
     * @param	integer		$id: The uid of the record
     * @param	mixed		$value: The value for the command
     * @param	\TYPO3\CMS\Core\DataHandling\DataHandler $pObj: The parent object
     *
     * @return	void
     */
    public function processCmdmap_postProcess($command, $table, $id, $value, $pObj) {

        if (in_array($command, array ('move', 'delete', 'undelete')) && $table == 'tx_dlf_documents') {

            // Get Solr core.
            $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                'tx_dlf_solrcores.uid',
                'tx_dlf_solrcores,tx_dlf_documents',
                'tx_dlf_solrcores.uid=tx_dlf_documents.solrcore AND tx_dlf_documents.uid='.intval($id).Helper::whereClause('tx_dlf_solrcores'),
                '',
                '',
                '1'
            );

            if ($GLOBALS['TYPO3_DB']->sql_num_rows($result)) {

                list ($core) = $GLOBALS['TYPO3_DB']->sql_fetch_row($result);

                switch ($command) {

                    case 'move':
                    case 'delete':

                        // Establish Solr connection.
                        if ($solr = Solr::getInstance($core)) {

                            // Delete Solr document.
                            $solr->service->deleteByQuery('uid:'.$id);

                            $solr->service->commit();

                            if ($command == 'delete') {

                                break;

                            }

                        }

                    case 'undelete':

                        // Reindex document.
                        $doc = Document::getInstance($id);

                        if ($doc->ready) {

                            $doc->save($doc->pid, $core);

                        } else {

                            Helper::devLog('[Kitodo\\Dlf\\Hooks\\DataHandler->processCmdmap_postProcess('.$command.', '.$table.', '.$id.', '.$value.', ['.get_class($pObj).'])] Failed to re-index document with UID "'.$id.'"', SYSLOG_SEVERITY_ERROR);

                        }

                        break;

                }

            }

        }

    }

}
