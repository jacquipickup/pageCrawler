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

	public function getFileSize($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
		return ($size);
	}


}