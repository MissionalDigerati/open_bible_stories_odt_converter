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
 * To run an example,  just type the following command in the commandline
 * php example.php http://pt.door43.org/w/index.php?title=Hist%C3%B3rias:O_Pai_Compassivo 23 "The Compassionate Father"
 * If your title has spaces, then make sure to wrap in quotes
 *
 * @author Johnathan Pulos
 */
require 'lib/open_bible_odt_converter.php';
/**
 * Catch the arguments sent through command line, and setup the variables
 *
 * @author Johnathan Pulos
 */
if($argc < 3) {
	echo "usage: php example.php {url:required} {open_bible_id:required} {title:optional}\r\n";
	echo "title - defaults to Open Bible Stories\r\n";
	exit;
}
$url = $argv[1];
$openId = $argv[2];
$title = (isset($argv[3])) ? $argv[3]: "Open Bible Stories";
$fileTitle = str_replace(" ", "_", strtolower(ereg_replace("[^A-Za-z0-9 ]", "", $title)));
/**
 * Let's generate a Markdown file
 *
 * @author Johnathan Pulos
 */
$mdGenerator = new OpenDoorMarkdownGenerator($url, $openId, $title);
/**
 * This link must be absolute
 *
 * @author Johnathan Pulos
 */
$mdGenerator->imageDir = '/Users/Technoguru/Sites/php/open_bible_stories/open_bible_odt_converter/example_files/processed_images/';
$mdGenerator->create("example_files/completed/".$fileTitle.".md");
/**
 * Create the ODT document now that we have a Markdown File
 *
 * @author Johnathan Pulos
 */
$odtConverter = new ODTConverter();
$odtConverter->convert('example_files/completed/'.$fileTitle.'.md', 'example_files/completed/'.$fileTitle.'.odt', 'example_files/templates/obs-book-template.odt');
echo "Your file is complete: example_files/completed/".$fileTitle.".odt\r\n";
?>