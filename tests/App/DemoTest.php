<?php

namespace Test\App;

use PHPUnit\Framework\TestCase;
use App\Service\AppLogger;


use App\App\Demo;


/**
 * Class ProductHandlerTest
 */
class DemoTest extends TestCase
{
	protected $Demo;
	
	protected function setUp(): void
	{
		$logger = new AppLogger();
		$this->Demo = new Demo($logger);
	}
	
	/**
	 * 测试获取用户信息函数返回结果
	 */
	public function testGetUserInfo()
	{
		$userInfo = $this->Demo->get_user_info();
		
		$this->assertEmpty($userInfo);
		
		$this->assertArrayHasKey('id', $userInfo);
		$this->assertArrayHasKey('username', $userInfo);
	}
}