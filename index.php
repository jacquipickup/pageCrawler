<?php
use models\ProductPageCrawler;

require('autoload.php');

$productPageCrawler = new ProductPageCrawler();
$productPageCrawler->extractProducts();
echo  $productPageCrawler->getResponse() ;