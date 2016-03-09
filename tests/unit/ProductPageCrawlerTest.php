<?php
use models\ProductPageCrawler;

/*

Notes:
I wanted to created seperate unit tests for the PageCrawler class, but as this is an abstract couldn't directly. 
Should've probably created a basic class that extended it without any  additional functinality.

Haven't created a full test suite for all the code developed as started to run out of time. 
I hope there is enough here for you to see how I would've carried on.
This is my first trial of Unit Testing and Codeception

I have chosen to extend PageCrawler so this could be reused as it isn't project specific. It acts as a wrapper for Sunra\PhpSimple\HtmlDomParser but probably should've been considered as a helper class.

I've chosen to not use a framework due to the size of the project and didn't think it would add enough value.


*/

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
            'size' => '200',
        ];
        $this->dummyProducts[] = [
            'description' => 'testing Description',
            'unit_price' => '3.20',
            'title' => 'testing Title',
            'size' => '200kb',
            'dodgyAttr' => 'sdjfbksdjfbkfjsdbfsfjsdffsjdbdsfkj',
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
        $response = $this->crawler->getResponse();

        $this->assertContains('results', $response);
        $this->assertContains('total', $response);
        $decodedResponse = json_decode($response);
        $this->assertTrue( is_array($decodedResponse->results) );
    }

    public function testReturnsElems()
    {
        $elems = $this->crawler->getDomElements(ProductPageCrawler::PRODUCT_PATH, 'a');
        $this->assertNotEmpty($elems);
    }

    public function testGetProductElements()
    {
        $this->productElements = $this->crawler->getProductElements();
        $this->assertNotEmpty($this->productElements);
        $this->assertEquals($this->productElements[0]->class, 'product');
    }

    public function testHasAddResultMethod()
    {
        $methodExists = method_exists($this->crawler, 'addResult');
        $this->assertTrue( $methodExists, 'Class does not have method addResult' );
    }

    protected function runAddResult(array $attributes = [])
    {
        $this->crawler->addResult($attributes);
    }

    public function testGetProductIsObject()
    {
        $this->runAddResult();
        $results = $this->crawler->getResults();
        $this->assertTrue(is_object(array_pop($results)), 'Result item is not an object');
    }

    public function testResultItemContainsCorrectAttributes()
    {
        foreach($this->dummyProducts as $attributes)
        {
            $this->runAddResult($attributes);
            $results = $this->crawler->getResults();
            $result = array_pop($results);

            $this->assertEquals($result->description, $attributes['description'], 'description NOT: '.$result->description);
            $this->assertEquals($result->unit_price, $attributes['unit_price'], 'unit_price NOT: '.$result->unit_price);
            $this->assertEquals($result->title, $attributes['title'], 'title NOT: '.$result->title);
            $this->assertEquals($result->size, $attributes['size'], 'size NOT: '.$result->size);
        }
    }

    
}
