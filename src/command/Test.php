<?php

namespace iboxs\testing\command;

use PHPUnit\TextUI\Command as TextUICommand;
use PHPUnit\Util\Blacklist;
use iboxs\console\Command;
use iboxs\console\Input;
use iboxs\console\Output;
use iboxs\facade\Env;
use iboxs\facade\Session;
use iboxs\Loader;

class Test extends Command
{
    public function configure()
    {
        $this->setName('unit')->setDescription('phpunit')->ignoreValidationErrors();
    }

    public function execute(Input $input, Output $output)
    {
        //注册命名空间
        Loader::addNamespace('tests', Env::get('root_path') . 'tests');

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
