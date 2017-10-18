<?php
namespace app\index\controller;


use think\Controller;
use think\Session;

class BaseController extends Controller
{
    public $style;

    public function __construct()
    {
        parent::__construct();

        $this->init();

    }

    public function init(){
        $this->style = 'index/' . BARON_TEMPLATE . '/';
    }

}