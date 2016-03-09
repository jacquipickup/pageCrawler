<?php 
namespace models;

use Sunra\PhpSimple\HtmlDomParser;

abstract class PageCrawler {

	protected static $path = '';

	public function getDomElements( $elementSelector )
	{
		$html = HtmlDomParser::file_get_html( static::$path );
		$elems = [];
		foreach($html->find($elementSelector) as $element){
			$elems[] = $element;
		}
       	return $elems;
	}
}