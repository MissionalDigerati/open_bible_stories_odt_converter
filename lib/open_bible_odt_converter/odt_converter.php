<?php
/**
 * This file is part of Open Bible ODT Converter.
 * 
 * Open Bible ODT Converter is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Open Bible ODT Converter is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see 
 * <http://www.gnu.org/licenses/>.
 *
 * @author Johnathan Pulos <johnathan@missionaldigerati.org>
 * @copyright Copyright 2012 Missional Digerati
 * 
 */
/**
 * Converts the file into a ODT file using pandoc library.
 * Requires PHP > 5 & {@link http://johnmacfarlane.net/pandoc Pandoc Library}
 *
 * @package default
 * @author Johnathan Pulos
 */
class ODTConverter {
	
	/**
	 * Construct the class
	 *
	 * @access public
	 * @return void
	 * @author Johnathan Pulos
	 */
	public function __construct() {
	}
	
	/**
	 * Executes the command to convert the supplied doc to ODT
	 *
	 * @param string $sourceFile the file path to convert
	 * @param string $destinationFile the destination odt file
	 * @param string $templateFile the template file to base the styling on
	 * @return void
	 * @access public
	 * @author Johnathan Pulos
	 */
	public function convert($sourceFile, $destinationFile, $templateFile = null) {
		$command = "pandoc -S -o " . $destinationFile;
		if ($templateFile != null) {
			$command .= " --reference-odt=" . $templateFile;
		}
		$command .= " " . $sourceFile;
		echo "Executing Command: " . $command . "\n";
		@shell_exec($command);
	}
}
?>