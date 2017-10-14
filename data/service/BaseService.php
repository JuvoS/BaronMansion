<?php
/**
 * Created by JuvoS
 * Date: 2017/10/14
 * Time: 10:40
 */

namespace data\service;


use think\Session;

class BaseService
{
    protected $baronId;
    protected $baronGrade;
    protected $baronUse;

    public function __construct()
    {
        $this->init();
    }

    /**
     * 数据初始化
     */
    private function init(){
        $this->baronId = Session::get('baronId');
        $this->baronGrade = Session::get('baronAdmin');
        $this->baronUse = Session::get('baronUse');
    }
}