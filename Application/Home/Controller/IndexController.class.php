<?php
namespace Home\Controller;

use Think\Controller;
use Think\Db;

class IndexController extends BaseController
{
    public function index()
    {
        parent::special();
        $this->assign('title','豆果美食_菜谱_菜谱大全_优质美食社区');
        $this->display('index');
    }

    public function login()
    {
        if($_POST)
        {
            $userInfo = D()->query("select * from user where binary username = '".$_POST['username']."' and binary password = '".$_POST['password']."' limit 1");
            if(empty($userInfo[0]))
            {
                echo 'error';
            }
            elseif ($userInfo[0]['status'] == 0)
            {
                echo 'close';
            }
            else
            {
                $_SESSION['user'] = $userInfo[0];
                unset($_SESSION['user']['password']);
                $_SESSION['user']['addtime'] = date('Y-m-d H:i:s', $_SESSION['addtime']);
                $_SESSION['user']['isLogin'] = 1;
                echo 'success';
            }
            exit;
        }
        $this->assign('title','登录 - 豆果美食');
        $this->display();
    }

    public function register()
    {
        if($_POST['username'] && $_POST['nickname'] && $_POST['password'])
        {
            $_POST['addtime'] = time();
            $_POST['status'] = 1;
            $result = D('User')->add($_POST);
            if($result)
            {
                $_SESSION['user'] = $_POST;
                $_SESSION['user']['id'] = $result;
                $_SESSION['user']['isLogin'] = 1;
                unset($_SESSION['user']['password']);
            }
            echo $result;
        }
        $this->assign('title','注册 - 豆果美食');
        $this->display();
    }
}