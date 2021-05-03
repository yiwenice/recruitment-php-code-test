<?php

namespace App\Util\Example;

/**
 * Class Example
 *
 * 示例代碼，可以在 tests/Util/Example/ExampleTest.php 找到對應的單元測試
 *
 * @package App\Util\Example
 */
class Example
{
    /**
     * 示例：計算總價格
     *
     * @param array $items
     * @return int
     */
    public static function getTotal($items = [])
    {
        $total = 0;
        foreach ($items as $item) {
            $price = $item['price'] ?: 0;
            $total += $price;
        }

        return $total;
    }

    /**
     * 示例：計算 VAT 增值稅
     *
     * @param int $price
     * @param int $region
     * @return float|null
     */
    public static function calculateVat($price, $region)
    {
        $regionRates = [
            'HK' => 0.5,
            'SG' => 0.8
        ];

        if (empty($price) || empty($region) || empty($regionRates[$region]))
        {
            return null;
        }

        return $price*$regionRates[$region];
    }
}