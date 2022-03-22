<?php

namespace App\Service;

class ProductHandler
{
	/**
	 * 产品信息数组
	 * @var array
	 */
	private $products = array();
	
	/**
	 * 初始化产品处理器
	 * @param array $products 产品信息
	 */
	public function __construct($products){
		$this->products = $products;
	}
	
	/**
	 * 返回总价格
	 * @return float
	 */
	public function getTotalPrice(){
		return array_reduce($this->products, function($carry, $item){
			if($item && isset($item['price']) && $item['price']>0){
				return $carry+$item['price'];
			}
			
			return 0;
		});
	}
	
	/**
	 * 返回分类为dessert的产品
	 * @return array
	 */
	public function getDessertProducts(){
		$desertProducts = array_filter($this->products, function($p){
			if($p && isset($p['type']) && !strcasecmp('dessert', $p['type'])){
				return true;
			}
			return false;
		});
		
		if($desertProducts){
			usort($desertProducts, function($a, $b){
				if ($a['price'] == $b['price']) {
					return 0;
				}
				return ($a['price'] > $b['price']) ? -1 : 1;
			});
		}
		
		return $desertProducts?$desertProducts:array();
	}
	
	/**
	 * 把创建时间转化为unix时间戳
	 * @return array
	 */
	public function toTimestamp(){
		$newProducts = array_map(function($p){
			if($p && isset($p['create_at'])){
				$p['create_at'] = strtotime($p['create_at']);
			}
			return $p;
		}, $this->products);
		
		return $newProducts;
	}
	
}