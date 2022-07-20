<?php
/**
 * Created by PhpStorm.
 * User: 李勇刚
 * Date: 2020/7/19
 * Time: 16:26
 */

namespace Mrstock\Orm\Test;


use Mrstock\Helper\Config;
use Mrstock\Orm\CommonModel;
use PHPUnit\Framework\TestCase;

class CommonModelTest extends TestCase
{
    //检查获取列表
    public function testGetList()
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
            $commonModel = new CommonModel('goods');

            $res = $commonModel->getList('object_id = 36');

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

    //检查获取单条
    public function testGetOne()
    {
        $commonModel = new CommonModel('goods');

        $res = $commonModel->getOne('object_id = 36');

        //断言不为空
        $this->assertNotEmpty($res);
        //断言为数组
        $this->assertIsArray($res);
        //断言KEY值
        $this->assertArrayHasKey('goods_id', $res);
    }

    //检查通过主键更新数据
    public function testUpdateByKey()
    {
        try {
            $commonModel = new CommonModel('gs_sku_class_value');

            $data['value'] = '永久';
            $data['type'] = 8;
            $res = $commonModel->updateByKey($data, 'type');

            //断言不为空
            $this->assertNotEmpty($res);
            //断言为bool
            $this->assertIsBool($res);
            //断言KEY值
            $this->assertEquals($res, 1);
        } catch (\Exception $e) {
            //断言不为空
            $this->assertNotEmpty($e);
            //断言为bool
            $this->assertIsObject($e);
        }

    }
}
