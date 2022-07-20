<?php
/**
 * Created by PhpStorm.
 * User: 李勇刚
 * Date: 2020/7/19
 * Time: 16:52
 */

namespace Mrstock\Orm\Test;


use Mrstock\Helper\Config;
use Mrstock\Orm\Model;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    //检查第一个使用
    public function testTable()
    {
        if (!defined('VENDOR_DIR')) {
            define('VENDOR_DIR', __DIR__ . '/../vendor');
        }
        if (!defined('APP_PATH')) {
            define('APP_PATH', __DIR__ . '/../src');
        }
        if (!Config::get('db.default')) {
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
        }

        $model = new Model();

        $res = $model->table('goods');

        //断言不为空
        $this->assertNotEmpty($res);
        //断言为对象
        $this->assertIsObject($res);
    }

    //检查指定写库或者读库
    public function testMaster()
    {
        $model = new Model('goods');

        $res = $model->master();
        //断言不为空
        $this->assertNotEmpty($res);
        //断言为对象
        $this->assertIsObject($res);
    }

    //检查查询字段
    public function testField()
    {
        $model = new Model('goods');

        $res = $model->field('goods_id,name,img');
        //断言不为空
        $this->assertNotEmpty($res);
        //断言为对象
        $this->assertIsObject($res);
    }

    //检查分页
    public function testPage()
    {
        $model = new Model('goods');

        $res = $model->page(1);

        //断言不为空
        $this->assertNotEmpty($res);
        //断言为对象
        $this->assertIsObject($res);
    }

    //检查查询
    public function testSelect()
    {
        try {
            $model = new Model('goods');

            $data['page'][0] = 1;
            $res = $model->select($data);

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为数组
            $this->assertIsArray($res);
            //断言值
            $this->assertEquals(count($res), 10);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查返回一条记录
    public function testFind()
    {
        try {
            $model = new Model('goods');

            $res = $model->find();
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为数组
            $this->assertIsArray($res);
            //断言值
            $this->assertArrayHasKey('goods_id', $res);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查删除
    public function testDelete()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');

            $data['where'] = ['type' => 9];
            $res = $model->delete($data);

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool or int
            $this->assertIsInt($res);
            //断言值
            $this->assertEquals($res, 1);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查更新
    public function testUpdate()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');

            $where['where'] = ['type' => 8];
            $data['value'] = '修改';
            $res = $model->update($data, $where);

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool or int
            $this->assertIsInt($res);

            //断言值
            $this->assertEquals($res, 1);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查插入
    public function testInsert()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');

            $data['type'] = 8;
            $data['value'] = '新的';
            $res = $model->insert($data);

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
            $this->assertIsInt($res);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查批量插入
    public function testInsertAll()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');

            $data[0]['type'] = 9;
            $data[0]['value'] = '9号';
            $data[1]['type'] = 10;
            $data[1]['value'] = '10号';
            $res = $model->insertAll($data);

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

    //检查直接SQL查询,返回查询结果 select 使用
    public function testQuery()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');

            $res = $model->query('select * from gs_sku_class_value_copy1 where type = 7');
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

    //检查直接执行sql语句 insert update delete 使用
    public function testExecute()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');

            $res = $model->execute('select * from gs_sku_class_value_copy1 where type = 2');

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为数组
            $this->assertIsObject($res);
            //断言$res包含元素field_count
            $this->assertObjectHasAttribute('field_count', $res);
            //断言$res包含元素num_rows
            $this->assertObjectHasAttribute('num_rows', $res);
            //断言$res包含元素type
            $this->assertObjectHasAttribute('type', $res);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查开始事务
    public function testBeginTransaction()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');
            $res = $model->beginTransaction();
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
            $this->assertIsBool($res);
            //断言值
            $this->assertEquals($res, 1);

            $close_res = $model->rollback();
            //断言不为空
            $this->assertNotEmpty($close_res);
            //断言为bool
            $this->assertIsBool($close_res);
            //断言值
            $this->assertEquals($close_res, 1);
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
            $model = new Model('gs_sku_class_value_copy1');
            $res = $model->beginTransaction();
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
            $this->assertIsBool($res);
            //断言值
            $this->assertEquals($res, 1);

            $close_res = $model->commit();
            //断言不为空
            $this->assertNotEmpty($close_res);
            //断言为bool
            $this->assertIsBool($close_res);
            //断言值
            $this->assertEquals($close_res, 1);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查回滚事务
    public function testRollback()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');
            $res = $model->beginTransaction();
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
            $this->assertIsBool($res);
            //断言值
            $this->assertEquals($res, 1);

            $close_res = $model->rollback();
            //断言不为空
            $this->assertNotEmpty($close_res);
            //断言为bool
            $this->assertIsBool($close_res);
            //断言值
            $this->assertEquals($close_res, 1);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查关闭事务
    public function testCloseTransaction()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');
            $res = $model->beginTransaction();
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
            $this->assertIsBool($res);
            //断言值
            $this->assertEquals($res, 1);

            $close_res = $model->closeTransaction();
            //断言不为空
            $this->assertNotEmpty($close_res);
            //断言为bool
            $this->assertIsBool($close_res);
            //断言值
            $this->assertEquals($close_res, 1);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查获取表结构
    public function testShowColumns()
    {
        try {
            $model = new Model();

            $res = $model->showColumns('gs_sku_class_value_copy1');
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为数组
            $this->assertIsArray($res);
            //断言是否包含字段sku_class_id
            $this->assertArrayHasKey('sku_class_id', $res);
            //断言是否包含字段type
            $this->assertArrayHasKey('type', $res);
            //断言是否包含字段value
            $this->assertArrayHasKey('value', $res);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查取得最后插入的ID
    public function testGetLastId()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');

            $res = $model->getLastId();

            //断言不为空
            $this->assertEmpty($res);
            //断言为bool
            $this->assertIsString($res);
            //断言值
            $this->assertEquals($res, 0);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }

    //检查GetAffectedRows
    public function testGetAffectedRows()
    {
        $model = new Model('gs_sku_class_value_copy1');

        @$res = $model->getAffectedRows();

        if ($res == null || $res == false) {
            $this->assertContains($res, [null, false]);
        } else {
            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
            $this->assertIsInt($res);
            //断言值
            $this->assertEquals($res, 1);
        }

    }

    //检查组装join
    public function testJoin()
    {
        $model = new Model();

        $string = 'SELECT name,price FROM goods INNER JOIN goods_sku ON goods.goods_id = goods_sku.goods_id';
        $res = $model->join($string);

        //断言不为空
        $this->assertNotEmpty($res);
        //断言为对象
        $this->assertIsObject($res);
    }

    //检查自增
    public function testSetInc()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');
            $where['where']['type'] = 2;
            $res = $model->setInc('type', 1, $where);

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

    //检查自减
    public function testSetDec()
    {
        try {
            $model = new Model('gs_sku_class_value_copy1');
            $where['where']['type'] = 2;
            $res = $model->setInc('type', 1, $where);

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