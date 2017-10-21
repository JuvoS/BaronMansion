<?php
/**
 * Created by PhpStorm.
 * User: Juvo
 * Date: 2017/9/23
 * Time: 22:54
 */

namespace app\admin\controller;
use think\Controller;

\think\Loader::addNamespace('data', 'data/');

class Common extends Controller
{
    public $style;
    public function __construct()
    {
        parent::__construct();
        $this->style = 'admin/' . BARON_TEMPLATE . '/';
    }

    public function uploadFile(){
        $picname = $_FILES['uploadfile']['name'];
        $picsize = $_FILES['uploadfile']['size'];
        if ($picname != "") {
            if ($picsize > 201400000) { //限制上传大小
                echo '{"status":0,"content":"图片大小不能超过200M"}';
                exit;
            }
            $type = strstr($picname, '.'); //限制上传格式
//            if ($type != ".gif" && $type != ".jpg" && $type != ".png"
//                && $type != ".jpeg"&& $type != ".zip"&& $type != ".rar"&& $type != ".7z"
//                && $type != ".doc"&& $type != ".docx") {
//                echo '{"status":2,"content":"图片格式不对！"}';
//                exit;
//            }
            $rand = rand(100, 999);
            $pics = uniqid() . $type; //命名图片名称
            //上传路径
            $pic_path = "upload/admin/box/". $pics;
            move_uploaded_file($_FILES['uploadfile']['tmp_name'], $pic_path);
        }
        $size = round($picsize/1024,2); //转换成kb
        echo '{"status":1,"name":"'.$picname.'","url":"www.sliverTree.com/baron/'.$pic_path.'","size":"'.$size.'","content":"上传成功"}';
    }

}