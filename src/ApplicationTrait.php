<?php

namespace iboxs\testing;

use iboxs\Db;
use iboxs\facade\Session;

trait ApplicationTrait
{
    public function withSession(array $data)
    {
        foreach ($data as $key => $value) {
            Session::set($key, $value);
        }
        return $this;
    }

    public function clearSession()
    {
        Session::clear();
    }

    protected function seeInDatabase($table, array $data)
    {
        $count = Db::name($table)->where($data)->count();

        $this->assertGreaterThan(0, $count, sprintf(
            'Unable to find row in database table [%s] that matched attributes [%s].', $table, json_encode($data)
        ));

        return $this;
    }

    protected function notSeeInDatabase($table, array $data)
    {
        $count = Db::name($table)->where($data)->count();

        $this->assertEquals(0, $count, sprintf(
            'Found unexpected records in database table [%s] that matched attributes [%s].', $table, json_encode($data)
        ));

        return $this;
    }
}
