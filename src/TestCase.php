<?php

namespace iboxs\testing;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    use ApplicationTrait, AssertionsTrait, CrawlerTrait;
}
