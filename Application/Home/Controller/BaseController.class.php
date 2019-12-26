<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller
{
    public function index()
    {

    }

    public function out()
    {
        session('user',null);
        echo true;
    }

    public function list()
    {
        $page = $_GET['page'] > 0 ? $_GET['page'] : 1;
        $psize = ($page-1)*20;
        $data = D()->query("select * from ".$_GET['table']." where ".$_GET['where']." ORDER BY ".$_GET['order']." limit ".$psize.",20");
        $lastPage = D()->query("select count(*) as count from ".$_GET['table']." where ".$_GET['where']." ORDER BY ".$_GET['order']." limit 1");
        $lastPage = ceil($lastPage[0]['count'] / 20);

        $this->assign('title',$_GET['title']);
        $this->assign('id',$_GET['id']);
        $this->assign('pageId',$_GET['id']);
        $this->assign('data',$data);
        $this->assign('page',$page);
        $this->assign('lastPage',$lastPage);
    }

    public function special()
    {
        $special = D('Special')->field('*')->where(['status' => 1])->order('toptime desc,addtime asc')->select();
        foreach ($special as $key => &$value)
        {
            $value['menu'] = D('Menu')->field('*')->where(['status' => 1, 'sid' => $value['id']])->order('addtime desc')->select();
            $value['menu'] = $this->checkStatus($value['menu']);
            if(count($value['menu']) < 8)
            {
                unset($special[$key]);
            }
            else
            {
                $value['menu'] = array_slice($value['menu'],0,8);
            }
        }
        $this->assign('special',$special);
    }

    public function check()
    {
        $result = false;

        $table =  $_POST['table'];
        $field =  $_POST['field'];
        $condition =  $_POST['condition'];
        $value =  $_POST['value'];
        $where = $field." ".$condition." '".$value."'";
        $sql = "select id from ".$table." where binary ".$where." limit 1";

        if ($table && $field && $where && $value) $result = D()->execute($sql) ? true : false;
        echo $result;
    }

    public function status()
    {
        $result = true;
        if($_SESSION['user'])
        {
            $status = D('User')->field('status')->where(['id' => $_SESSION['user']['id']])->find();
            if($status['status'] != 1)
            {
                session('user',null);
                $result = false;
            }
        }
        echo $result;
    }

    public function checkStatus($data)
    {
        foreach ($data as $k => $v)
        {
            $status = D('User')->field('status')->where(['id' => $v['uid']])->find();
            if($status['status'] != 1) unset($data[$k]);
        }
        return $data;
    }
}