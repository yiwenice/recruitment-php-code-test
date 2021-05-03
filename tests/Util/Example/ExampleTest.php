<?php

use PHPUnit\Framework\TestCase;
use App\Util\Example\Example;

/**
 * 單元測試示例，每個用例都要有一個 function
 *
 * Class ExampleTest
 */
class ExampleTest extends TestCase
{
    public function testGetTotalSuccess()
    {
        $items = [
            [
                'price' => 10,
            ],
            [
                'price' => 20
            ]
        ];

        $total = Example::getTotal($items);
        $this->assertEquals(30, $total);
    }

    public function testCalculateVatSuccess()
    {
        $price = 10;
        $region = 'HK';

        $vat = Example::calculateVat($price, $region);
        $this->assertEquals(5, $vat);
    }

    public function testCalculateVatIncorrectRegion()
    {
        $price = 10;
        $region = 'BKK';

        $vat = Example::calculateVat($price, $region);
        $this->assertNull($vat);
    }

    public function testCalculateVatNoRegion()
    {
        $price = 10;

        $vat = Example::calculateVat($price);
        $this->assertNull($vat);
    }
}