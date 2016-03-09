<?php
namespace models;

use models\PageCrawler;

require('models/PageCrawler.php');

class ProductPageCrawler extends PageCrawler{

	protected $total;
	protected $results = [];

	protected static $path = 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html';
	
	public function extractProducts(){
		return json_encode([
			'results' => $this->results,
			'total' => $this->total,
		]);
	}

	public function getProducts(){
		$elems = $this->getDomElements('.product');
        return $elems;
	}

	public function addResult($attributes)
	{

	}

	public function getResults()
	{
		return $this->results;
	}
}
