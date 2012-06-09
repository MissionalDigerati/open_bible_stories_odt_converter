Open Bible ODT Converter
========================

This PHP library converts a [Open Bible Stories](http://www.openbiblestories.com/) story into a [Open Office](http://www.openoffice.org/) file.  It grabs the HTML from an Open Bible Stories web page like [The Compassionate Father](http://en.door43.org/wiki/Stories:The_Compassionate_Father#2).  It then replaces all the images with a set of prepared images, converts the new HTML to a Markdown file, and finally converts the document to an ODT file using a given template. 

Requirements
------------

* PHP 5 >
* [Pandoc](http://johnmacfarlane.net/pandoc/)
* Command line access

Running the Example
-------------------

From the command line,  change to the root directory of the project.  Verify that you have correctly installed all the required libraries.  Run the following command:

`php example.php http://pt.door43.org/w/index.php?title=Hist%C3%B3rias:O_Pai_Compassivo 23 "The Compassionate Father"`

Usage
-----

You will first need to prepare the images.  Images use the following format: OBS-{open bible id}-{incremental with leading zero}.jpg.  The incremental represents the position on the page (top to bottom) for the image starting including a leading zero.  Once prepared, you can run the following command in the command line:

`php example.php {url} {open_bible_id} {title}`

* url - The web page url for the story (**required**)
* open\_bible\_id - The Open Bible Id for the story (**required**)
* title - The title for the document. *default: Open Bible Stories* (**optional**)


Development
-----------

Questions or problems? Please post them on the [issue tracker](https://github.com/MissionalDigerati/open_bible_stories_odt_converter/issues). You can contribute changes by forking the project and submitting a pull request.

This script is created by Johnathan Pulos and is under the [GNU General Public License v3](http://www.gnu.org/licenses/gpl-3.0-standalone.html).