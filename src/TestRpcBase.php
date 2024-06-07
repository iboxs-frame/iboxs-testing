<?php

namespace iboxs\testing;

use iboxs\console\Output;
use iboxs\facade\App;

class TestRpcBase extends TestBase
{

    use RpcClientTrait;

    /**
     * rpc加载状态
     * @var bool
     */
    protected static $loadRpc = false;

    /**
     * step 2
     * 执行单元测试前执行此方法
     */
    protected function setUp()
    {
        $this->output = new Output();
        //rpc客户端准备
        if (false === self::$loadRpc && file_exists($rpc = App::getBasePath() . 'rpc.php')) {
            $this->prepareRpcClient();
            self::$loadRpc = true;
        }
    }
}