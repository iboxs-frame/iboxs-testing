<?php
namespace iboxs\testing;

use iboxs\testing\command\Test;

class Service extends \iboxs\Service
{

    /**
     * 执行服务
     * @return void
     */
    public function boot()
    {
        $this->commands(
            [
                Test::class,
            ]
        );
    }

}
