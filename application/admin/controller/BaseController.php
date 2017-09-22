<?php
namespace app\admin\controller;


use think\Controller;

class BaseController extends Controller
{
    public $style;

    public function __construct()
    {
        parent::__construct();

        $this->init();
    }

    public function init(){
        $this->style = 'admin/' . BARON_TEMPLATE . '/';
    }
    public function checkUserSystem(){

    }
}