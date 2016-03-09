<?php
namespace models;

use models\PageCrawler;

require('models/PageCrawler.php');

class ProductPageCrawler extends PageCrawler{

	private $total;
	private $results = [];

	protected static $path = 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html';
	
	public function extractProducts(){
		return json_encode([
			'results' => $this->results,
			'total' => $this->total,
		]);
	}
}
