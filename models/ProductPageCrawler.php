<?php
namespace models;

use models\PageCrawler;
use models\Product;

require('models/Product.php');
require('models/PageCrawler.php');

class ProductPageCrawler extends PageCrawler{

	const PRODUCT_PATH = 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html';

	protected $total;
	protected $results = [];

	
	public function getResponse()
	{
		return json_encode([
			'results' => $this->results,
			'total' => $this->total,
		]);
	}

	public function extractProducts()
	{
		$elems = $this->getProductElements();
		$links = [];
		foreach($elems as $elem){
			$this->addResult([
				'title' => $this->getPlainText($elem, 'h3'),
				'unit_price' => $this->getPlainText($elem, 'p.pricePerUnit'),
				//'description' =>,
				//'size' =>
			]);
		}
	}
	public function getProductElements()
	{
		$elems = $this->getDomElements(self::PRODUCT_PATH, '.product');
        return $elems;
	}

	public function addResult($attributes)
	{
		$product = new Product();
		$product->load($attributes);
		array_push($this->results, $product);
	}

	public function getResults()
	{
		return $this->results;
	}
}
