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
 * This class generates a {@link http://daringfireball.net/projects/markdown/ Markdown} file from the given HTML Open Door file.  The markdown layout was defined
 * by the Open Door Project.  
 * Requires PHP 5.0 > & Uses the {@link http://simplehtmldom.sourceforge.net/ Simple HTML DOM Parser}
 *
 * @author Johnathan Pulos
 */
class OpenDoorMarkdownGenerator {
	/**
	 * The DOM Element provided by Simple HTML DOM Parser
	 *
	 * @var object
	 * @access public
	 */
	public $domElement;
	
	/**
	 * The contents for the final file in AsciiDoc
	 *
	 * @var string
	 * @access public
	 */
	public $finalFileContents = '';
	
	/**
	 * The location of the high res prepared images.  This must be an absolute path
	 *
	 * @var string
	 * @access public
	 */
	public $imageDir = 'images/';
	
	/**
	 * Construct the class
	 *
	 * @access public
	 * @param string $htmlFile the web location of the file to parse
	 * @return void
	 * @author Johnathan Pulos
	 */
	public function __construct($htmlFile) {
		$this->domElement = file_get_html($htmlFile);
	}
	
	/**
	 * Create the new file according to the specs of Open Bible Stories
	 *
	 * @access public
	 * @var string $title the title for this book
	 * @var string $finalFile the path and name of the final file.
	 * @author Johnathan Pulos
	 */
	public function create($title, $finalFile) {
		$this->addTitle($title);
		$this->addContent();
		$this->generate($finalFile);
	}
	
	/**
	 * Adds the title to the finalFileContents
	 *
	 * @param string $title the title of the book
	 * @return void
	 * @access private
	 * @author Johnathan Pulos
	 */
	private function addTitle($title) {
		$titleLength = strlen($title);
		$this->finalFileContents .= $title . "\n";
		for ($i=0; $i < $titleLength; $i++) { 
			$this->finalFileContents .= "=";
		}
		$this->finalFileContents .= "\n";
	}
	
	/**
	 * grab all the content, switch images to the hi def provided images, and add to the finalFileContents
	 *
	 * @return void
	 * @access public
	 * @author Johnathan Pulos
	 */
	private function addContent() {
		$imgCount = 0;
		foreach($this->domElement->find('div[class=storytext] > p') as $element) {
			if (count($element->find('img')) == 0) {
				/**
				 * Dealing with text
				 *
				 * @author Johnathan Pulos
				 */
				$this->finalFileContents .= $element->plaintext . "\n";
			}else {
				/**
				 * Dealing with an image
				 *
				 * @author Johnathan Pulos
				 */
				foreach ($element->find('img') as $image) {
					$imgCount = $imgCount+1;
					$this->finalFileContents .= "![" . $image->alt . "](" . $this->imageDir . "OBS-23-" . sprintf("%02d",$imgCount) . ".jpg '" . $image->alt . "')\n";
				}
			}
		}
	}
	
	/**
	 * Generates the final file
	 *
	 * @access private
	 * @var string $finalFile the path and name of the final file.
	 * @author Johnathan Pulos
	 */
	private function generate($finalFile) {
		$fh = fopen($finalFile, "w") or die("can't open file");
		fwrite($fh, $this->finalFileContents);
		fclose($fh);
	}

}
?>