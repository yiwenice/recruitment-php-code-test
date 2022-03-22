<?php

namespace Test\Service;

use PHPUnit\Framework\TestCase;
use App\Service\AppLogger;

/**
 * Class ProductHandlerTest
 */
class AppLoggerTest extends TestCase
{
	protected $AppLogger;
	
	protected function setUp(): void
	{
		$this->AppLogger = new AppLogger('think-log');
	}

    public function testInfoLog()
    {
        $this->AppLogger->info('This is info log message');
        
        $response = ['error' => '00'];
        
        if ($response['error'] == 0){
        	print_r('error==0 passed');
        }
    }
    
    public function testDebugLog()
    {
    	$this->AppLogger->info('This is debug log message');
    }
    
    public function testErrorLog()
    {
    	$this->AppLogger->info('This is error log message');
    }
}