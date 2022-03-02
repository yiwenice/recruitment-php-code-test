<?php
/*
 * @Date         : 2022-03-02 14:49:25
 * @LastEditors  : Jack Zhou <jack@ks-it.co>
 * @LastEditTime : 2022-03-02 17:22:16
 * @Description  : 
 * @FilePath     : /recruitment-php-code-test/tests/App/DemoTest.php
 */

namespace Test\App;

use PHPUnit\Framework\TestCase;
use App\Util\HttpRequest;
use App\App\Demo;

class DemoTest extends TestCase {
    public function test_foo() {
        $req = new HttpRequest();
        $demo = new Demo(null, $req);
        $this->assertEquals('bar', $demo->foo());
    }

    public function test_get_user_info() {
        // error为0
        $error = 0;
        $data = [
            "id" => 1,
            "username" => "hello world"
        ];
        $ret_json = json_encode((["error"=> $error, "data" => $data]));
        $req_stub = $this->createMock(HttpRequest::class);
        $req_stub->method('get')->willReturn($ret_json);
        $demo = new Demo(null, $req_stub);
        $this->assertEquals($data, $demo->get_user_info());
        
        // error非0
        $error = 1;
        $ret_json = json_encode((["error"=> $error, "data" => $data]));
        $req_stub = $this->createMock(HttpRequest::class);
        $req_stub->method('get')->willReturn($ret_json);
        $logger_mock = $this->getMockBuilder(\stdClass::class)
                            ->addMethods(['error'])
                            ->getMock();
        $logger_mock->expects($this->once())
                    ->method('error')
                    ->with("fetch data error.");
        $demo = new Demo($logger_mock, $req_stub);
        $this->assertNull($demo->get_user_info());
    }
}