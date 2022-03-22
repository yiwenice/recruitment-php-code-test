<?php

namespace App\Service;

use think\facade\Log;

class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';
    const TYPE_THINKLOG = 'think-log';

    private $logger;
    private $type;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
    	$this->type = $type;
    	
    	if ($type == self::TYPE_LOG4PHP) {
            $this->logger = \Logger::getLogger("Log");
    	} else if($type == self::TYPE_THINKLOG){
    		Log::init([
    				'default'	=>	'file',
    				'channels'	=>	[
    						'file'	=>	[
    								'type'	=>	'file',
    								'path'	=>	'./logs/',
    						],
    				],
    		]);
    		$this->logger = Log::channel();
    	}
    }

    public function info($message = '')
    {
    	$this->logger->info($this->type == self::TYPE_THINKLOG?strtoupper($message) : $message);
    }

    public function debug($message = '')
    {
    	$this->logger->debug($this->type == self::TYPE_THINKLOG?strtoupper($message) : $message);
    }

    public function error($message = '')
    {
    	$this->logger->error($this->type == self::TYPE_THINKLOG?strtoupper($message) : $message);
    }
}