<?php

namespace data\model;

use think\Db;
use think\Model;

class BaseModel extends Model
{
    protected $error = 0;

    protected $table;

    /**
     * 获取空模型
     */
    public function getEModel($table){
        $res = Db::query('show columns FROM `' . config('database.prefix') . $table . "`");
        $obj = [];
        if($res){
            foreach($res as $key => $v){
                $obj[$v['Field']] = $v['Default'];
                if($v['Key'] == 'PRI'){
                    $obj[$v['Field']] = 0;
                }
            }
        }
        return $obj;
    }
    /**
     * 数据库开启事务
     */
    public function startTrans()
    {
        Db::startTrans();
    }
    /**
     * 数据库事务提交
     */
    public function commit()
    {
        Db::commit();
    }
    /**
     * 数据库事务回滚
     */
    public function rollback()
    {
        Db::rollback();
    }
    /**
     * 列表查询
     */
    public function pageQuery($page_index,$page_size,$condition,$order,$field){
        $count = $this->where($condition)->count();
        if($page_size == 0){
            $list = $this->field($field)->where($condition)->order($order)->select();
            $page_count = 1;
        }else{
            $start_row = $page_size * ($page_index -1);
            $list = $this->field($field)->where($condition)->order($order)
                ->limit($start_row. "," .$page_size)->select();
            if($count % $page_size == 0){
                $page_count = $count / $page_size;
            }else{
                $page_count = (int) ($count / $page_size) + 1;
            }
        }
        return array(
            'data'=> $list,
            'total_count'=> $count,
            'page_count'=> $page_count
        );
    }
    /**
     * 获取一定条件下的列表
     */
    public function getQueryByCondition($condition, $field, $order)
    {
        $list = $this->field($field)->where($condition)->order($order)->select();
        return $list;
    }
    /**
     * 获取所有数据
     */
    public function getAllData($condition,$order){
        $data = Db::table($this->table)->where($condition)->order($order)->select();
        if(!empty($data))
        {
            return $data;
        }else
            return '';
    }
    /**
     * 获取单条数据
     */
    public function getInfo($condition = '',$field = '*'){
        $info = Db::table($this->table)->where($condition)->field($field)->find();
        return $info;
    }
    /**
     * 查询数据数量
     */
    public function getCount($condition){
        $count = Db::table($this->table)->where($condition)->count();
        return $count;
    }
    /**
     * 查询数据分组数量
     */
    public function getGroupCount($group){
        $count = Db::table($this->table)->group($group)->count();
        return $count;
    }
    /**
     * 修改表单个字段值
     */
    public function modifyTableField($pk_name,$pk_id,$field_name,$field_value){
        $data = array(
            $field_name =>$field_value
        );
        $res = $this->save($data,[$pk_name => $pk_id]);
        return $res;

    }
}