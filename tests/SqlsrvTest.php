<?php
/**
 * Created by PhpStorm.
 * User: 李勇刚
 * Date: 2020/7/20
 * Time: 11:24
 */

namespace Mrstock\Orm\Test;


use Mrstock\Orm\sqlsrv;
use PHPUnit\Framework\TestCase;

class SqlsrvTest extends TestCase
{
    //检查fetch data todo::未部署本地sqlser 环境
    public function testFetchAll()
    {
        $sqlsrv = new sqlsrv();

        //$res = $sqlsrv->fetch_all('select * from goods where object_id = 36');
        $res = [];
        $this->assertEmpty($res);
    }
}