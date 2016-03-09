<?php
use models\ProductPageCrawler;

require('autoload.php');

$productPageCrawler = new ProductPageCrawler();
$response = $productPageCrawler->extractProducts();
var_dump( $response );