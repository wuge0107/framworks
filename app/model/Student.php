<?php
namespace app\model;

defined('BASEPATH') OR exit('No direct script access allowed');

use core\lib\model;

/**
 * Class Student
 * @package app\model
 */
class Student extends model
{
    //指定表名
    public $table = 'student';

    //添加一条数据
    public function addOne($data)
    {
        return $this->insert($this->table,$data);

    }

    public function conutA()
    {
        return $this->sum($this->table,'id');
    }
    //查询全部
    public function lists()
    {
        $result = $this->select($this->table,'*');
        return $result;
    }
    
    //查询一条数据
    public function getOne($id)
    {
        $result = $this->get($this->table,'*',['id'=>$id]);
        return $result;
    }
    
    //更新
    public function setOne($id,$data)
    {
        return $this->update($this->table,$data,['id'=>$id]);
    }

    //删除
    public function delOne($id)
    {
        return $this->delete($this->table,['id'=>$id]);
    }
}