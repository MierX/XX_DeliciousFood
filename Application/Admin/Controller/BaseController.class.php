<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Upload;

class BaseController extends Controller
{
    public function _initialize()
    {
        if(!$_SESSION['admin']['isLogin'])
        {
            $this->login();
            exit;
        }
    }

    public function index()
    {

    }

    public function content()
    {
        $title = $_GET['title'];
        $data = D($_GET['table'])->where($_GET['where'])->find();

        $this->assign('title',$title);
        $this->assign('data',$data);
    }

    public function list()
    {
        $title = $_GET['title'];
        $count = D($_GET['table'])->field('*')->where($_GET['where'])->count();
        $data = D($_GET['table'])->field('*')->where($_GET['where'])->select();

        $this->assign('id',$_GET['id']);
        $this->assign('title',$title);
        $this->assign('count',$count);
        $this->assign('data',$data);
    }

    public function change()
    {
        $result = false;
        if($_POST) $result = D($_POST['table'])->where(['id' => $_POST['id']])->save([$_POST['field'] => $_POST['value']]);
        $result = $result ? true : false;
        echo $result;
    }

    public function changeV2()
    {
        $result = false;
        if($_GET) $result = D($_GET['table'])->where($_GET['where'])->save($_GET['save']);
        $result = $result ? true : false;
        echo $result;
    }

    public function edit()
    {
        if($_GET) $data = D($_GET['table'])->field('*')->where($_GET['where'])->find();
        if($_POST)
        {
            if($_POST['id'])
            {
                $result = D($_GET['table'])->where(['id' => $_POST['id']])->save($_POST);
            }
            else
            {
                $_POST['addtime'] = time();
                $result = D($_GET['table'])->add($_POST);
            }
            $result = $result ? true : false;
            echo $result;
            exit;
        }
        $this->assign('data',$data);
    }

    public function add()
    {
        $title = $_GET['title'];
        $id = $_GET['value'];
        $count = D($_GET['table'])->field('*')->where([$_GET['field'] => ['neq', $_GET['value']]])->count();
        $data = D($_GET['table'])->field('*')->where([$_GET['field'] => ['neq', $_GET['value']]])->select();

        $this->assign('title',$title);
        $this->assign('id',$id);
        $this->assign('count',$count);
        $this->assign('data',$data);
    }

    public function del()
    {
        $result = false;
        if($_GET)
        {
            $result = D($_GET['table'])->where($_GET['where'])->delete();
            $result = $result ? true : false;
        }
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

    public function out()
    {
        session('admin',null);
        echo true;
    }
}