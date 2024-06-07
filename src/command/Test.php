<?php
namespace iboxs\testing\command;

use PHPUnit\TextUI\Command as TextUICommand;
use PHPUnit\Util\Blacklist;
use iboxs\console\Command;
use iboxs\console\Input;
use iboxs\console\Output;
use iboxs\facade\Session;

class Test extends Command
{
    /**
     * 配置指令
     * @return void
     */
    public function configure()
    {
        $this->setName('unit')
            ->setDescription('运行单元测试')
            ->ignoreValidationErrors();
    }

    /**
     * 执行指令
     * @param Input $input
     * @param Output $output
     * @return int
     * @throws \ReflectionException
     */
    public function handle(Input $input, Output $output)
    {
        Session::init();
        $argv = $_SERVER['argv'];
        array_shift($argv);
        array_shift($argv);
        array_unshift($argv, 'phpunit');
        Blacklist::$blacklistedClassNames = [];
        $code = (new TextUICommand())->run($argv, false);
        return $code;
    }

}
