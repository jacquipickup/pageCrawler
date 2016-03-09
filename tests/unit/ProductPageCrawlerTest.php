<?php
use models\ProductPageCrawler;

class ProductPageCrawlerTest extends \Codeception\TestCase\Test
{
    protected $crawler;
    protected $productElements;
    protected $dummyProducts = [];

    protected function setUp()
    {
        $this->crawler = new ProductPageCrawler();

        $this->dummyProducts[] = [
            'description' => 'testing Description',
            'unit_price' => '3.20',
            'title' => 'testing Title',
            'size' => '200kb',
        ];
        $this->dummyProducts[] = [
            'description' => 'testing Description',
            'unit_price' => '3.20',
            'title' => 'testing Title',
            'size' => '200kb',
        ];
        $this->dummyProducts[] = [
            'description' => 'testing Description',
            'unit_price' => '3.20',
            'title' => 'testing Title',
            'size' => '200kb',
        ];

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


    public function testGetProductIsObject()
    {
        foreach($this->dummyProducts as $productAttributes)
        {
            $this->runAddResult($productAttributes);
            $results = $this->crawler->getResults();
            $this->assertTrue(is_object(array_pop($results)), 'Result item is not an object');
        }
    }

    protected function runAddResult($attributes)
    {
        $this->crawler->addResult($attributes);
    }

    
}
