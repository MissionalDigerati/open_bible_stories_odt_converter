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
require 'lib/open_bible_odt_converter.php';
$mdGenerator = new OpenDoorMarkdownGenerator('http://en.door43.org/wiki/Stories:The%20Compassionate%20Father?action=render#2');
$mdGenerator->imageDir = 'example_files/processed_images/';
$mdGenerator->create("The Creation", "example_files/completed/the_creation.md");
?>