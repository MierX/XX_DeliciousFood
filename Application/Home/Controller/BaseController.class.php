<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;

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

    public function noLogin()
    {
        if(!$_SESSION['user']['isLogin'])
        {
            $this->redirect('Index/login',[],0);
            exit;
        }
    }

    public function edit()
    {
        $this->noLogin();

        $data = D($_GET['table'])->field('*')->where($_GET['where'])->find();

        $this->assign('title', $_GET['title']);
        $this->assign('data', $data);
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

    public function upload()
    {

        if ($_FILES)
        {
            $config = C('UPLOAD_IMG');
            $path_name = I('path_name', '');
            if($path_name) $config['savePath'] = str_replace('images', $path_name, $config['savePath']);
            $save_path = $config['rootPath'] . $config['savePath'];
            if (!is_dir($save_path))
            {
                if (IS_WIN)
                {
                    mkdir($save_path, '0777', true);
                }
                else
                {
                    xmkdir($save_path);
                }
            }

            $upload = new Upload($config);
            $info = $upload->upload();
            if (!$info)
            {
                echo false;
                exit;
            }
            $file_arr = array();
            foreach ($info as $value)
            {
                $url = $value['savepath'] . $value['savename'];
                $url = str_replace('\\', '/', $url);
                $file_arr[] = $url;
            }
            $response['data'] = $file_arr;
            echo json_encode($response);
            exit;
        }
        echo false;
        exit;
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