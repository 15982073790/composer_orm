<?php

namespace Mrstock\Orm;

class  CommonModel extends Model
{

    public function getList($condition, $page = '', $order = '', $field = '*')
    {

        $result = $this->field($field)->where($condition)->limit(false)->order($order)->select();

        return $result;
    }

    public function getOne($condition, $field = '*')
    {
        $result = $this->field($field)->where($condition)->find();

        return $result;
    }

    /**
     * 通过主键更新数据
     * @param $data
     * @param $key
     * @return bool
     */
    public function updateByKey($data, $primaryKey = "id")
    {
        if (!isset($data[$primaryKey])) {
            return false;
        }
        $where = '';
        $where = " $primaryKey = '" . $data[$primaryKey] . "'";
        $result = $this->where($where)->update($data);
        return $result;
    }
}