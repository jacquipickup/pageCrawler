<?php 
namespace models;

use Sunra\PhpSimple\HtmlDomParser;

abstract class PageCrawler {


	public function getDomElements($path, $elementSelector )
	{
		$html = HtmlDomParser::file_get_html( $path );
		$elems = [];
		foreach($html->find($elementSelector) as $element){
			$elems[] = $element;
		}
       	return $elems;
	}

	public function getPlainText($elem, $selector = null)
	{
		if($selector){
			$element = $elem->find($selector, 0);
		}else{
			$element = $elem;
		}
		return trim(strip_tags($element->plaintext));
	}

}