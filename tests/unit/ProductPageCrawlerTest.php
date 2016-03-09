<?php
use models\ProductPageCrawler;

class ProductPageCrawlerTest extends \Codeception\TestCase\Test
{
    protected function setUp()
    {     
    }

    protected function tearDown()
    {
    }

    // tests
    public function testResponseStructure()
    {
        $productPageCrawler = new ProductPageCrawler();
        $response = $productPageCrawler->extractProducts();

        $this->assertContains( 'results', $response );
        $this->assertContains( 'total', $response );
        // assert $response['results'] is an array 
    }
}
