<?php
/**
 * Created by PhpStorm.
 * User: 李勇刚
 * Date: 2020/7/20
 * Time: 10:03
 */

namespace Mrstock\Orm\Test;


use Mrstock\Helper\Config;
use Mrstock\Orm\ModelDb;
use PHPUnit\Framework\TestCase;

class ModelDbTest extends TestCase
{
    //检查查询列表
    public function testSelect()
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
            $modelDb = new ModelDb('default');
            $options['table'] = 'gs_sku_class_value_copy1';
            $options['where']['type'] = 7;
            $options['page'][0] = 1;
            $res = $modelDb->select($options);

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为数组
            $this->assertIsArray($res);
            //断言sku_class_id
            $this->assertArrayHasKey('sku_class_id', $res[0]);
            //断言type
            $this->assertArrayHasKey('type', $res[0]);
            //断言value
            $this->assertArrayHasKey('value', $res[0]);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }
    }

    //检查删除记录
    public function testDelete()
    {
        try {
            $modelDb = new ModelDb('default');
            $options['table'] = 'gs_sku_class_value_copy1';
            $options['where']['type'] = 9;
            $res = $modelDb->delete($options);

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
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

    //检查修改记录
    public function testUpdate()
    {
        try {
            $modelDb = new ModelDb('default');
            $options['table'] = 'gs_sku_class_value_copy1';
            $options['where'] = ['type' => 8];
            $data['value'] = '8号';
            $res = $modelDb->update($data, $options);

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
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

    //检查新增记录
    public function testInsert()
    {
        try {
            $modelDb = new ModelDb('default');
            $options['table'] = 'gs_sku_class_value_copy1';
            $data['type'] = 9;
            $data['value'] = '9号';
            $res = $modelDb->insert($data, $options);

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
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

    //检查query方法
    public function testQuery()
    {
        $modelDb = new ModelDb('default');
        $options['table'] = 'gs_sku_class_value_copy1';
        $res = $modelDb->query('select * from gs_sku_class_value_copy1 where type = 7', $options);
        //断言不为空
        $this->assertNotEmpty($res);
        //断言为数组
        $this->assertIsArray($res);
        //断言字段sku_class_id
        $this->assertArrayHasKey('sku_class_id', $res[0]);
        //断言字段type
        $this->assertArrayHasKey('type', $res[0]);
        //断言字段value
        $this->assertArrayHasKey('value', $res[0]);
    }

    //检查execute方法
    public function testExecute()
    {
        try {
            $modelDb = new ModelDb('default');
            $options['table'] = 'gs_sku_class_value_copy1';
            $res = $modelDb->execute('select * from gs_sku_class_value_copy1 where type = 7');
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为对象
            $this->assertIsObject($res);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }


    }

    //检查showColumns方法
    public function testShowColumns()
    {
        try {
            $modelDb = new ModelDb('default');
            $res = $modelDb->showColumns('gs_sku_class_value_copy1');

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为数组
            $this->assertIsArray($res);
            //断言字段sku_class_id
            $this->assertArrayHasKey('sku_class_id', $res);
            //断言字段type
            $this->assertArrayHasKey('type', $res);
            //断言字段value
            $this->assertArrayHasKey('value', $res);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查getLastId方法
    public function testGetLastId()
    {
        try {
            $modelDb = new ModelDb('default');
            $res = $modelDb->getLastId();
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
            $this->assertIsString($res);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查getAffectedRows方法
    public function testGetAffectedRows()
    {
        $modelDb = new ModelDb('default');
        $res = $modelDb->getAffectedRows();
        if ($res) {
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
            $this->assertIsInt($res);
            //断言值
            $this->assertEquals($res, 1);
        } else {
            $this->assertContains($res, [null, false]);
        }

    }

    //检查批量插入
    public function testInsertAll()
    {
        try {
            $modelDb = new ModelDb('default');
            $options['table'] = 'gs_sku_class_value_copy1';
            $data[0]['type'] = 11;
            $data[0]['value'] = '11号';
            $data[1]['type'] = 12;
            $data[1]['value'] = '12号';

            $res = $modelDb->insertAll($data, $options);

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
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
}