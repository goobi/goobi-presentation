<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Goobi. Digitalisieren im Verein e.V. <contact@goobi.org>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 */

/**
 * Plugin 'DLF: Page Preview' for the 'dlf' extension.
 *
 * @author	Henrik Lochmann <dev@mentalmotive.com>
 * @author	Sebastian Meyer <sebastian.meyer@slub-dresden.de>
 * @package	TYPO3
 * @subpackage	tx_dlf
 * @access	public
 */
class tx_dlf_pagegrid extends tx_dlf_plugin {

	public $scriptRelPath = 'plugins/pagegrid/class.tx_dlf_pagegrid.php';

	/**
	 * Renders entry for one page of the current document.
	 *
	 * @access	protected
	 *
	 * @param	integer		$number: The page to render
	 * @param	string		$template: Parsed template subpart
	 *
	 * @return	string		The rendered entry ready for output
	 */
	protected function getEntry($number, $template) {

		// Set current page if applicable.
		if (!empty($this->piVars['page']) && $this->piVars['page'] == $number) {

			$markerArray['###STATE###'] = 'cur';

		} else {

			$markerArray['###STATE###'] = 'no';

		}

		// Set page number.
		$markerArray['###NUMBER###'] = $number;

		// Set pagination.
		$markerArray['###PAGINATION###'] = $this->doc->physicalPagesInfo[$this->doc->physicalPages[$number]]['label'];

		// Get thumbnail or placeholder.
		if (!empty($this->doc->physicalPagesInfo[$this->doc->physicalPages[$number]]['files'][$this->conf['fileGrpThumbs']])) {

			$thumbnailFile = $this->doc->getFileLocation($this->doc->physicalPagesInfo[$this->doc->physicalPages[$number]]['files'][$this->conf['fileGrpThumbs']]);

		} elseif (!empty($this->conf['placeholder'])) {

			$thumbnailFile = $GLOBALS['TSFE']->tmpl->getFileName($this->conf['placeholder']);

		} else {

			$thumbnailFile = t3lib_extMgm::siteRelPath($this->extKey).'plugins/pagegrid/placeholder.jpg';

		}

		$thumbnail = '<img alt="'.$markerArray['###PAGINATION###'].'" src="'.$thumbnailFile.'" />';

		// Get new plugin variables for typolink.
		$piVars = $this->piVars;

		// Unset no longer needed plugin variables.
		// unset($piVars['pagegrid']) is for DFG Viewer compatibility!
		unset($piVars['pointer'], $piVars['DATA'], $piVars['pagegrid']);

		$piVars['page'] = $number;

		$linkConf = array (
			'useCacheHash' => 1,
			'parameter' => $this->conf['targetPid'],
			'additionalParams' => t3lib_div::implodeArrayForUrl($this->prefixId, $piVars, '', TRUE, FALSE),
			'title' => $markerArray['###PAGINATION###']
		);

		$markerArray['###THUMBNAIL###'] = $this->cObj->typoLink($thumbnail, $linkConf);

		return $this->cObj->substituteMarkerArray($template, $markerArray);

	}

	/**
	 * Renders the page browser
	 *
	 * @access	protected
	 *
	 * @return	string		The rendered page browser ready for output
	 */
	protected function getPagebrowser() {

		// Get overall number of pages.
		$maxPages = intval(ceil($this->doc->numPages / $this->conf['limit']));

		// Return empty pagebrowser if there is just one page.
		if ($maxPages < 2) {

			return '';

		}

		// Get separator.
		$separator = $this->pi_getLL('separator', ' - ');

		// Add link to previous page.
		if ($this->piVars['pointer'] > 0) {

			$output = $this->pi_linkTP_keepPIvars($this->pi_getLL('prevPage', '&lt;'), array ('pointer' => $this->piVars['pointer'] - 1, 'page' => NULL), TRUE).$separator;

		} else {

			$output = $this->pi_getLL('prevPage', '&lt;').$separator;

		}

		$i = 0;

		// Add links to pages.
		while ($i < $maxPages) {

			if ($i < 3 || ($i > $this->piVars['pointer'] - 3 && $i < $this->piVars['pointer'] + 3) || $i > $maxPages - 4) {

				if ($this->piVars['pointer'] != $i) {

					$output .= $this->pi_linkTP_keepPIvars(sprintf($this->pi_getLL('page', '%d'), $i + 1), array ('pointer' => $i, 'page' => NULL), TRUE).$separator;

				} else {

					$output .= sprintf($this->pi_getLL('page', '%d'), $i + 1).$separator;

				}

				$skip = TRUE;

			} elseif ($skip == TRUE) {

				$output .= $this->pi_getLL('skip', '...').$separator;

				$skip = FALSE;

			}

			$i++;

		}

		// Add link to next page.
		if ($this->piVars['pointer'] < $maxPages - 1) {

			$output .= $this->pi_linkTP_keepPIvars($this->pi_getLL('nextPage', '&gt;'), array ('pointer' => $this->piVars['pointer'] + 1, 'page' => NULL), TRUE);

		} else {

			$output .= $this->pi_getLL('nextPage', '&gt;');

		}

		return $output;

	}

	/**
	 * The main method of the PlugIn
	 *
	 * @access	public
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 *
	 * @return	string		The content that is displayed on the website
	 */
	public function main($content, $conf) {

		$this->init($conf);

		// Don't cache the output.
		$this->setCache(FALSE);

		$this->loadDocument();

		if ($this->doc === NULL || $this->doc->numPages < 1 || empty($this->conf['fileGrpThumbs'])) {

			// Quit without doing anything if required variables are not set.
			return $content;

		} else {

			// Set default values for page if not set.
			$this->piVars['pointer'] = tx_dlf_helper::intInRange($this->piVars['pointer'], 0, $this->doc->numPages, 0);

		}

		// Load template file.
		if (!empty($this->conf['templateFile'])) {

			$this->template = $this->cObj->getSubpart($this->cObj->fileResource($this->conf['templateFile']), '###TEMPLATE###');

		} else {

			$this->template = $this->cObj->getSubpart($this->cObj->fileResource('EXT:dlf/plugins/pagegrid/template.tmpl'), '###TEMPLATE###');

		}

		$entryTemplate = $this->cObj->getSubpart($this->template, '###ENTRY###');

		if (empty($entryTemplate)) {

			if (TYPO3_DLOG) {

				t3lib_div::devLog('[tx_dlf_pagegrid->main('.$content.', [data])] No template subpart for list entry found', $this->extKey, SYSLOG_SEVERITY_WARNING, $conf);

			}

			// Quit without doing anything if required variables are not set.
			return $content;

		}

		// Set some variable defaults.
		if (!empty($this->piVars['page'])) {

			$this->piVars['page'] = tx_dlf_helper::intInRange($this->piVars['page'], 1, $this->doc->numPages, 1);

			$this->piVars['pointer'] = intval(floor($this->piVars['page'] / $this->conf['limit']));

		}

		if (!empty($this->piVars['pointer']) && (($this->piVars['pointer'] * $this->conf['limit']) + 1) <= $this->doc->numPages) {

			$this->piVars['pointer'] = max(intval($this->piVars['pointer']), 0);

		} else {

			$this->piVars['pointer'] = 0;

		}

		// Iterate through visible page set and display thumbnails.
		for ($i = $this->piVars['pointer'] * $this->conf['limit'], $j = ($this->piVars['pointer'] + 1) * $this->conf['limit']; $i < $j; $i++) {

			// +1 because page counting starts at 1.
			$number = $i + 1;

			if ($number > $this->doc->numPages) {

				break;

			} else {

				$content .= $this->getEntry($number, $entryTemplate);

			}

		}

		// Render page browser.
		$markerArray['###PAGEBROWSER###'] = $this->getPageBrowser();

		// Merge everything with template.
		$content = $this->cObj->substituteMarkerArray($this->cObj->substituteSubpart($this->template, '###ENTRY###', $content, TRUE), $markerArray);

		return $this->pi_wrapInBaseClass($content);

	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dlf/plugins/pagegrid/class.tx_dlf_pagegrid.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dlf/plugins/pagegrid/class.tx_dlf_pagegrid.php']);
}

?>
