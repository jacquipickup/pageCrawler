<?php
use models\ProductPageCrawler;

class ProductPageCrawlerTest extends \Codeception\TestCase\Test
{
    protected $crawler;
    protected $productElements;
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

    public function testGetProductElements()
    {
        $this->productElements = $this->crawler->getProducts();
        $this->assertNotEmpty($this->productElements);
        $this->assertEquals($this->productElements[0]->class, 'product');
    }

    public function testHasAddResultMethod()
    {
        $methodExists = method_exists($this->crawler, 'addResult');
        $this->assertTrue( $methodExists, 'Class does not have method addResult' );
    }


   

    
}
