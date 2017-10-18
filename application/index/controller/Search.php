<?php
/**
 * Created by PhpStorm.
 * User: Juvo
 * Date: 2017/10/18
 * Time: 22:18
 */

namespace app\index\controller;


class Search extends BaseController {
    public function __construct(){
        parent::__construct();
    }
    public function index()
    {
        return view($this->style . 'Search/index');
    }
}