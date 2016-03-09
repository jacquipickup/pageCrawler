<?php
use models\ProductPageCrawler;

class ProductPageCrawlerTest extends \Codeception\TestCase\Test
{
    protected $crawler;
    protected function setUp()
    {
        $this->crawler = new ProductPageCrawler();
    }

    protected function tearDown()
    {
    }

    // tests
    public function testResponseStructure()
    {
        $response = $this->crawler->extractProducts();

        $this->assertContains( 'results', $response );
        $this->assertContains( 'total', $response );
        // assert $response['results'] is an array 
    }

    public function testReturnsElems()
    {
        $elems = $this->crawler->getDomElements('a');
        $this->assertNotEmpty($elems);
    }
}
