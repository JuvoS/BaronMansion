<?php
/**
 * Created by JuvoS
 * Date: 2017/10/14
 * Time: 11:12
 */

namespace data\service;


use think\Session;

class baronUser extends BaseService
{
    public function login($userName,$passWord){
        Session::clear();
        if($userName&&$passWord){
            $baronModel = new BaronUserModel();
            $baronRes = $baronModel->getInfo(array(
                'baron_user'=>$userName,
                'baron_pw'=>$passWord
            ),'');
            if($baronRes){
                return $this->initLoginInfo($baronRes);
            }
        }
    }

    public function initLoginInfo($userInfo){
        Session::set('baronId',$userInfo['Id']);
        Session::set('baronAdmin',$userInfo['Id']);
        Session::set('baronUse',$userInfo['Id']);

//        $data = array(
//            'last_login_time' => $userInfo['current_login_time'],
//            'last_login_ip' => $userInfo['current_login_ip'],
//            'last_login_type' => $userInfo['current_login_type'],
//            'current_login_ip' => request()->ip(),
//            'current_login_time' => date("Y-m-d H:i:s", time()),
//            'current_login_type'  => 1
//        );
//        $retval = $this->user->save($data,['uid' => $userInfo['uid']]);

//        return $retval;
    }
//    /**
//     * 添加用户登录日志
//     *
//     * @param unknown $uid
//     * @param unknown $url
//     * @param unknown $desc
//     */
//    public function addUserLog($uid, $is_system, $controller, $method, $ip, $get_data)
//    {
//        $data = array(
//            'uid' => $uid,
//            'is_system' => $is_system,
//            'controller' => $controller,
//            'method' => $method,
//            'ip' => $ip,
//            'data' => $get_data,
//            'create_time' => date("Y-m-d H:i:s", time())
//        );
//        $user_log = new UserLogModel();
//        $res = $user_log->save($data);
//        return $res;
//    }

    /**
     * 用户退出
     */
    public function Logout()
    {
        Session::clear();
    }
}