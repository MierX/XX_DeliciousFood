<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController
{
    public function index()
    {
//        $this->assign('title','豆果美食 - 后台管理系统');
        $this->display();
    }

    public function login()
    {
        if($_POST)
        {
            $adminInfo = D()->query("select * from admin where binary username = '".$_POST['username']."' and binary password = '".$_POST['password']."' limit 1");
            if(empty($adminInfo[0]))
            {
                echo 'error';
            }
            elseif ($adminInfo[0]['status'] == 0)
            {
                echo 'close';
            }
            else
            {
                D('Admin')->where(['id' => $adminInfo[0]['id']])->setInc('login');
                $_SESSION['admin'] = $adminInfo[0];
                unset($_SESSION['admin']['password']);
                $_SESSION['admin']['isLogin'] = 1;
                echo 'success';
            }
            exit;
        }
        $this->assign('title','登录 - 豆果美食后台');
        $this->display('login');
    }
}