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
        if($_GET['check'] == 1)
        {
            $this->checkValue();
            exit;
        }
        if($_GET['is_signUp'] == 1)
        {
            $this->goSignUp();
            exit;
        }
        if($_GET['is_signIn'] == 1)
        {
            $this->goSignIn();
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
            exit;
        }
    }

    public function signIn()
    {
        $this->assign('title','登录 - 豆果美食');
        $this->display('Base/signIn');
        exit;
    }

    public function goSignIn()
    {
        $data = $_POST;
        $result = D('User')->field('*')->where($data)->find();
        if($result)
        {
            $_SESSION = $result;
            unset($_SESSION['password']);
            $_SESSION['isLogin'] = 1;
            $_SESSION['addtime'] = date('Y-m-d H:i:s', $result['addtime']);
        }
        echo $result;
    }

    public function signUp()
    {
        $this->assign('title','手机号注册 - 豆果美食');
        $this->display('Base/signUp');
        exit;
    }

    public function goSignUp()
    {
        $data = $_POST;
        $data['addtime'] = time();
        $result = D('User')->add($data);
        if($result)
        {
            $_SESSION = $data;
            unset($_SESSION['password']);
            $_SESSION['addtime'] = date('Y-m-d H:i:s', $data['addtime']);
            $_SESSION['isLogin'] = 1;
            $_SESSION['status'] = 1;
            $_SESSION['id'] = $result;
        }
        echo $result;
    }

    public function checkValue()
    {
        $result = false;
        $table =  $_POST['table'];
        $field =  $_POST['field'];
        $condition =  $_POST['condition'];
        $value =  $_POST['value'];

        $where[$field] = array($condition,$value);

        if ($table && $field && $where && $value)
        {
            $result = D($table)->field('id')->where($where)->find();
        }
        echo $result;
    }
}