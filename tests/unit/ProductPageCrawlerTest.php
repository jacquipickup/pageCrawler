<?php
use models\ProductPageCrawler;

class ExampleTest extends \Codeception\TestCase\Test
{
    protected function setUp()
    {     
    }

    protected function tearDown()
    {
    }

    // tests
    public function testResponse()
    {
        $productPageCrawler = new ProductPageCrawler();
        $response = $productPageCrawler->extractProducts();

        $this->assertTrue( isset($response['items']) );
        $this->assertTrue( is_array($response['items']) );
        $this->assertTrue( isset($response['total']) );
    }
}
