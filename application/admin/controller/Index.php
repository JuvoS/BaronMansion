<?php

namespace app\admin\controller;

\think\Loader::addNamespace('data', 'data/');

class Index extends BaseController
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index(){

        return view($this->style . 'index/index');
    }
    /**
     * 查询
     */
    public function search(){
        return view($this->style . 'index/search/index');
    }
}