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
 * This class generates the default file to be processed by Pandoc.  The file is formatted with a title page, and a single page for every 2 images and text.  
 * Requires PHP 5.0 > & Uses the {@link http://simplehtmldom.sourceforge.net/ Simple HTML DOM Parser}
 *
 * @author Johnathan Pulos
 */
class FileGenerator {
	/**
	 * The DOM Element provided by Simple HTML DOM Parser
	 *
	 * @var object
	 */
	public $domElement;
	
	/**
	 * Construct the class
	 *
	 * @access public
	 * @param string htmlFile the web location of the file to parse
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
	 * @var string finalFile the path and name of the final file.
	 * @author Johnathan Pulos
	 */
	public function create($finalFile) {
		$this->switchImages();
		$this->generate($finalFile);
	}
	
	/**
	 * Generates the final file
	 *
	 * @access private
	 * @var string finalFile the path and name of the final file.
	 * @author Johnathan Pulos
	 */
	private function generate($finalFile) {
		$fh = fopen($finalFile, "w") or die("can't open file");
		fwrite($fh, $this->domElement);
		fclose($fh);
	}
	
	/**
	 * Switch the current images with high res prepared images
	 *
	 * @return void
	 * @access private
	 * @author Johnathan Pulos
	 */
	private function switchImages() {
		foreach($this->domElement->find('img') as $element) {
			/**
			 * Grab the image source.  You can use GD library for cropping and resizing images.
			 *
			 * @author Johnathan Pulos
			 */
			$image_src = $element->src;
			/**
			 * Rewrite the image source
			 *
			 * @author Johnathan Pulos
			 */
			$element->src = "mynewimage.jpg";
		}
	}

}
?>