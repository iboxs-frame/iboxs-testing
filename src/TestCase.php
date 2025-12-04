<?php

namespace iboxs\testing;

use iboxs\App;
use iboxs\app\MultiApp;
use iboxs\Session;
use iboxs\Request;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

/**
 * Class TestExtend
 * @package tests\Library
 */
abstract class TestCase extends FrameworkTestCase
{
    public $app;

    /**
     * 构造一个请求应用，测试控制器
     *
     * @param array $data 入参数组
     * @param string $method 请求方法
     * @return \iboxs\App
     */
    public function call($appName,$url, $data, $method = 'POST',$header=[],$cookie=[])
    {
        $this->app=new App();
        $this->app->initialize();
        $request = new Request();
        $request->setPathinfo($url);
        $header=array_merge($header,['ACCEPT' => 'application/json']);
        $request->withCookie($cookie);
        $request->withHeader($header);
        $request->withServer(['REQUEST_METHOD'=>$method]);
        $request->withPost($data);
        $request->withRoute($data);
        $http=(new MultiApp($this->app))->app->http;
        $http->name=$appName;
        $response = $http->run($request);
        (new App())->http->end($response);
        return $response;
    }

    public function get($appName,$url,$data,$header=[],$cookie=[]){
        return $this->call($appName,$url,$data,'GET',$header,$cookie);
    }

    public function post($appName,$url,$data,$header=[],$cookie=[]){
        return $this->call($appName,$url,$data,'POST',$header,$cookie);
    }

    public function getCookieWithUser($key,$val){
        $this->app=new App();
        $this->app->initialize();
        $session=new Session($this->app);
        $session->set($key,$val);
        $session->save();
        return [$session->getConfig('name') => $session->getId()  ];
    }
}