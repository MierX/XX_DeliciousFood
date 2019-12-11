<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller
{
    public function _initialize()
    {
        if ($_GET['noSign'] == 1)
        {
            $this->index();
            exit;
        }
        if($_GET['goSignUp'] == 1)
        {
            $this->signUp();
            exit;
        }
        $_GET['signIn'] == 1 ? $this->signIn() : $this->isSign();
    }

    public function index()
    {

    }

    public function isSign()
    {
        if ($_SESSION['isLogin'] != 1)
        {
            echo "<link rel='stylesheet' href='../../../Public/js/layui/css/layui.css' />
                    <script type='text/javascript' src='../../../Public/js/jquery-3.4.1.min.js'></script>
                    <script type='text/javascript' src='../../../Public/js/layui/layui.all.js'></script>
                    <script type='text/javascript' src='../../../Public/js/layer/layer.js'></script>
                    <script>layer.confirm('您还没有登录，是否先去登录？', {btn:['先去登录','随便看看']},function() {layer.msg('好的，现在去登录', {icon: 1});location.href = 'Home/index?signIn=1';},function() {layer.msg('记得等会登录哦', {icon: 1});location.href = 'Home/index?noSign=1';})</script>";
            exit;
        }
        else
        {
            $this->index();
        }
    }

    public function signIn()
    {
        $this->assign('title','登录 - 豆果美食');
        $this->display('Base/signIn');
        exit;
    }

    public function signUp()
    {
        $this->assign('title','手机号注册 - 豆果美食');
        $this->display('Base/signUp');
        exit;
    }

    public function head()
    {
        $this->display('Base/head');
    }
}