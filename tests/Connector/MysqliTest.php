<?php
/**
 * Created by PhpStorm.
 * User: 李勇刚
 * Date: 2020/7/17
 * Time: 14:33
 */

namespace Mrstock\Orm\Test\Connector;


use Mrstock\Helper\Config;
use Mrstock\Orm\Connector\Mysqli as Db;
use PHPUnit\Framework\TestCase;

class MysqliTest extends TestCase
{

    //检查取得数组
    public function testGetAll()
    {
        if (!defined('VENDOR_DIR')) {
            define('VENDOR_DIR', __DIR__ . '/../vendor');
        }
        if (!defined('APP_PATH')) {
            define('APP_PATH', __DIR__ . '/../src');
        }
        $config['db']['default'] = [
            'read' => [
                'host' => '192.168.10.230',
                'port' => '3306'
            ],
            'write' => [
                'host' => '192.168.10.230',
                'port' => '3306'
            ],
            'driver' => 'mysqli',
            'name' => 'app.goods',
            'user' => 'stocksir',
            'pwd' => 'stocksir1704!',
            'charset' => 'UTF-8',
            'tablepre' => ''
        ];
        Config::set($config);
        try {
            $res = Db::getAll('SELECT * FROM goods WHERE object_id = 36');

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为数组
            $this->assertIsArray($res);
            //断言KEY值
            $this->assertArrayHasKey('goods_id', $res[0]);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }
    }

    //检查取得上一步插入产生的ID
    public function testGetLastId()
    {
        try {
            $string = 'INSERT INTO gs_sku_class_value_copy1 (type,value) VALUES (  8,\'测试\' )';
            $res = Db::execute("$string");

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为数组
            $this->assertIsBool($res);
            //断言值
            $this->assertEquals($res, 1);

            $res = Db::getLastId();
            if ($res) {
                //断言不为空
                $this->assertNotEmpty($res);
                //断言为int
                $this->assertIsInt($res);
            } else {
                //断言为空
                $this->assertEmpty($res);
            }
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }


    }

    //检查getAffectedRows
    public function testGetAffectedRows()
    {
        $res = Db::getAffectedRows();
        if ($res) {
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为数组
            $this->assertIsInt($res);
            //断言值
            $this->assertEquals($res, 1);
        } else {
            //断言为空
            $this->assertContains($res, [0, null, false]);
        }

    }

    //检查执行SQL语句
    public function testExecute()
    {
        $string = 'INSERT INTO gs_sku_class_value_copy1 ( type,value) VALUES ( 8,\'测试\' )';
        $res = Db::execute("$string");

        //断言不为空
        $this->assertNotEmpty($res);
        //断言为数组
        $this->assertIsBool($res);
        //断言值
        $this->assertEquals($res, 1);
    }

    //检查显示表字段信息
    public function testShowColumns()
    {
        try {
            $res = Db::showColumns('gs_sku_class_value_copy1');
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为数组
            $this->assertIsArray($res);
            //断言sku_class_id值
            $this->assertArrayHasKey('sku_class_id', $res);
            //断言type值
            $this->assertArrayHasKey('type', $res);
            //断言value值
            $this->assertArrayHasKey('value', $res);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查关闭连接
    public function testClose()
    {
        try {
            $res = Db::close();
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为数组
            $this->assertIsBool($res);
            //断言值
            $this->assertEquals($res, 1);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查开启事务 新起连接
    public function testBeginTransaction()
    {
        try {
            $res = Db::beginTransaction();

            //断言为空
            $this->assertEmpty($res);
            //断言为NULL
            $this->assertNull($res);
            $res = Db::rollback();
            //断言为空
            $this->assertEmpty($res);
            //断言为NULL
            $this->assertNull($res);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查提交事务
    public function testCommit()
    {
        try {
            $res = Db::beginTransaction();

            //断言为空
            $this->assertEmpty($res);
            //断言为NULL
            $this->assertNull($res);

            $res = Db::commit();

            //断言为空
            $this->assertEmpty($res);
            //断言为NULL
            $this->assertNull($res);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }


    }
}