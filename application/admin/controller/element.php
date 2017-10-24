<?php
/**
 * Created by PhpStorm.
 * User: Juvo
 * Date: 2017/10/19
 * Time: 20:09
 */

namespace app\admin\controller;


use data\model\baron\mansion\STEleCateModel;
use data\model\baron\system\BaronUserModel;

class Element extends BaseController {
    public function __construct()
    {
        parent::__construct();

        $this->initIndex();
    }
    public function initIndex(){
        $userModel = new BaronUserModel();
        $userRes = $userModel->getAllData('','');
        $this->assign('userRes',$userRes[0]);
    }
    public function index(){
        return view($this->style . 'Element/index');
    }

    /**
     * 产品类别
     */
    public function eleKind(){
        $eleCateModel = new STEleCateModel();
        if($_POST){
//            var_dump($_POST);
            $classNum = isset($_POST['classNum'])?$_POST['classNum']:0;
            $parentId = isset($_POST['parentId'])?$_POST['parentId']:0;
            $kindName = isset($_POST['kindName'])?$_POST['kindName']:'';
            $eleCateModel->save(array(
                'name'=>$kindName,
                'parentId'=>$parentId,
                'classNum'=>$classNum,
                'updateTime'=>date("Y-m-d H:i:s")
            ),'','');
        }

        $eleCateRes = $eleCateModel->group('classNum')->select();
//        for($i=0;$i<count($eleCateRes);$i++){
            $eleCateOne = $eleCateModel->getAllData(array(
                'parentId'=>0
            ),'');
            for($k=0;$k<count($eleCateOne);$k++){
                $eleCateTwo = $eleCateModel->getAllData(array(
                    'parentId'=>$eleCateOne[$k]['Id']
                ),'');
                $eleCateOne[$k]['arr'] = $eleCateTwo;
                for($m=0;$m<count($eleCateTwo);$m++){
                    $eleCateThree = $eleCateModel->getAllData(array(
                        'parentId'=>$eleCateTwo[$k]['Id']
                    ),'');
                    $eleCateTwo[$k]['arr'] = $eleCateThree;
                }
            }
//        }
        var_dump($eleCateRes);
        return view($this->style . 'Element/eleKind');
    }
    /**
     * 添加产品
     */
    public function addEle(){
        return view($this->style . 'Element/addEle');
    }
    /**
     * 添加产品
     */
    public function uploadEle(){
        return view($this->style . 'Element/uploadEle');
    }
    /**
     * 产品搜索
     */
    public function eleSearch(){
        return view($this->style . 'Element/eleSearch');
    }
}