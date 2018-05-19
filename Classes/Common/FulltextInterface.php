<?php
namespace Kitodo\Dlf\Common;

/**
 * (c) Kitodo. Key to digital objects e.V. <contact@kitodo.org>
 *
 * This file is part of the Kitodo and TYPO3 projects.
 *
 * @license GNU General Public License version 3 or later.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Interface 'Fulltext' for the 'dlf' extension.
 *
 * @author	Sebastian Meyer <sebastian.meyer@slub-dresden.de>
 * @package	TYPO3
 * @subpackage	dlf
 * @access	public
 * @abstract
 */
interface FulltextInterface {

    /**
     * This extracts raw fulltext data from XML
     *
     * @access	public
     *
     * @param	\SimpleXMLElement		$xml: The XML to extract the metadata from
     *
     * @return	string			The raw unformatted fulltext
     */
    public static function getRawText(\SimpleXMLElement $xml);

}
