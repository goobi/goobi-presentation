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

if (!defined('TYPO3_cliMode')) {

	die('You cannot run this script directly!');

}

/**
 * CLI script for the 'dlf' extension.
 *
 * @author	Sebastian Meyer <sebastian.meyer@slub-dresden.de>
 * @package	TYPO3
 * @subpackage	tx_dlf
 * @access	public
 */
class tx_dlf_cli extends t3lib_cli {

	/**
	 * Main function of the script.
	 *
	 * @access	public
	 *
	 * @return	void
	 */
	public function main() {

		switch ((string) $this->cli_args['_DEFAULT'][1]) {

			case 'index':

				// Add command line arguments.
				$this->cli_options[] = array ('-doc UID/URL', 'UID or URL of the document.');

				$this->cli_options[] = array ('-pid UID', 'UID of the page the document should be added to.');

				$this->cli_options[] = array ('-core UID', 'UID of the Solr core the document should be added to.');

				// Check the command line arguments.
				$this->cli_validateArgs();

				// Get the document...
				$doc =& tx_dlf_document::getInstance($this->cli_args['-doc'][0], $this->cli_args['-pid'][0], TRUE);

				if ($doc->ready) {

					// ...and save it to the database...
					if (!$doc->save(intval($this->cli_args['-pid'][0]), intval($this->cli_args['-core'][0]))) {

						$this->cli_echo('ERROR: Document '.$this->cli_args['-doc'][0].' not saved and indexed.'.LF, TRUE);

						exit (1);

					}

				} else {

					$this->cli_echo('ERROR: Document '.$this->cli_args['-doc'][0].' could not be loaded.'.LF, TRUE);

					exit (1);

				}

				break;

			default:

				$this->cli_help();

				break;

		}

		exit (0);

	}

	public function __construct() {

		// Set basic information about the script.
		$this->cli_help = array (
			'name' => 'Command Line Interface for Goobi.Presentation',
			'synopsis' => '###OPTIONS###',
			'description' => 'Currently the only task available is "index".'.LF.'Try "/PATH/TO/TYPO3/cli_dispatch.phpsh dlf index" to view more options.',
			'examples' => '/PATH/TO/TYPO3/cli_dispatch.phpsh dlf TASK -ARG1=VALUE1 -ARG2=VALUE2',
			'options' => '',
			'license' => 'GNU GPL - free software!',
			'author' => 'Goobi. Digitalisieren im Verein e.V. <contact@goobi.org>',
		);

		// Run parent constructor.
		parent::t3lib_cli();

	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dlf/cli/class.tx_dlf_cli.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dlf/cli/class.tx_dlf_cli.php']);
}

$SOBE = t3lib_div::makeInstance('tx_dlf_cli');

$SOBE->main();

?>